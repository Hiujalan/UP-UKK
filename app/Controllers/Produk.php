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

class Produk extends BaseController
{
    private $userModel;
    private $barangModel;
    private $jasaModel;
    private $satuanModel;
    private $spesifikasiModel;
    private $bankModel;
    private $pesananModel;
    private $provinsiModel;
    private $kabupatenModel;
    private $settingsModel;
    private $kecamatanModel;
    private $session;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->barangModel = new BarangModel();
        $this->jasaModel = new JasaModel();
        $this->satuanModel = new SatuanModel();
        $this->spesifikasiModel = new SpesifikasiModel();
        $this->bankModel = new BankModel();
        $this->pesananModel = new PesananModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->settingsModel = new SettingsModel();
        $this->session = session();
    }

    public function barang()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $barangData = $this->barangModel->where('status', '0')->findAll();

            $satuanData = $this->satuanModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Barang',
                'userDataLogin' => $userLogin,
                'barangData' => $barangData,
                'satuanData' => $satuanData,
                'spesifikasiData' => $this->spesifikasiModel->where('status', '0')->findAll(),
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_barang', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createBarang()
    {
        $gambar = $this->request->getFile('gambar');

        $namaGambar = $gambar->getRandomName();
        $gambar->move(ROOTPATH . 'public/image/barang/', $namaGambar);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'satuan' => $this->request->getPost('satuan'),
            'gambar' => $namaGambar,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->barangModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function spesifikasiBarang()
    {
        $barangSlug = $this->request->getGet('id');
        $barangModel = $this->barangModel->where('slug', $barangSlug)->first();

        $data = [
            'id' => $barangModel['id'],
            'spesifikasi' => json_encode($this->request->getPost('spesifikasi')),
        ];

        $rule = [
            'spesifikasi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->barangModel->save($data);

            return redirect()->back();
        }
    }

    public function editBarang()
    {
        $slugBarang = $this->request->getGet('id');

        $barangData = $this->barangModel->where('slug', $slugBarang)->first();

        $gambar = $this->request->getFile('gambar');

        if ($gambar->isValid() || $gambar->getName()) {
            unlink(ROOTPATH . 'public/image/barang/' . $barangData['gambar']);

            $namaGambar = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/image/barang/', $namaGambar);

            $data = [
                'id' => $barangData['id'],
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'),
                'satuan' => $this->request->getPost('satuan'),
                'gambar' => $namaGambar,
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];
        } else {
            $data = [
                'id' => $barangData['id'],
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'),
                'satuan' => $this->request->getPost('satuan'),
                'gambar' => $barangData['gambar'],
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];
        }

        $rule = [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->barangModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteBarang()
    {
        $slugBarang = $this->request->getGet('id');

        $barangData = $this->barangModel->where('slug', $slugBarang)->first();

        unlink(ROOTPATH . 'public/image/barang/' . $barangData['gambar']);

        $data = [
            'id' => $barangData['id'],
            'status' => '1',
        ];

        $this->barangModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function jasa()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $jasaData = $this->jasaModel->where('status', '0')->findAll();
            // dd($jasaData);

            $satuanData = $this->satuanModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Jasa',
                'userDataLogin' => $userLogin,
                'jasaData' => $jasaData,
                'satuanData' => $satuanData,
                'spesifikasiData' => $this->spesifikasiModel->where('status', '0')->findAll(),
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_jasa', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createJasa()
    {
        $gambar = $this->request->getFile('gambar');

        $namaGambar = $gambar->getRandomName();
        $gambar->move(ROOTPATH . 'public/image/jasa/', $namaGambar);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'satuan' => $this->request->getPost('satuan'),
            'gambar' => $namaGambar,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->jasaModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function spesifikasiJasa()
    {
        $jasaSlug = $this->request->getGet('id');
        $jasaData = $this->jasaModel->where('slug', $jasaSlug)->first();

        $data = [
            'id' => $jasaData['id'],
            'spesifikasi' => json_encode($this->request->getPost('spesifikasi')),
        ];

        $rule = [
            'spesifikasi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->jasaModel->save($data);

            return redirect()->back();
        }
    }

    public function editJasa()
    {
        $slugJasa = $this->request->getGet('id');

        $jasaData = $this->jasaModel->where('slug', $slugJasa)->first();

        $gambar = $this->request->getFile('gambar');

        if ($gambar->isValid() || $gambar->getName()) {
            unlink(ROOTPATH . 'public/image/jasa/' . $jasaData['gambar']);

            $namaGambar = $gambar->getRandomName();
            $gambar->move(ROOTPATH . 'public/image/jasa/', $namaGambar);

            $data = [
                'id' => $jasaData['id'],
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'satuan' => $this->request->getPost('satuan'),
                'gambar' => $namaGambar,
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];
        } else {
            $data = [
                'id' => $jasaData['id'],
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'satuan' => $this->request->getPost('satuan'),
                'gambar' => $jasaData['gambar'],
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];
        }

        $rule = [
            'nama' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->jasaModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteJasa()
    {
        $slugJasa = $this->request->getGet('id');

        $jasaData = $this->jasaModel->where('slug', $slugJasa)->first();

        $data = [
            'id' => $jasaData['id'],
            'status' => '1',
        ];

        $this->jasaModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function satuan()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $satuanData = $this->satuanModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Satuan',
                'userDataLogin' => $userLogin,
                'satuanData' => $satuanData,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_satuan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createSatuan()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->satuanModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editSatuan()
    {
        $slugSatuan = $this->request->getGet('id');

        $satuanData = $this->satuanModel->where('slug', $slugSatuan)->first();

        $data = [
            'id' => $satuanData['id'],
            'nama' => $this->request->getPost('nama'),
        ];

        $rule = [
            'nama' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->satuanModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteSatuan()
    {
        $slugSatuan = $this->request->getGet('id');

        $satuanData = $this->satuanModel->where('slug', $slugSatuan)->first();

        $data = [
            'id' => $satuanData['id'],
            'status' => '1',
        ];

        $this->satuanModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function spesifikasi()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $spesifikasiData = $this->spesifikasiModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Spesifikasi',
                'userDataLogin' => $userLogin,
                'spesifikasiData' => $spesifikasiData,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_spesifikasi', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createSpesifikasi()
    {
        $data = [
            'spesifikasi' => $this->request->getPost('nama'),
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'spesifikasi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->spesifikasiModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editSpesifikasi()
    {
        $slugSpesifikasi = $this->request->getGet('id');

        $spesifikasiData = $this->spesifikasiModel->where('slug', $slugSpesifikasi)->first();

        $data = [
            'id' => $spesifikasiData['id'],
            'spesifikasi' => $this->request->getPost('nama'),
        ];

        $rule = [
            'spesifikasi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->spesifikasiModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteSpesifikasi()
    {
        $slugSpesifikasi = $this->request->getGet('id');

        $spesifikasiData = $this->spesifikasiModel->where('slug', $slugSpesifikasi)->first();

        $data = [
            'id' => $spesifikasiData['id'],
            'status' => '1',
        ];

        $this->spesifikasiModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function bank()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $bankData = $this->bankModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Bank',
                'userDataLogin' => $userLogin,
                'bankData' => $bankData,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_bank', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createBank()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'rekening' => $this->request->getPost('rekening'),
            'slug' => $this->generateRandomSlug(10),
        ];

        $rule = [
            'nama' => 'required',
            'rekening' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->bankModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editBank()
    {
        $slugBank = $this->request->getGet('id');

        $bankData = $this->bankModel->where('slug', $slugBank)->first();

        $data = [
            'id' => $bankData['id'],
            'nama' => $this->request->getPost('nama'),
            'rekening' => $this->request->getPost('rekening'),
        ];

        $rule = [
            'nama' => 'required',
            'rekening' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->bankModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deleteBank()
    {
        $slugBank = $this->request->getGet('id');

        $bankData = $this->bankModel->where('slug', $slugBank)->first();

        $data = [
            'id' => $bankData['id'],
            'status' => '1',
        ];

        $this->bankModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }

    public function pesanan()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $pesananData = $this->pesananModel->getAllPesananWithProdukAndUser();
            // dd($pesananData);

            $produkSlug = $this->request->getGet('produkSlug');
            // dd($produkSlug);

            $data = [
                'active' => 'Pesanan',
                'userDataLogin' => $userLogin,
                'pesananData' => $pesananData,
                'kodePesanan' => $this->generateRandomSlug(10),
                'semuaProduk' => $this->pesananModel->getAllBarangAndJasa(),
                'alamat' => [
                    'provinsiData' => $this->provinsiModel->findAll(),
                    'kabupatenData' => $this->kabupatenModel->findAll(),
                    'kecamatanData' => $this->kecamatanModel->findAll(),
                ],
                'produkSlug' => $produkSlug,
                'userData' => $this->userModel->where('status', '0')->where('role', '3')->findAll(),
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            // dd($data);

            return view('Be/v_pesanan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function addBuktiPembayaran()
    {
        $slugPesanan = $this->request->getGet('id');

        $dataPesanan = $this->pesananModel->where('slug', $slugPesanan)->first();

        $fileBukti = $this->request->getFile('bukti');

        $namaFile = $fileBukti->getRandomName();
        $fileBukti->move(ROOTPATH . 'public/image/buktiPembayaran/', $namaFile);

        $data = [
            'id' => $dataPesanan['id'],
            'pembayaran' => $namaFile,
        ];

        $this->pesananModel->save($data);
        $this->session->setTempdata('success', 'Bukti Berhasil Di tambahkan', 5);

        return redirect()->back();
    }

    public function selectProduk()
    {
        $produkSlug = $this->request->getGet('produkSlug');
        $barangData = $this->barangModel->where('slug', $produkSlug)->first();
        $jasaData = $this->jasaModel->where('slug', $produkSlug)->first();

        if (!empty($barangData)) {
            $data['produk'] = $barangData;
        } else {
            $data['produk'] = $jasaData;
        }

        return view('be/v_selectProduk.php', $data);
    }

    public function selectUser()
    {
        $userSlug = $this->request->getGet('userSlug');

        $data = [
            'user' => $this->userModel->where('slug', $userSlug)->first(),
            'provinsiData' => $this->provinsiModel->findAll(),
            'kabupatenData' => $this->kabupatenModel->findAll(),
            'kecamatanData' => $this->kecamatanModel->findAll(),
        ];

        return view('be/v_selectUser.php', $data);
    }

    public function createPesanan()
    {
        $pesananSlug = $this->request->getGet('id');
        $jumlahPesanan = $this->request->getPost('jumlahPesanan');
        $produkId = $this->request->getPost('produk');
        $tanggal = $this->request->getPost('tanggal');
        $barangData = $this->barangModel->where('slug', $produkId)->first();
        $jasaData = $this->jasaModel->where('slug', $produkId)->first();

        if (!empty($barangData)) {
            $updateStok = [
                'id' => $barangData['id'],
                'stok' => $barangData['stok'] - $jumlahPesanan,
            ];
            $this->barangModel->save($updateStok);

            $total = $barangData['harga'] * $jumlahPesanan;
            $data = [
                'userId' => $this->request->getPost('namePemesan'),
                'produkId' => $produkId,
                'jumlah' => $jumlahPesanan,
                'total' => $total,
                'validasi' => '0',
                'slug' => $pesananSlug,
            ];
        } elseif (!empty($jasaData)) {
            $total = $jasaData['harga'] * $jumlahPesanan;
            $data = [
                'userId' => $this->request->getPost('namePemesan'),
                'produkId' => $produkId,
                'jumlah' => $jumlahPesanan,
                'total' => $total,
                'tanggal_mulai' => $tanggal,
                'validasi' => '0',
                'slug' => $pesananSlug,
            ];
        }

        $rule = [
            'userId' => 'required',
            'produkId' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->pesananModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di tambahkan', 5);

            return redirect()->back();
        }
    }

    public function editPesanan()
    {
        $slugPesanan = $this->request->getGet('id');

        $pesananData = $this->pesananModel->getPesananAndProdukAndUserWithSlug($slugPesanan);
        $jumlahPesanan = $this->request->getPost('jumlahPesanan');

        // dd($pesananData);
        if (!empty($pesananData[0]->barangHarga)) {
            $total = $pesananData[0]->barangHarga * $jumlahPesanan;
        } elseif (!empty($pesananData[0]->jasaHarga)) {
            $total = $pesananData[0]->jasaHarga * $jumlahPesanan;
        }

        if (empty($pesananData[0]->pesananMulai)) {
            if ($jumlahPesanan == $pesananData[0]->pesananJumlah) {
                $updateStok = [
                    'id' => $pesananData[0]->barangId,
                    'stok' => $pesananData[0]->barangStok,
                ];
                $this->barangModel->save($updateStok);
            } elseif ($jumlahPesanan > $pesananData[0]->pesananJumlah) {
                $jumlahPesananEnd = $jumlahPesanan - $pesananData[0]->pesananJumlah;
                if ($jumlahPesananEnd > $pesananData[0]->barangStok) {
                    $stokBarang = $jumlahPesananEnd - $pesananData[0]->barangStok;
                } elseif ($pesananData[0]->barangStok) {
                    $stokBarang = $pesananData[0]->barangStok - $jumlahPesananEnd;
                }
            } elseif ($jumlahPesanan < $pesananData[0]->pesananJumlah) {
                $jumlahPesananEnd =  $pesananData[0]->pesananJumlah - $jumlahPesanan;
                $stokBarang = $pesananData[0]->barangStok + $jumlahPesananEnd;
            }
            $updateStok = [
                'id' => $pesananData[0]->barangId,
                'stok' => $stokBarang,
            ];
            $this->barangModel->save($updateStok);

            $data = [
                'id' => $pesananData[0]->pesananId,
                'userId' => $this->request->getPost('namePemesan'),
                'produkId' => $this->request->getPost('produk'),
                'jumlah' => $jumlahPesanan,
                'total' => $total,
            ];
        } elseif (!empty($pesananData[0]->pesananMulai)) {
            $data = [
                'id' => $pesananData[0]->pesananId,
                'userId' => $this->request->getPost('namePemesan'),
                'produkId' => $this->request->getPost('produk'),
                'jumlah' => $jumlahPesanan,
                'total' => $total,
                'tanggal_mulai' => $this->request->getPost('tanggal'),
            ];
        }


        $rule = [
            'userId' => 'required',
            'produkId' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->pesananModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
    }

    public function deletePesanan()
    {
        $slugPesanan = $this->request->getGet('id');

        $pesananData = $this->pesananModel->where('slug', $slugPesanan)->first();
        $produkData = $this->pesananModel->getPesananAndProdukAndUserWithSlug($slugPesanan);

        $updateStok = [
            'id' => $produkData[0]->barangId,
            'stok' => $produkData[0]->barangStok + $produkData[0]->pesananJumlah,
        ];

        $this->barangModel->save($updateStok);

        $data = [
            'id' => $pesananData['id'],
            'status' => '1',
        ];

        $this->pesananModel->save($data);
        $this->session->setTempdata('delete', 'Data Dihapus', 5);

        return redirect()->back();
    }


    public function laporanPesanan()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $tanggalMulai = $this->request->getPost('tanggalMulai');
            $tanggalAkhir = $this->request->getPost('tanggalAkhir');
            $pesananData = $this->pesananModel->getAllPesananWithProdukAndUserWhereDate($tanggalMulai, $tanggalAkhir);

            $data = [
                'active' => 'Cetak Pesanan',
                'userDataLogin' => $userLogin,
                'pesananData' => $pesananData,
                'tanggalMulai' => $tanggalMulai,
                'tanggalAkhir' => $tanggalAkhir,
                'totalSemuaPesanan' => $this->pesananModel->getTotalPesanan(),
                'settingsData' => $this->settingsModel->first(),
            ];

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $html = view('Be/pdf/cetakPesanan.php', $data);

            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // sleep(3);2
            $dompdf->stream("Cetak Pesanan Tanggal " . $tanggalMulai . " sampai " . $tanggalAkhir . ".pdf", ["Attachment" => false]);
        } else {
            return redirect()->to('/');
        }
    }

    public function cetakBarang()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $barangData = $this->barangModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Cetak Barang',
                'userDataLogin' => $userLogin,
                'barangData' => $barangData,
            ];

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $html = view('Be/pdf/cetakBarang.php', $data);

            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // sleep(3);2
            $dompdf->stream("Cetak Barang.pdf", ["Attachment" => false]);
        } else {
            return redirect()->to('/');
        }
    }

    public function cetakJasa()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $jasaData = $this->jasaModel->where('status', '0')->findAll();

            $data = [
                'active' => 'Cetak Jasa',
                'userDataLogin' => $userLogin,
                'jasaData' => $jasaData
            ];

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            $html = view('Be/pdf/cetakJasa.php', $data);

            $dompdf->loadHtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // sleep(3);2
            $dompdf->stream("Cetak Jasa.pdf", ["Attachment" => false]);
        } else {
            return redirect()->to('/');
        }
    }

    public function validasi()
    {
        $slugPesanan = $this->request->getGet('id');

        $pesananData = $this->pesananModel->where('slug', $slugPesanan)->first();

        $data = [
            'id' => $pesananData['id'],
            'validasi' => $this->request->getPost('validasi'),
        ];

        $rule = [
            'validasi' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->pesananModel->save($data);
            $this->session->setTempdata('success', 'Data Berhasil Di Validasi', 5);

            return redirect()->back();
        }
    }

    public function cetakInvoicePesanan()
    {
        set_time_limit(120);
        $pesananSlug = $this->request->getGet('id');

        $data = [
            'active' => 'Invoice',
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
        $dompdf->stream("output.pdf", ["Attachment" => false]);
    }

    public function provinsi()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $provinsiData = $this->provinsiModel->findAll();

            $data = [
                'active' => 'Provinsi',
                'userDataLogin' => $userLogin,
                'provinsiData' => $provinsiData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_provinsi', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createProvinsi()
    {
        $data = [
            'name' => $this->request->getPost('nama'),
        ];

        $rule = [
            'name' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->provinsiModel->save($data);

            return redirect()->back();
        }
    }

    public function kabupaten()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $kabupatenData = $this->kabupatenModel->getAllKabupatenWithProvinsi();

            $provinsiData = $this->provinsiModel->findAll();

            $data = [
                'active' => 'Kabupaten',
                'userDataLogin' => $userLogin,
                'kabupatenData' => $kabupatenData,
                'provinsiData' => $provinsiData,
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_kabupaten', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function createKabupaten()
    {
        $data = [
            'province_id' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
        ];

        $rule = [
            'province_id' => 'required',
            'kabupaten' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->kabupatenModel->save($data);

            return redirect()->back();
        }
    }

    public function settings()
    {
        $loginAuth = $this->session->get('auth');
        $userLogin = $this->userModel->where('slug', $loginAuth)->first();
        if (isset($userLogin) || !empty($userLogin)) {
            $settingsData = $this->settingsModel->first();
            $provinsiData = $this->provinsiModel->findAll();
            $kabupatenData = $this->kabupatenModel->findAll();
            $kecamatanData = $this->kecamatanModel->findAll();

            $data = [
                'active' => 'Settings',
                'userDataLogin' => $userLogin,
                'settingsData' => $settingsData,
                'provinsiData' => $provinsiData,
                'kabupatenData' => $kabupatenData,
                'kecamatanData' => $kecamatanData,
                'jumlahValidasiPesanan' => count($this->pesananModel->where('status', '0')->where('validasi', '0')->findAll()),
                'settingsData' => $this->settingsModel->first(),
            ];

            return view('Be/v_settings', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function editSettings()
    {
        $settingskData = $this->settingsModel->first();

        $alamat = [
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kodePos' => $this->request->getPost('kodePos'),
            'jalan' => $this->request->getPost('jalan'),
        ];

        $medsos = [
            'facebook' => $this->request->getPost('facebook'),
            'twitter' => $this->request->getPost('twitter'),
            'instagram' => $this->request->getPost('instagram'),
            'linkedin' => $this->request->getPost('linkedin'),
        ];

        $fileBukti = $this->request->getFile('logo');

        if ($fileBukti->isValid() || $fileBukti->getName()) {
            unlink(ROOTPATH . 'public/image/' . $settingskData['logo']);

            $namaFile = $fileBukti->getRandomName();
            $fileBukti->move(ROOTPATH . 'public/image/', $namaFile);

            $data = [
                'id' => $settingskData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telp'),
                'email' => $this->request->getPost('email'),
                'alamat' => json_encode($alamat),
                'medsos' => json_encode($medsos),
                'logo' => $namaFile,
            ];
        } else {
            $data = [
                'id' => $settingskData['id'],
                'nama' => $this->request->getPost('nama'),
                'telp' => $this->request->getPost('telp'),
                'email' => $this->request->getPost('email'),
                'alamat' => json_encode($alamat),
                'medsos' => json_encode($medsos),
                'logo' => $settingskData['logo'],
            ];
        }

        $rule = [
            'nama' => 'required',
            'telp' => 'required',
        ];

        if (!$this->validateData($data, $rule)) {
            $this->session->set('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            $this->settingsModel->save($data);
            $this->session->setTempdata('edit', 'Data Berhasil Di Edit', 5);

            return redirect()->back();
        }
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
