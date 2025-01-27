<?php

namespace App\Controllers;

use App\Models\LoginModel;

class ChatController extends BaseController {
    protected $user;

    public function __construct() {
        $this->user = new LoginModel();
    }

    public function chat() {
        if(!session()->get('isLoggedIn')){
            return redirect()->to('/login');
        }

        $users = $this->user->getAllUsers();
        $data['loginDetails']= session()->get();
        $data['users'] = $users;
        return view('chat1', $data); 
    }
}
