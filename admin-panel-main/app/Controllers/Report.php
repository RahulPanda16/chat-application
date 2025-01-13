<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Report extends BaseController
{   

    public function __construct()
    {
       
    }

    public function showReport(){ 
        $apiUrl = 'http://192.168.0.152:1000/sql/getallreport'; 
        $curl = curl_init($apiUrl); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($curl); 
        if($response === false) { 
            // Handle error appropriately 
            curl_close($curl); 
            return; 
        } 
            curl_close($curl); 
            $userData = json_decode($response); 
            // print_r($userData);
            // die;
            if (json_last_error() !== JSON_ERROR_NONE) { 
                return;
             } 
             
             $pager = \Config\Services::pager(); 
             $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1; 
             $perPage = 5; 
             $offset = ($page - 1) * $perPage; 
             $pagedData = array_slice($userData, $offset, $perPage); 
             $totalRows = count($userData); $data['pagename'] = 'report'; 
             $data['pagedata'] = [ 'accessUser' => $pagedData, 'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full') ]; 
             echo view('layout/header'); 
             echo view('report', $data); 
             echo view('layout/footer');
    }

    public function getReport()
    {
        // API URL
        $apiUrl = 'http://192.168.0.133:8080/mysql/callreport/get';

        // Fetch the API response
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Executing the curl request
        $response = curl_exec($curl);
        curl_close($curl);

        // Decode the JSON response
        $userData = json_decode($response);

     
      //Excel sheet creation using spreadsheet library 

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="hello.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Total_Calls');
        $activeWorksheet->setCellValue('B1', 'Call_Hour');
        $activeWorksheet->setCellValue('C1', 'Call_Answered');
        $activeWorksheet->setCellValue('D1', 'Call_Autodrop');
        $activeWorksheet->setCellValue('E1', 'Call_Autofail');
        $activeWorksheet->setCellValue('F1', 'Talktime');
    
            $num =2;
        foreach($userData as $data1){
             
            $activeWorksheet->setCellValue('A'.$num, $data1->Total_Calls);
            $activeWorksheet->setCellValue('B'.$num, $data1->Call_Hour.'-'.$data1->Call_Hour+1);   
            $activeWorksheet->setCellValue('C'.$num, $data1->Call_Answered);   
            $activeWorksheet->setCellValue('D'.$num, $data1->Call_Autodrop);   
            $activeWorksheet->setCellValue('E'.$num, $data1->Call_Autofail);   
            $activeWorksheet->setCellValue('F'.$num, $data1->Talktime);   
             $num++;
        }
    
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
       
       
    }
}