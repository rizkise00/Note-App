<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function registerView()
    {
        return view('auth/register');
    }

    public function doLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->getByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return view('auth/login', [
                'error' => 'Invalid email or password',
            ]);
        }

        session()->set('user_id', $user['id']);
        session()->set('user_name', $user['name']);
        session()->set('user_email', $user['email']);

        return redirect()->to('/dashboard');
    }

    public function doRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $this->userModel->save([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        session()->setFlashdata('success', 'Account created successfully. Please login.');
        return redirect()->to('/auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
