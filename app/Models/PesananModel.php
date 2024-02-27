<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userId', 'produkId', 'jumlah', 'total', 'tanggal_mulai', 'pembayaran', 'validasi', 'slug', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPesananWithProdukAndUser($slug)
    {
        $builder = $this->db->table('tbl_pesanan');
        $builder->select('tbl_pesanan.id, tbl_user.nama AS userNama, tbl_pesanan.produkId, tbl_pesanan.jumlah, tbl_pesanan.total,tbl_pesanan.tanggal_mulai,tbl_pesanan.validasi, tbl_pesanan.pembayaran, tbl_pesanan.slug, tbl_barang.id AS barangId, tbl_barang.nama AS barangNama, tbl_barang.harga AS barangHarga, tbl_barang.gambar AS barangGambar,tbl_barang.slug AS barangSlug, tbl_jasa.id AS jasaId, tbl_jasa.nama AS jasaNama, tbl_jasa.harga AS jasaHarga, tbl_jasa.gambar AS jasaGambar,tbl_jasa.slug AS jasaSlug');
        $builder->join('tbl_barang', 'tbl_pesanan.produkId = tbl_barang.slug', 'left');
        $builder->join('tbl_jasa', 'tbl_pesanan.produkId = tbl_jasa.slug', 'left');
        $builder->join('tbl_user', 'tbl_pesanan.userId = tbl_user.slug', 'left');
        $builder->where('userId', $slug);
        $builder->where('tbl_pesanan.status', '0');
        return $builder->get()->getResult();
    }

    public function getPesananAndProdukAndUserWithSlug($slug)
    {
        $builder = $this->db->table('tbl_pesanan');
        $builder->select('tbl_pesanan.id AS pesananId, tbl_user.nama AS userNama, tbl_user.alamat AS userAlamat,tbl_user.telp AS userTelp,tbl_user.email AS userEmail, tbl_pesanan.produkId AS pesananProduk, tbl_pesanan.jumlah AS pesananJumlah, tbl_pesanan.total AS pesananTotal ,tbl_pesanan.tanggal_mulai AS pesananMulai, tbl_pesanan.pembayaran AS pesananPembayaran, tbl_pesanan.validasi AS pesananValidasi, tbl_pesanan.slug AS pesananSlug, tbl_pesanan.created_at AS pesananCreated, tbl_barang.id AS barangId, tbl_barang.nama AS barangNama, tbl_barang.stok AS barangStok, tbl_barang.harga AS barangHarga, tbl_barang.satuan AS barangSatuan, tbl_barang.gambar AS barangGambar, tbl_jasa.id AS jasaId, tbl_jasa.nama AS jasaNama, tbl_jasa.harga AS jasaHarga, tbl_jasa.satuan AS jasaSatuan, tbl_jasa.gambar AS jasaGambar');
        $builder->join('tbl_barang', 'tbl_pesanan.produkId = tbl_barang.slug', 'left');
        $builder->join('tbl_jasa', 'tbl_pesanan.produkId = tbl_jasa.slug', 'left');
        $builder->join('tbl_user', 'tbl_pesanan.userId = tbl_user.slug', 'left');
        $builder->where('tbl_pesanan.slug', $slug);
        $builder->where('tbl_pesanan.status', '0');
        return $builder->get()->getResult();
    }

    public function getAllPesananWithProdukAndUser()
    {
        $builder = $this->db->table('tbl_pesanan');
        $builder->select('tbl_pesanan.id AS pesananId, tbl_user.nama AS userNama, tbl_user.alamat AS userAlamat, tbl_user.slug AS userSlug, tbl_pesanan.produkId AS pesananProduk, tbl_pesanan.jumlah AS pesananJumlah, tbl_pesanan.total AS pesananTotal ,tbl_pesanan.tanggal_mulai AS pesananMulai, tbl_pesanan.pembayaran AS pesananPembayaran, tbl_pesanan.validasi AS pesananValidasi, tbl_pesanan.slug AS pesananSlug, tbl_barang.id AS barangId, tbl_barang.nama AS barangNama, tbl_barang.stok AS barangStok, tbl_barang.harga AS barangHarga, tbl_barang.satuan AS barangSatuan, tbl_barang.gambar AS barangGambar, tbl_barang.slug AS barangSlug, tbl_jasa.id AS jasaId, tbl_jasa.nama AS jasaNama, tbl_jasa.harga AS jasaHarga, tbl_jasa.satuan AS jasaSatuan, tbl_jasa.gambar AS jasaGambar, tbl_jasa.slug AS jasaSlug');
        $builder->join('tbl_barang', 'tbl_pesanan.produkId = tbl_barang.slug', 'left');
        $builder->join('tbl_jasa', 'tbl_pesanan.produkId = tbl_jasa.slug', 'left');
        $builder->join('tbl_user', 'tbl_pesanan.userId = tbl_user.slug', 'left');
        $builder->where('tbl_pesanan.status', '0');
        $builder->orderBy('tbl_pesanan.id', 'DESC');
        return $builder->get()->getResult();
    }

    public function getAllPesananWithProdukAndUserWhereDate($awal, $akhir)
    {
        $builder = $this->db->table('tbl_pesanan');
        $builder->select('tbl_pesanan.id AS pesananId, tbl_user.nama AS userNama, tbl_user.alamat AS userAlamat, tbl_pesanan.produkId AS pesananProduk, tbl_pesanan.jumlah AS pesananJumlah, tbl_pesanan.total AS pesananTotal ,tbl_pesanan.tanggal_mulai AS pesananMulai, tbl_pesanan.pembayaran AS pesananPembayaran, tbl_pesanan.validasi AS pesananValidasi,tbl_pesanan.created_at AS pesananCreated, tbl_pesanan.slug AS pesananSlug, tbl_barang.id AS barangId, tbl_barang.nama AS barangNama, tbl_barang.stok AS barangStok, tbl_barang.harga AS barangHarga, tbl_barang.satuan AS barangSatuan, tbl_barang.gambar AS barangGambar, tbl_jasa.id AS jasaId, tbl_jasa.nama AS jasaNama, tbl_jasa.harga AS jasaHarga, tbl_jasa.satuan AS jasaSatuan, tbl_jasa.gambar AS jasaGambar');
        $builder->join('tbl_barang', 'tbl_pesanan.produkId = tbl_barang.slug', 'left');
        $builder->join('tbl_jasa', 'tbl_pesanan.produkId = tbl_jasa.slug', 'left');
        $builder->join('tbl_user', 'tbl_pesanan.userId = tbl_user.slug', 'left');
        $builder->where('DATE(tbl_pesanan.created_at) >=', $awal);
        $builder->where('DATE(tbl_pesanan.created_at) <=', $akhir);
        $builder->where('tbl_pesanan.status', '0');
        $builder->orderBy('tbl_pesanan.id', 'DESC');
        return $builder->get()->getResult();
    }

    public function getAllBarangAndJasa()
    {
        $barang = $this->db->query("SELECT * FROM tbl_barang WHERE status=0")->getResult();
        $jasa = $this->db->query("SELECT * FROM tbl_jasa WHERE status=0")->getResult();

        return array_merge($barang, $jasa);
    }

    public function getTotalPesanan()
    {
        $builder = $this->db->table('tbl_pesanan');
        $builder->selectSum('total');
        $builder->where('status', '0');
        $query = $builder->get();
        $result = $query->getRow();
        return $result->total;
    }
}
