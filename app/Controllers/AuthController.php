<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function login()
    {
        if ($this->request->getPost()) {

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $db = \Config\Database::connect();

            $user = $db->table('users')
                       ->where('username', $username)
                       ->where('aktif', 1)
                       ->get()
                       ->getRowArray();


            if ($user && password_verify($password, $user['password'])) {
                
                session()->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true,
                ]);


                // Redirect sesuai role
                if ($user['role'] == 'admin') {

                return redirect()->to('/admin/kuliner');

                } elseif ($user['role'] == 'user' || $user['role'] == 'kontributor') {

                return redirect()->to('/kuliner');

                } else {

                return redirect()->to('/');

                }


            } else {

                session()->setFlashdata(
                    'failed',
                    'Username atau Password salah!'
                );

                return redirect()->back();
            }
        }


        return view('v_login');
    }



    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }



    public function register()
    {

        if ($this->request->getPost()) {


            $username = $this->request->getVar('username');
            $email    = $this->request->getVar('email');
            $password = $this->request->getVar('password');


            $db = \Config\Database::connect();



            // cek username
            $cekUsername = $db->table('users')
                              ->where('username', $username)
                              ->get()
                              ->getRowArray();


            if ($cekUsername) {

                session()->setFlashdata(
                    'failed',
                    'Username sudah digunakan!'
                );

                return redirect()->back();
            }



            // cek email
            $cekEmail = $db->table('users')
                           ->where('email', $email)
                           ->get()
                           ->getRowArray();


            if ($cekEmail) {

                session()->setFlashdata(
                    'failed',
                    'Email sudah digunakan!'
                );

                return redirect()->back();

            }



            // simpan user baru
            $db->table('users')->insert([

                'username'   => $username,

                'email'      => $email,

                'password'   => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                ),

                'role'       => 'kontributor',

                'aktif'      => 1,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s')

            ]);



            session()->setFlashdata(
                'success',
                'Registrasi berhasil! Silakan login.'
            );


            return redirect()->to('/login');

        }


        return view('v_register');
    }
}