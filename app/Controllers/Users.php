<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        return view('users/index', ['users' => $this->model->findAll()]);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $this->model->save([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to('/users')->with('success', 'User created.');
    }

    public function edit($id)
    {
        $user = $this->model->find($id);
        if (!$user) return redirect()->to('/users')->with('error', 'User not found.');

        return view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->model->update($id, $data);

        return redirect()->to('/users')->with('success', 'User updated.');
    }

    public function delete($id)
    {
        if ((int)$id === (int)session()->get('id')) {
            return redirect()->to('/users')->with('error', 'Cannot delete your own account.');
        }

        $this->model->delete($id);
        return redirect()->to('/users')->with('success', 'User deleted.');
    }
}
