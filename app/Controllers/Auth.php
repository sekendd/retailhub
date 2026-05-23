<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // DATABASE LOGIN ONLY
        $user = $model->where('email', $username)->first();

        if ($user && password_verify($password, $user['password'])) {

            $session->set([
                'id'        => $user['id'],
                'username'  => $user['name'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}