<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(session()->get('role') == 'admin' ? '/admin' : '/watcher');
        }
        return view('auth/login');
    }

public function login()
{
    $session = session();
    $model = new \App\Models\UserModel();
    
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    
    $data = $model->where('username', $username)->first();
    
    if ($data) {
        $pass = $data['password'];
        $verify_pass = password_verify($password, $pass);
        
        if ($verify_pass) {
            $ses_data = [
                'id'       => $data['id'],
                'username' => $data['username'],
                'role'     => $data['role'],
                'checkpoint_id' => $data['checkpoint_id'],
                'logged_in' => TRUE
            ];
            $session->set($ses_data);
            
            // Update last login
            $model->updateLastLogin($data['id']);
            
            if ($data['role'] == 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/watcher');
            }
        } else {
            $session->setFlashdata('msg', 'Wrong Password');
            return redirect()->to('/auth');
        }
    } else {
        $session->setFlashdata('msg', 'Username not Found');
        return redirect()->to('/auth');
    }
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}