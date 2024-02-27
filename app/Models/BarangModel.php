<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'stok', 'harga', 'satuan', 'gambar', 'deskripsi', 'spesifikasi', 'slug', 'status'];

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

    public function search($id)
    {
        $builder = $this->table($this->table);

        // Lakukan pencarian dengan query LIKE
        $builder->like('nama', $id);

        $builder->where('status', '0');

        // Ambil hasil pencarian
        $query = $builder->get();

        return $query->getResult();
    }

    public function limitData($jumlah)
    {
        $builder = $this->table($this->table);
        $builder->limit($jumlah);
        $builder->where('status', '0');
        
        $query = $builder->get();

        return $query->getResult();
    }
}
