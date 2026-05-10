<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function attempt()
    {
        $email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Invalid login');
        }

        $user = (new UserModel())->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id'        => $user['id'],
                'name'      => $user['name'],
                'role'      => $user['role'],
                'logged_in' => true,
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
