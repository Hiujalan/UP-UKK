<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\PesananModel;
use App\Models\ProvinsiModel;
use App\Models\SettingsModel;
use App\Models\UserModel;

class Login extends BaseController
{
    private $userModel;
    private $provinsiModel;
    private $kabupatenModel;
    private $kecamatanModel;
    private $pesananModel;
    private $settingsData;
    private $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->pesananModel = new PesananModel();
        $this->settingsData = new SettingsModel();
        $this->session = session();
    }

    public function login()
    {
        return view('Page/v_login');
    }

    public function checkLogin()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'password' => $this->request->getPost('login[password]'),
        ];

        $rule = [
            'nama' => 'required',
            'password' => 'required',
        ];

        $userData = $this->userModel->where('status', '0')->where('nama', $data['nama'])->first();

        if (!empty($userData)) {
            if (password_verify((string)$data['password'], $userData['password'])) {
                if (!$this->validateData($data, $rule)) {
                    $this->session->setTempdata('errors', $this->validator->getErrors(), 300);
                    return redirect()->back()->withInput();
                } else {
                    $this->session->set('auth', $userData['slug']);
                    if ($userData['role'] == 1 || $userData['role'] == 2) {
                        return redirect()->to('be/dashboard');
                    } else {
                        return redirect()->to('app/home');
                    }
                }
            } else {
                $this->session->setTempdata('errors[password]', 'Password Salah', 300);
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setTempdata('errors[username]', 'User Tidak Ditemukan', 300);
            return redirect()->back()->withInput();
        }
    }

    public function register()
    {
        return view('Page/v_register');
    }

    public function createUser()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telephone'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash((string)$this->request->getPost('login[password]'), PASSWORD_BCRYPT),
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

            return redirect()->to('/login/registerAlamat?id=' . $data['slug']);
        }
    }

    public function registerAlamat()
    {
        $registerSlug = $this->request->getGet('id');

        $loginData = $this->userModel->where('slug', $registerSlug)->first();

        $provinsiData = $this->provinsiModel->findAll();
        $kabupatenData = $this->kabupatenModel->findAll();
        $kecamatanData = $this->kecamatanModel->findAll();

        $data = [
            'loginData' => $loginData,
            'provinsiData' => $provinsiData,
            'kabupatenData' => $kabupatenData,
            'kecamatanData' => $kecamatanData,
        ];

        return view('Page/v_registerAlamat', $data);
    }

    public function updateAlamat()
    {
        $registerSlug = $this->request->getGet('id');

        $loginData = $this->userModel->where('slug', $registerSlug)->first();

        $dataAlamat =  [
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kodePos' => $this->request->getPost('kodePos'),
            'jalan' => $this->request->getPost('jalan'),
        ];

        $data = [
            'id' => $loginData['id'],
            'alamat' => json_encode($dataAlamat),
        ];

        $rule = [
            'id' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);

            return redirect()->to('/');
        }
    }

    public function updateAlamatInBe()
    {
        $registerSlug = $this->request->getGet('id');

        $loginData = $this->userModel->where('slug', $registerSlug)->first();

        $dataAlamat =  [
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kodePos' => $this->request->getPost('kodePos'),
            'jalan' => $this->request->getPost('jalan'),
        ];

        $data = [
            'id' => $loginData['id'],
            'alamat' => json_encode($dataAlamat),
        ];

        $rule = [
            'id' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->userModel->save($data);

            return redirect()->back();
        }
    }

    public function dashboard()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $pesananaData = $this->pesananModel->where('status', '0')->findAll();
            $userData = $this->userModel->where('status', '0')->where('role', '3')->findAll();

            $data = [
                'userDataLogin' => $userLogin,
                'totalPesanan' => $this->pesananModel->getTotalPesanan(),
                'jumlahPesanan' => count($pesananaData),
                'jumlahPelanggan' => count($userData),
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsData->first(),
            ];

            return view('Page/v_dashboard', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
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
