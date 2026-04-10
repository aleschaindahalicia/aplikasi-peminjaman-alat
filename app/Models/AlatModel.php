<?php

namespace App\Models;

use CodeIgniter\Model;

class AlatModel extends Model
{
    protected $table            = 'alat';
    protected $primaryKey       = 'id_alat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_alat',
        'id_category',
        'merk_alat',
        'kondisi',
        'status',
        'deskripsi_alat'
    ];

    public function getAlatWithCategory()
    {
        return $this->select('alat.*, category.nama_category')
                    ->join('category', 'category.id_category = alat.id_category', 'left')
                    ->findAll();
    }

    public function getAlatFiltered($keyword = null, $category = null)
    {
        $builder = $this->select('alat.*, category.nama_category')
                        ->join('category', 'category.id_category = alat.id_category', 'left');

        if ($keyword) {
            $builder->like('alat.nama_alat', $keyword)
                    ->orlike('merk_alat', $keyword);
        }

        if ($category) {
            $builder->where('alat.id_category', $category);
        }

        return $builder;
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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
}