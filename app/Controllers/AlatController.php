<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AlatController extends BaseController
{
    protected $AlatModel;
    protected $CategoryModel;

    public function __construct()
    {
        $this->AlatModel = new \App\Models\AlatModel();
        $this->CategoryModel = new \App\Models\CategoryModel();
        $this->logModel = new \App\Models\ActivityLogModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->AlatModel
            ->select('alat.*, category.nama_category')
            ->join('category', 'category.id_category = alat.id_category', 'left');

        // ❗ HAPUS manual deleted_at filter (CI4 sudah handle soft delete)
        
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('alat.nama_alat', $keyword)
                ->orLike('alat.merk_alat', $keyword)
                ->orLike('alat.status', $keyword)
                ->orLike('alat.kondisi', $keyword)
                ->orLike('alat.deskripsi_alat', $keyword)
                ->orLike('category.nama_category', $keyword)
            ->groupEnd();
        }

        $data['alat'] = $builder->findAll();

        return view('alat/index', $data);
    }

    public function create()
    {
        $data['category'] = $this->CategoryModel->findAll();
        return view('alat/create', $data);
    }

    public function store()
    {
        $kondisi = $this->request->getPost('kondisi');
        $status  = $this->request->getPost('status');

        // Jika kondisi Rusak Berat, ubah status menjadi Tidak Tersedia
        if ($kondisi === 'Rusak Berat') {
            $status = 'Tidak Tersedia';
        }

        $this->AlatModel->insert([
            'nama_alat'      => $this->request->getPost('nama_alat'),
            'id_category'    => $this->request->getPost('id_category'),
            'merk_alat'      => $this->request->getPost('merk_alat'),
            'kondisi'        => $kondisi,
            'deskripsi_alat' => $this->request->getPost('deskripsi_alat'),
            'status'         => $status
        ]);

        $this->logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Menambah alat baru:' . $this->request->getPost('nama_alat')
        ]);

        return redirect()->to('/alat')->with('success', 'Alat Baru Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'alat'     => $this->AlatModel->find($id),
            'category' => $this->CategoryModel->findAll()
        ];

        return view('alat/edit', $data);
    }

    public function update($id)
    {
        // Ambil data alat saat ini
        $currentAlat = $this->AlatModel->find($id);
        $newStatus   = $this->request->getPost('status');
        $kondisi     = $this->request->getPost('kondisi');

        // Jika kondisi Rusak Berat, ubah status menjadi Tidak Tersedia
        if ($kondisi === 'Rusak Berat') {
            $newStatus = 'Tidak Tersedia';
        }

        // Validasi perubahan status
        if ($currentAlat['status'] == 'Dibooking' && $newStatus == 'Tersedia') {
            $peminjamanModel = new \App\Models\PeminjamanModel();
            $pendingPeminjaman = $peminjamanModel->where('id_alat', $id)
                                                 ->whereIn('status', ['Menunggu', 'Dibooking'])
                                                 ->first();

            if ($pendingPeminjaman) {
                return redirect()->back()->with('error', 'Tidak dapat mengubah status ke "Tersedia" karena alat sedang dalam proses peminjaman. Batalkan peminjaman terlebih dahulu.');
            }
        }

        if ($currentAlat['status'] == 'Dipinjam' && $newStatus == 'Tersedia') {
            $peminjamanModel = new \App\Models\PeminjamanModel();
            $activePeminjaman = $peminjamanModel->where('id_alat', $id)
                                                ->where('status', 'Dipinjam')
                                                ->first();

            if ($activePeminjaman) {
                return redirect()->back()->with('error', 'Tidak dapat mengubah status ke "Tersedia" karena alat sedang dipinjam. Proses pengembalian terlebih dahulu.');
            }
        }

        $data = [
            'nama_alat'      => $this->request->getPost('nama_alat'),
            'id_category'    => $this->request->getPost('id_category'),
            'merk_alat'      => $this->request->getPost('merk_alat'),
            'deskripsi_alat' => $this->request->getPost('deskripsi_alat'),
            'kondisi'        => $kondisi,
            'status'         => $newStatus,
        ];

        $this->AlatModel->update($id, $data);

        $this->logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengupdate data alat ID:' . $id . ' (Status: ' . $currentAlat['status'] . ' -> ' . $newStatus . ')'
        ]);

        return redirect()->to('/alat')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $alat = $this->AlatModel->find($id);

        if (!$alat) {
            return redirect()->to('/alat')->with('error', 'Alat tidak ditemukan');
        }

        $this->AlatModel->delete($id);
        return redirect()->to('/alat');
    }
}