<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Users extends BaseController
{
    public function __construct(){
        helper(['form']);
        $this->session = session();
    }

    public function index() { 
        $data = []; 

        if (true) { 
            // $this->request->getMethod() == 'post'
            $rules = [ 
                'email' => 'required|min_length[6]|max_length[50]|valid_email', 
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]', 
            ]; 
            
            $errors = [ 
                'password' => [ 
                    'validateUser' => "Email or Password don't match",
                 ], 
            ]; 
                 
            if (!$this->validate($rules, $errors)) { 
                $data['validation'] = $this->validator; 
            }
            else 
            { 
                    // user stored in database 
                    $model = new LoginModel(); 
                    // Add your logic here to handle the login
                    $user = $model->where('email', $this->request->getVar('email'))
                                  ->first();

                    $this->setUserSession($user);
                    return redirect()->to('/');
            } 
        } 
            echo view('layout/header'); 
            echo view('login', $data); 
            echo view('layout/footer'); 
    }


    private function setUserSession($user){
        $data = [
         'id' => $user['id'],
         'firstname' => $user['firstname'],
         'lastname' => $user['lastname'],
         'email' => $user['email'],
         'isLoggedIn' => true,
        ];
    
        session()->set($data);
        return true;
     }


    public function register(){
        $data = [];

        if(true){
            // $this->request->getMethod() == 'post'
            //do validation
            
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[30]|valid_email|is_unique[signin.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                //user stored in database
                $model = new LoginModel();

                $newData= [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];

                $model->save($newData);
                $this->session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/login');
            }
        }

        echo view('layout/header');
        echo view('signup', $data);
        echo view('layout/footer');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to("/login");
    }
}