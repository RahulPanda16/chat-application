<?php
namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{   
    public function __construct(){
        helper(['form']);
    }

    public function showSummaryReport($reportNo){ 
        if($reportNo == 1){
            $apiUrl = 'http://192.168.0.152:1000/sql/getsummarizereport';
        }else if ($reportNo == 2){
            $apiUrl = 'http://192.168.0.152:1000/mongo/getsummarizereport';
        }else{
            $apiUrl = 'http://192.168.0.152:1000/elastic/callreportsummary/get';
        }
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
             $totalRows = count($userData); 
             $data['reportNumber'] = $reportNo;
             $data['pagename'] = 'report'; 
             $data['pagedata'] = [ 
                'accessUser' => $pagedData, 
                'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full') 
            ]; 
             echo view('layout/header'); 
             echo view('summaryReport', $data); 
             echo view('layout/footer');
    }

    public function showLoggerReport($reportNo){
        if($reportNo == 1){
            $apiUrl = 'http://192.168.0.152:1000/sql/getallreport'; 
        }else if($reportNo == 2){
            $apiUrl = 'http://192.168.0.152:1000/mongo/getallreport'; 
        }else{
            $apiUrl = 'http://192.168.0.152:1000/elastic/getallreport';
        }

        $search = $this->request->getVar('search');
        $report = $this->request->getVar('report');
        $dispose = $this->request->getVar('dispose');

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

             if ($search) { 
                $userData = array_filter($userData, function($item) use ($search) { 
                    return stripos($item->campaignName, $search) !== false || stripos($item->processName, $search) !== false || stripos($item->agentName, $search) !== false; });
            }

            if($report) {
                $userData = array_filter($userData, function($item) use ($report) {
                    return stripos($item->reportType, $report) !== false;
                });
            }

            if($dispose) {
                $userData = array_filter($userData, function($item) use ($dispose) {
                    return stripos($item->disposeType, $dispose) !== false;
                });
            }
             
             $pager = \Config\Services::pager(); 
             $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1; 
             $perPage = 5; 
             $offset = ($page - 1) * $perPage; 
             $pagedData = array_slice($userData, $offset, $perPage); 
             $totalRows = count($userData); 
             $data['pagename'] = 'report'; 
             $data['reportNumber'] = $reportNo ;
             $data['pagedata'] = [ 
                'accessUser' => $pagedData, 
                'pager' => $pager->makeLinks($page, $perPage, $totalRows, 'default_full') 
            ]; 
             echo view('layout/header'); 
             echo view('loggerReport', $data); 
             echo view('layout/footer');
    }
    
    public function summaryReport($reportNo) { 
        if($reportNo == 1){
            $apiUrl = "http://192.168.0.152:1000/sql/getsummarizereport";
        }elseif($reportNo == 2){
            $apiUrl = 'http://192.168.0.152:1000/mongo/getsummarizereport'; 
        }else{
            $apiUrl = "http://192.168.0.152:1000/elastic/callreportsummary/get";
        }
        $curl = curl_init($apiUrl); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($curl); 

        if (curl_errno($curl)) { 
            log_message('error', 'cURL error: ' . curl_error($curl)); 
            curl_close($curl); return null; 
        } 
        curl_close($curl); 
        log_message('info', 'API Response: ' . $response); 
        $summaryData = json_decode($response, true); 
        if (json_last_error() !== JSON_ERROR_NONE) { 
            log_message('error', 'JSON decode error: ' . json_last_error_msg()); return null; 
        } 
        // Create and configure the spreadsheet 
        $spreadsheet = new Spreadsheet(); 
        $activeWorksheet = $spreadsheet->getActiveSheet(); 

        if($reportNo == 1){
            $activeWorksheet->setCellValue('A1', 'Total_Calls'); 
            $activeWorksheet->setCellValue('B1', 'Call_Hour'); 
            $activeWorksheet->setCellValue('C1', 'DateTime'); 
            $activeWorksheet->setCellValue('C1', 'Call_Answered'); 
            $activeWorksheet->setCellValue('D1', 'Missed_Calls'); 
            $activeWorksheet->setCellValue('E1', 'Call_Autodrop'); 
            $activeWorksheet->setCellValue('F1', 'Call_Autofail'); 
            $activeWorksheet->setCellValue('G1', 'Talktime'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                $activeWorksheet->setCellValue('A' . $num, $data['Total_Calls']); 
                $activeWorksheet->setCellValue('B' . $num, $data['Call_hours'] . '-' . ($data['Call_hours'] + 1)); 
                $activeWorksheet->setCellValue('C' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('C' . $num, $data['Call_Answered']); 
                $activeWorksheet->setCellValue('D' . $num, $data['Missed_Calls']); 
                $activeWorksheet->setCellValue('E' . $num, $data['Call_Autodrop']); 
                $activeWorksheet->setCellValue('F' . $num, $data['Call_Autofail']); 
                $activeWorksheet->setCellValue('G' . $num, $data['Talktime']); 
                $num++; 
            } 
        }
        else if($reportNo == 2){
            $activeWorksheet->setCellValue('A1', 'Total_Calls'); 
            $activeWorksheet->setCellValue('B1', 'Call_Hour'); 
            // $activeWorksheet->setCellValue('C1', 'DateTime'); 
            $activeWorksheet->setCellValue('C1', 'Call_Answered'); 
            $activeWorksheet->setCellValue('D1', 'Missed_Calls'); 
            $activeWorksheet->setCellValue('E1', 'Call_Autodrop'); 
            $activeWorksheet->setCellValue('F1', 'Call_Autofail'); 
            $activeWorksheet->setCellValue('G1', 'Talktime'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                $activeWorksheet->setCellValue('A' . $num, $data['Total_Calls']); 
                $activeWorksheet->setCellValue('B' . $num, $data['_id'] . '-' . ($data['_id'] + 1)); 
                // $activeWorksheet->setCellValue('C' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('C' . $num, $data['Call_Answered']); 
                $activeWorksheet->setCellValue('D' . $num, $data['Missed_Calls']); 
                $activeWorksheet->setCellValue('E' . $num, $data['Call_Autodrop']); 
                $activeWorksheet->setCellValue('F' . $num, $data['Call_Autofail']); 
                $activeWorksheet->setCellValue('G' . $num, $data['Talktime']); 
                $num++; 
            } 
        }else {
            $activeWorksheet->setCellValue('A1', 'Total_Calls'); 
            // $activeWorksheet->setCellValue('B1', 'Call_Hour'); 
            // $activeWorksheet->setCellValue('C1', 'DateTime'); 
            $activeWorksheet->setCellValue('C1', 'Call_Answered'); 
            $activeWorksheet->setCellValue('D1', 'Missed_Calls'); 
            $activeWorksheet->setCellValue('E1', 'Call_Autodrop'); 
            $activeWorksheet->setCellValue('F1', 'Call_Autofail'); 
            $activeWorksheet->setCellValue('G1', 'Talktime'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                $activeWorksheet->setCellValue('A' . $num, $data['Total_Calls']); 
                // $activeWorksheet->setCellValue('B' . $num, $data['_id'] . '-' . ($data['_id'] + 1)); 
                // $activeWorksheet->setCellValue('C' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('C' . $num, $data['Call_Answered']); 
                $activeWorksheet->setCellValue('D' . $num, $data['Missed_Calls']); 
                $activeWorksheet->setCellValue('E' . $num, $data['Call_Autodrop']); 
                $activeWorksheet->setCellValue('F' . $num, $data['Call_Autofail']); 
                $activeWorksheet->setCellValue('G' . $num, $data['Talktime']); 
                $num++; 
            }
        }
        // Ensure no prior output 
        if (ob_get_length()) 
        ob_end_clean(); 
        // Force download 

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        if($reportNo == 1){
            header('Content-Disposition: attachment;filename="SqlSummaryReport.xlsx"'); 
        }else if($reportNo == 2){
            header('Content-Disposition: attachment;filename="MongoSummaryReport.xlsx"'); 
        }else {
            header('Content-Disposition: attachment;filename="ElasticSummaryReport.xlsx"'); 
        }
        header('Cache-Control: max-age=0'); 
        $writer = new Xlsx($spreadsheet); 
        $writer->save('php://output'); 
        exit(); 
    }      


    public function loggerReport($reportNo) { 
        if($reportNo == 1){
            $apiUrl = "http://192.168.0.152:1000/sql/getallreport";
        }else if($reportNo == 2){
            $apiUrl = 'http://192.168.0.152:1000/mongo/getsummarizereport'; 
        }else{
            $apiUrl = "http://192.168.0.152:1000//elastic/callreportsummary/get";
        }
        $curl = curl_init($apiUrl); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($curl); 

        if (curl_errno($curl)) { 
            log_message('error', 'cURL error: ' . curl_error($curl)); 
            curl_close($curl); return null; 
        } 
        curl_close($curl); 
        log_message('info', 'API Response: ' . $response); 
        $summaryData = json_decode($response, true); 
        if (json_last_error() !== JSON_ERROR_NONE) { 
            log_message('error', 'JSON decode error: ' . json_last_error_msg()); return null; 
        } 
        // Create and configure the spreadsheet 
        $spreadsheet = new Spreadsheet(); 
        $activeWorksheet = $spreadsheet->getActiveSheet(); 

        if($reportNo == 1){
            $activeWorksheet->setCellValue('A1', 'Id'); 
            $activeWorksheet->setCellValue('B1', 'DateTime'); 
            $activeWorksheet->setCellValue('C1', 'Report Type'); 
            $activeWorksheet->setCellValue('D1', 'Dispose Type'); 
            $activeWorksheet->setCellValue('E1', 'Dispose Name'); 
            $activeWorksheet->setCellValue('F1', 'Call Duration'); 
            $activeWorksheet->setCellValue('G1', 'Agent Name'); 
            $activeWorksheet->setCellValue('H1', 'Campaign Name'); 
            $activeWorksheet->setCellValue('I1', 'Process Name'); 
            $activeWorksheet->setCellValue('J1', 'LeadsetId'); 
            $activeWorksheet->setCellValue('K1', 'Reference Uuid'); 
            $activeWorksheet->setCellValue('L1', 'Customer Uuid'); 
            $activeWorksheet->setCellValue('M1', 'Hold Time'); 
            $activeWorksheet->setCellValue('N1', 'Mute Time'); 
            $activeWorksheet->setCellValue('O1', 'Ringing Time'); 
            $activeWorksheet->setCellValue('P1', 'Transfer Time'); 
            $activeWorksheet->setCellValue('Q1', 'Conference Time'); 
            $activeWorksheet->setCellValue('R1', 'Call Time'); 
            $activeWorksheet->setCellValue('S1', 'Dispose Time'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                $activeWorksheet->setCellValue('A' . $num, $data['id']); 
                $activeWorksheet->setCellValue('B' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('C' . $num, $data['reportType']); 
                $activeWorksheet->setCellValue('D' . $num, $data['disposeType']); 
                $activeWorksheet->setCellValue('E' . $num, $data['disposeName']); 
                $activeWorksheet->setCellValue('F' . $num, $data['callDuration']); 
                $activeWorksheet->setCellValue('G' . $num, $data['agentName']); 
                $activeWorksheet->setCellValue('H' . $num, $data['campaignName']); 
                $activeWorksheet->setCellValue('I' . $num, $data['processName']); 
                $activeWorksheet->setCellValue('J' . $num, $data['leadsetId']); 
                $activeWorksheet->setCellValue('K' . $num, $data['referenceUuid']); 
                $activeWorksheet->setCellValue('L' . $num, $data['customerUuid']); 
                $activeWorksheet->setCellValue('M' . $num, $data['hold']); 
                $activeWorksheet->setCellValue('N' . $num, $data['mute']); 
                $activeWorksheet->setCellValue('O' . $num, $data['ringing']); 
                $activeWorksheet->setCellValue('P' . $num, $data['transfer']); 
                $activeWorksheet->setCellValue('Q' . $num, $data['conference']); 
                $activeWorksheet->setCellValue('R' . $num, $data['callTime']); 
                $activeWorksheet->setCellValue('S' . $num, $data['disposeTime']); 
                $num++; 
            } 
        }
        else if($reportNo == 2){
            $activeWorksheet->setCellValue('A1', 'Id'); 
            $activeWorksheet->setCellValue('B1', 'DateTime'); 
            $activeWorksheet->setCellValue('C1', 'Report Type'); 
            $activeWorksheet->setCellValue('D1', 'Dispose Type'); 
            $activeWorksheet->setCellValue('E1', 'Dispose Name'); 
            $activeWorksheet->setCellValue('F1', 'Call Duration'); 
            $activeWorksheet->setCellValue('G1', 'Agent Name'); 
            $activeWorksheet->setCellValue('H1', 'Campaign Name'); 
            $activeWorksheet->setCellValue('I1', 'Process Name'); 
            $activeWorksheet->setCellValue('J1', 'LeadsetId'); 
            $activeWorksheet->setCellValue('K1', 'Reference Uuid'); 
            $activeWorksheet->setCellValue('L1', 'Customer Uuid'); 
            $activeWorksheet->setCellValue('M1', 'Hold Time'); 
            $activeWorksheet->setCellValue('N1', 'Mute Time'); 
            $activeWorksheet->setCellValue('O1', 'Ringing Time'); 
            $activeWorksheet->setCellValue('P1', 'Transfer Time'); 
            $activeWorksheet->setCellValue('Q1', 'Conference Time'); 
            $activeWorksheet->setCellValue('R1', 'Call Time'); 
            $activeWorksheet->setCellValue('S1', 'Dispose Time'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                $activeWorksheet->setCellValue('A' . $num, $data['_id']); 
                $activeWorksheet->setCellValue('B' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('C' . $num, $data['reportType']); 
                $activeWorksheet->setCellValue('D' . $num, $data['disposeType']); 
                $activeWorksheet->setCellValue('E' . $num, $data['disposeName']); 
                $activeWorksheet->setCellValue('F' . $num, $data['callDuration']); 
                $activeWorksheet->setCellValue('G' . $num, $data['agentName']); 
                $activeWorksheet->setCellValue('H' . $num, $data['campaignName']); 
                $activeWorksheet->setCellValue('I' . $num, $data['processName']); 
                $activeWorksheet->setCellValue('J' . $num, $data['leadsetId']); 
                $activeWorksheet->setCellValue('K' . $num, $data['referenceUuid']); 
                $activeWorksheet->setCellValue('L' . $num, $data['customerUuid']); 
                $activeWorksheet->setCellValue('M' . $num, $data['hold']); 
                $activeWorksheet->setCellValue('N' . $num, $data['mute']); 
                $activeWorksheet->setCellValue('O' . $num, $data['ringing']); 
                $activeWorksheet->setCellValue('P' . $num, $data['transfer']); 
                $activeWorksheet->setCellValue('Q' . $num, $data['conference']); 
                $activeWorksheet->setCellValue('R' . $num, $data['callTime']); 
                $activeWorksheet->setCellValue('S' . $num, $data['disposeTime']); 
                $num++; 
            }
        }else {
            // $activeWorksheet->setCellValue('A1', 'Id'); 
            $activeWorksheet->setCellValue('A1', 'DateTime'); 
            $activeWorksheet->setCellValue('B1', 'Report Type'); 
            $activeWorksheet->setCellValue('C1', 'Dispose Type'); 
            $activeWorksheet->setCellValue('D1', 'Dispose Name'); 
            $activeWorksheet->setCellValue('E1', 'Call Duration'); 
            $activeWorksheet->setCellValue('F1', 'Agent Name'); 
            $activeWorksheet->setCellValue('G1', 'Campaign Name'); 
            $activeWorksheet->setCellValue('H1', 'Process Name'); 
            $activeWorksheet->setCellValue('I1', 'LeadsetId'); 
            $activeWorksheet->setCellValue('J1', 'Reference Uuid'); 
            $activeWorksheet->setCellValue('K1', 'Customer Uuid'); 
            $activeWorksheet->setCellValue('L1', 'Hold Time'); 
            $activeWorksheet->setCellValue('M1', 'Mute Time'); 
            $activeWorksheet->setCellValue('N1', 'Ringing Time'); 
            $activeWorksheet->setCellValue('O1', 'Transfer Time'); 
            $activeWorksheet->setCellValue('P1', 'Conference Time'); 
            $activeWorksheet->setCellValue('Q1', 'Call Time'); 
            $activeWorksheet->setCellValue('R1', 'Dispose Time'); 
            $num = 2; 
            foreach ($summaryData as $data) { 
                // $activeWorksheet->setCellValue('A' . $num, $data['_id']); 
                $activeWorksheet->setCellValue('A' . $num, $data['datetime']); 
                $activeWorksheet->setCellValue('B' . $num, $data['reportType']); 
                $activeWorksheet->setCellValue('C' . $num, $data['disposeType']); 
                $activeWorksheet->setCellValue('D' . $num, $data['disposeName']); 
                $activeWorksheet->setCellValue('E' . $num, $data['callDuration']); 
                $activeWorksheet->setCellValue('F' . $num, $data['agentName']); 
                $activeWorksheet->setCellValue('G' . $num, $data['campaignName']); 
                $activeWorksheet->setCellValue('H' . $num, $data['processName']); 
                $activeWorksheet->setCellValue('I' . $num, $data['leadsetId']); 
                $activeWorksheet->setCellValue('J' . $num, $data['referenceUuid']); 
                $activeWorksheet->setCellValue('K' . $num, $data['customerUuid']); 
                $activeWorksheet->setCellValue('L' . $num, $data['hold']); 
                $activeWorksheet->setCellValue('M' . $num, $data['mute']); 
                $activeWorksheet->setCellValue('N' . $num, $data['ringing']); 
                $activeWorksheet->setCellValue('O' . $num, $data['transfer']); 
                $activeWorksheet->setCellValue('P' . $num, $data['conference']); 
                $activeWorksheet->setCellValue('Q' . $num, $data['callTime']); 
                $activeWorksheet->setCellValue('R' . $num, $data['disposeTime']); 
                $num++; 
            }
        }
        // Ensure no prior output 
        if (ob_get_length()) 
        ob_end_clean(); 
        // Force download 

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        if($reportNo == 1){
            header('Content-Disposition: attachment;filename="SqlSummaryReport.xlsx"'); 
        }else if($reportNo == 2){
            header('Content-Disposition: attachment;filename="MongoSummaryReport.xlsx"'); 
        } else if ($reportNo == 3){
            header('Content-Disposition: attachment;filename="ElasticSummaryReport.xlsx"'); 
        }
        header('Cache-Control: max-age=0'); 
        $writer = new Xlsx($spreadsheet); 
        $writer->save('php://output'); 
        exit(); 
    }      

    public function downloadCsv($reportNo)
    {

        if($reportNo == 1){
            $apiUrl = 'http://192.168.0.152:1000/sql/getsummarizereport';
        }else if ($reportNo == 2){
            $apiUrl = 'http://192.168.0.152:1000/mongo/getsummarizereport';
        }else{
            $apiUrl = 'http://192.168.0.152:1000/elastic/getsummarizereport';
        }

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return "Error fetching data from API: " . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $reportData = json_decode($response, true);

        // Check for JSON errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "Error decoding JSON response.";
        }

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="report.csv"');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Write CSV headers

        if($reportNo == 1){
            fputcsv($output, [
                'Id', 'Datetime', 'Report Type', 'Dispose Type', 
                'Dispose Name', 'Call Duration', 'Agent Name', 'Campaign Name','Process Name' , 'LeadsetId', 'Reference Uuid', 'Customer Uuid',
                'Hold Time' , 'Mute Time' , 'Ringing Time', 'Transfer Time', 'Conference Time', 'Call Time', 'Dispose Time'
            ]);
    
            // Write data rows
            foreach ($reportData as $report) {
                fputcsv($output, [
                    $report['id'], $report['datetime'], $report['reportType'], 
                    $report['disposeType'], $report['disposeName'], $report['callDuration'], 
                    $report['agentName'], $report['campaignName'], $report['processName'], $report['leadsetId'], $report['referenceUuid'], $report['customerUuid'],
                    $report['hold'], $report['mute'], $report['ringing'], $report['transfer'], $report['conference'], $report['callTime'], $report['disposeTime']
                ]);
            }
        }else if ($reportNo == 2){
            fputcsv($output, [
                'Id', 'Datetime', 'Report Type', 'Dispose Type', 
                'Dispose Name', 'Call Duration', 'Agent Name', 'Campaign Name','Process Name' , 'LeadsetId', 'Reference Uuid', 'Customer Uuid',
                'Hold Time' , 'Mute Time' , 'Ringing Time', 'Transfer Time', 'Conference Time', 'Call Time', 'Dispose Time'
            ]);
    
            // Write data rows
            foreach ($reportData as $report) {
                fputcsv($output, [
                    $report['_id'], $report['datetime'], $report['reportType'], 
                    $report['disposeType'], $report['disposeName'], $report['callDuration'], 
                    $report['agentName'], $report['campaignName'], $report['processName'], $report['leadsetId'], $report['referenceUuid'], $report['customerUuid'],
                    $report['hold'], $report['mute'], $report['ringing'], $report['transfer'], $report['conference'], $report['callTime'], $report['disposeTime']
                ]);
            }
        }else{
            fputcsv($output, [
                 'Datetime', 'Report Type', 'Dispose Type', 
                'Dispose Name', 'Call Duration', 'Agent Name', 'Campaign Name','Process Name' , 'LeadsetId', 'Reference Uuid', 'Customer Uuid',
                'Hold Time' , 'Mute Time' , 'Ringing Time', 'Transfer Time', 'Conference Time', 'Call Time', 'Dispose Time'
            ]);
    
            // Write data rows
            foreach ($reportData as $report) {
                fputcsv($output, [
                    $report['datetime'], $report['reportType'], 
                    $report['disposeType'], $report['disposeName'], $report['callDuration'], 
                    $report['agentName'], $report['campaignName'], $report['processName'], $report['leadsetId'], $report['referenceUuid'], $report['customerUuid'],
                    $report['hold'], $report['mute'], $report['ringing'], $report['transfer'], $report['conference'], $report['callTime'], $report['disposeTime']
                ]);
            }
        }

        // Close output stream
        fclose($output);
        exit;
    }

}