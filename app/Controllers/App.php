<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BarangModel;
use App\Models\JasaModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\PesananModel;
use App\Models\ProvinsiModel;
use App\Models\SatuanModel;
use App\Models\SettingsModel;
use App\Models\SpesifikasiModel;
use App\Models\UserModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class App extends BaseController
{
    private $userModel;
    private $barangModel;
    private $jasaModel;
    private $satuanModel;
    private $spesifikasiModel;
    private $pesananModel;
    private $bankModel;
    private $provinsiModel;
    private $kabupatenModal;
    private $kecamatanModel;
    private $settingsModel;
    private $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->barangModel = new BarangModel();
        $this->jasaModel = new JasaModel();
        $this->satuanModel = new SatuanModel();
        $this->spesifikasiModel = new SpesifikasiModel();
        $this->pesananModel = new PesananModel();
        $this->bankModel = new BankModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModal = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->settingsModel = new SettingsModel();
        $this->session = session();
    }

    public function home()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $barangData = $this->barangModel->limitData(3);
            // dd($barangData);
            $data = [
                'title' => 'Home',
                'barangData' => $barangData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_home', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function produk()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $barangData = $this->barangModel->where('status', '0')->findAll();
            $jasaData = $this->jasaModel->where('status', '0')->findAll();

            $data = [
                'title' => 'Produk',
                'barangData' => $barangData,
                'jasaData' => $jasaData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_produk', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function searchProduk()
    {
        $id = $this->request->getGet('id');

        $searchBarang = $this->barangModel->search($id);
        $searchJasa = $this->jasaModel->searchJasa($id);

        if (!empty($searchBarang)) {
            $data = [
                'dt_barang' => $searchBarang,
            ];
        } elseif (!empty($searchJasa)) {
            $data = [
                'dt_jasa' => $searchJasa,
            ];
        }

        return view('App/v_cariProduk.php', $data);
    }

    public function detailBarang()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $slugBarang = $this->request->getGet('id');

            $barangData = $this->barangModel->where('slug', $slugBarang)->first();

            $data = [
                'title' => 'Detail Produk',
                'barangData' => $barangData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_detailBarang', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function detailJasa()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $slugJasa = $this->request->getGet('id');

            $jasaData = $this->jasaModel->where('slug', $slugJasa)->first();

            $data = [
                'title' => 'Detail Produk',
                'jasaData' => $jasaData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_detailJasa', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function addjumlahPesanan()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();

        $slugProduk = $this->request->getGet('id');
        $jumlahPesanan = $this->request->getPost('jumlah');
        // dd($jumlahPesanan);

        $dataBarang = $this->barangModel->where('slug', $slugProduk)->first();
        $dataJasa = $this->jasaModel->where('slug', $slugProduk)->first();

        if (!empty($dataBarang)) {
            $updateStok = [
                'id' => $dataBarang['id'],
                'stok' => $dataBarang['stok'] - $jumlahPesanan,
            ];
            $this->barangModel->save($updateStok);

            $data = [
                'userId' => $userLogin['slug'],
                'produkId' => $dataBarang['slug'],
                'jumlah' => $jumlahPesanan,
                'total' => $dataBarang['harga'] * $jumlahPesanan,
                'slug' =>  $this->generateRandomSlug(10),
            ];
        } elseif (!empty($dataJasa)) {
            $data = [
                'userId' => $userLogin['slug'],
                'produkId' => $dataJasa['slug'],
                'jumlah' => $jumlahPesanan,
                'total' => $dataJasa['harga'] * $jumlahPesanan,
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'slug' =>  $this->generateRandomSlug(10),
            ];
        }

        $this->pesananModel->save($data);

        return redirect()->to('app/shop/pembayaran?id=' . $data['slug'] . '&produk=' . $data['produkId']);
    }

    public function pembayaran()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $slugProduk = $this->request->getGet('produk');
            $slugPesanan = $this->request->getGet('id');

            $barangData = $this->barangModel->where('slug', $slugProduk)->first();
            $jasaData = $this->jasaModel->where('slug', $slugProduk)->first();
            $pesananData = $this->pesananModel->where('slug', $slugPesanan)->first();

            $bankData = $this->bankModel->where('status', '0')->findAll();

            if (!empty($barangData)) {
                $data = [
                    'title' => 'Pembayaran',
                    'produkData' => $barangData,
                    'pesananData' => $pesananData,
                    'bankData' => $bankData,
                    'settingsData' => $this->settingsModel->first(),
                ];
            } elseif (!empty($jasaData)) {
                $data = [
                    'title' => 'Pembayaran',
                    'produkData' => $jasaData,
                    'pesananData' => $pesananData,
                    'bankData' => $bankData,
                    'settingsData' => $this->settingsModel->first(),
                ];
            }


            return view('App/v_pembayaran', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function addBuktiPembayaran()
    {
        $slugProduk = $this->request->getGet('produk');
        $slugPesanan = $this->request->getGet('id');

        $dataBarang = $this->barangModel->where('slug', $slugProduk)->first();
        $dataJasa = $this->jasaModel->where('slug', $slugProduk)->first();
        $dataPesanan = $this->pesananModel->where('slug', $slugPesanan)->first();

        $fileBukti = $this->request->getFile('bukti');

        $namaFile = $fileBukti->getRandomName();
        $fileBukti->move(ROOTPATH . 'public/image/buktiPembayaran/', $namaFile);

        if (!empty($dataBarang)) {
            $data = [
                'id' => $dataPesanan['id'],
                'produkId' => $dataBarang['slug'],
                'pembayaran' => $namaFile,
            ];
        } elseif (!empty($dataJasa)) {
            $data = [
                'id' => $dataPesanan['id'],
                'produkId' => $dataJasa['slug'],
                'pembayaran' => $namaFile,
            ];
        }

        $this->pesananModel->save($data);

        return redirect()->to('app/shop/pembayaranEnd?id=' . $data['produkId']);
    }

    public function pembayaranEnd()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $slugPesanan = $this->request->getGet('id');
            $pesananData = $this->pesananModel->where('slug', $slugPesanan)->first();

            $data = [
                'title' => 'Pembayaran Selesai',
                'pesananData' => $pesananData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_thankyou', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function pesananSaya()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $pesananUser = $this->pesananModel->getPesananWithProdukAndUser($userLogin['slug']);
            // dd($pesananUser);

            $data = [
                'title' => 'Pesanan Saya',
                'pesananUser' => $pesananUser,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_pesananSaya', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function detailPesanan()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $slugPesanan = $this->request->getGet('id');

            $pesananData = $this->pesananModel->getPesananAndProdukAndUserWithSlug($slugPesanan);
            // dd($pesananData);

            $data = [
                'title' => 'Detail Pesanan',
                'pesananData' => $pesananData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_detailPesanan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function profile()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {

            $data = [
                'title' => 'Detail Pesanan',
                'userData' => $userLogin,
                'provinsiData' => $this->provinsiModel->findAll(),
                'kabupatenData' => $this->kabupatenModal->findAll(),
                'kecamatanData' => $this->kecamatanModel->findAll(),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('App/v_profile', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function editProfile()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();

        $alamat = [
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kodePos' => $this->request->getPost('kodePos'),
            'jalan' => $this->request->getPost('jalan'),
        ];

        $data = [
            'id' => $userLogin['id'],
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'email' => $this->request->getPost('email'),
            'alamat' => json_encode($alamat)
        ];

        $rule = [
            'nama' => 'required',
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

    public function cetakInvoicePesanan()
    {
        set_time_limit(120);
        $pesananSlug = $this->request->getGet('id');

        $data = [
            'active' => 'Invoice Produk',
            'pesananData' => $this->pesananModel->getPesananAndProdukAndUserWithSlug($pesananSlug),
            'settingsData' => $this->settingsModel->first(),
        ];

        // dd($data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $html = view('Be/pdf/invoicePesanan.php', $data);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // sleep(3);
        $dompdf->stream("Invoice Produk-" . $data['pesananData'][0]->pesananSlug . " SMKN 1 Jenangan.pdf", ["Attachment" => false]);
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
