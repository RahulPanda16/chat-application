<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function __construct(){
        helper(['form']);
    }

    public function login(){
        $data = [];

        echo view('layout/header');
        echo view('login', $data);
        echo view('layout/footer');
    }

    public function register(){
        $data = [];

        if($this->request->getMethod() == 'post'){
            //do validation
            $rules = [
                'firstname' => 'required | min_length[3] | max_length[20]',
                'lastname' => 'required | min_length[3] | max_length[20]',
                'email' => 'required | min_length[6] | max_length[30] | valid_email | is_unique[singin.email]',
                'password' => 'required | min_length[8] | max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                //user stored in database

            }
        }

        echo view('layout/header');
        echo view('signup', $data);
        echo view('layout/footer');
    }
}