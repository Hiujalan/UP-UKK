<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\PesananModel;
use App\Models\ProvinsiModel;
use App\Models\SettingsModel;
use App\Models\UserModel;

class Users extends BaseController
{
    private $userModel;
    private $provinsiModel;
    private $kabupatenModel;
    private $kecamatanModel;
    private $pesananModel;
    private $settingsModel;
    private $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->pesananModel = new PesananModel();
        $this->settingsModel = new SettingsModel();
        $this->session = session();
    }

    public function user()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $userData = $this->userModel->where('status', '0')->where('role', '3')->findAll();

            $provinsiData = $this->provinsiModel->findAll();
            $kabupatenData = $this->kabupatenModel->findAll();
            $kecamatanData = $this->kecamatanModel->findAll();

            $data = [
                'active' => 'Users',
                'userDataLogin' => $userLogin,
                'userData' => $userData,
                'provinsiData' => $provinsiData,
                'kabupatenData' => $kabupatenData,
                'kecamatanData' => $kecamatanData,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_user', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createUser()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash((string)$this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 3,
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
            'telp' => 'required|max_length[15]',
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);

            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editUser()
    {
        $slugUser = $this->request->getGet('id');

        $userData = $this->userModel->where('slug', $slugUser)->first();

        if ($this->request->getPost('password') !== null) {
            $data = [
                'id' => $userData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telephone'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash((string)$this->request->getPost('password'), PASSWORD_BCRYPT),
            ];
        } else {
            $data = [
                'id' => $userData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telephone'),
                'email' => $this->request->getPost('email'),
                'password' => $userData['password'],
            ];
        }

        $rule = [
            'nama' => 'required',
            'telp' => 'required|max_length[15]',
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteUser()
    {
        $slugUser = $this->request->getGet('id');

        $userData = $this->userModel->where('slug', $slugUser)->first();

        $data = [
            'id' => $userData['id'],
            'status' => '1',
        ];

        $this->userModel->save($data);

        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function operator()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $userData = $this->userModel->where('status', '0')->where('role', '2')->findAll();

            $data = [
                'active' => 'Operator',
                'userData' => $userData,
                'userDataLogin' => $userLogin,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_operator', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createOperator()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash((string)$this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 2,
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
            'telp' => 'required|max_length[15]',
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editOperator()
    {
        $slugUser = $this->request->getGet('id');

        $userData = $this->userModel->where('slug', $slugUser)->first();

        if ($this->request->getPost('password') !== null) {
            $data = [
                'id' => $userData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telephone'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash((string)$this->request->getPost('password'), PASSWORD_BCRYPT),
            ];
        } else {
            $data = [
                'id' => $userData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telephone'),
                'email' => $this->request->getPost('email'),
                'password' => $userData['password'],
            ];
        }

        $rule = [
            'nama' => 'required',
            'telp' => 'required|max_length[15]',
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteOperator()
    {
        $slugUser = $this->request->getGet('id');

        $userData = $this->userModel->where('slug', $slugUser)->first();

        $data = [
            'id' => $userData['id'],
            'status' => '1',
        ];

        $this->userModel->save($data);

        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    function generateRandomSlug($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $slug = '';

        for ($i = 0; $i < $length; $i++) {
            $slug .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $slug;
    }
}
