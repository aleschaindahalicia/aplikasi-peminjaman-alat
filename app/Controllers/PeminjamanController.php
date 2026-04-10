<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlatModel;
use App\Models\PeminjamanModel;
use App\Models\ActivityLogModel;

class PeminjamanController extends BaseController
{
    protected $AlatModel;
    protected $PeminjamanModel;
    protected $LogModel;

    public function __construct()
    {
        $this->AlatModel = new AlatModel();
        $this->PeminjamanModel = new PeminjamanModel();
        $this->LogModel = new ActivityLogModel();
    }

    public function index()
    {
        //
    }

    public function store()
    {
        $id_alat = $this->request->getPost('id_alat');
        $alat = $this->AlatModel->find($id_alat);

        $this->PeminjamanModel->insert([
            'id_user'        => session()->get('id_user'),
            'id_alat'        => $id_alat,
            'status'         => 'Menunggu',
            'tanggal_pinjam' => date('Y-m-d')
        ]);

        $this->AlatModel->update($id_alat, [
            'status' => 'Dibooking'
        ]);

        $this->LogModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengajukan peminjaman: ' . $alat['nama_alat']
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Berhasil ajukan');
    }

    public function create($id)
    {
        $data['alat'] = $this->AlatModel->find($id);

        if (!$data['alat']) {
            return redirect()->back()->with('error', 'Alat tidak ditemukan');
        }

        return view('peminjaman/create', $data);
    }

        public function edit($id)
    {
        $data['edit'] = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        if (!$data['edit']) {
            return redirect()->to('/admin/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        return view('admin/peminjaman_edit', $data);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');
        $alasan = $this->request->getPost('alasan_penolakan');

        $dataUpdate = ['status' => $status];

        if ($status === 'Ditolak') {
            $dataUpdate['alasan_penolakan'] = $alasan;
            
            // Kembalikan alat ke tersedia
            $pinjam = $this->PeminjamanModel->find($id);
            $this->AlatModel->update($pinjam['id_alat'], ['status' => 'Tersedia']);
        } else {
            $dataUpdate['alasan_penolakan'] = null;
        }

        $this->PeminjamanModel->update($id, $dataUpdate);

        return redirect()->to('/admin/peminjaman')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->PeminjamanModel->delete($id);

        return redirect()->to('/admin/peminjaman')->with('success', 'Data berhasil dihapus');
    }

    public function setujui($id)
    {
        if (session()->get('role') !== 'Petugas') {
            return redirect()->to('/dashboard');
        }

        $pinjam = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        $this->PeminjamanModel->update($id, [
            'status' => 'Dipinjam'
        ]);

        $this->AlatModel->update($pinjam['id_alat'], [
            'status' => 'Dipinjam'
        ]);

        $this->LogModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Setujui peminjaman: ' . $pinjam['nama_alat']
        ]);

        return redirect()->back();
    }

    public function dataPeminjaman()
    {
        $userId = session()->get('id_user');
        $role   = session()->get('role');
        $search = $this->request->getGet('search');

        $builder = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, alat.merk_alat, category.nama_category, user.nama_user, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('category', 'category.id_category = alat.id_category')
            ->join('user', 'user.id_user = peminjaman.id_user');

        // 🔍 SEARCH GLOBAL
        if ($search) {
            $builder->groupStart()
                ->like('alat.nama_alat', $search)
                ->orLike('alat.merk_alat', $search)
                ->orLike('category.nama_category', $search)
                ->orLike('peminjaman.status', $search)
                ->orLike('user.nama_user', $search)
                ->orLike('user.email', $search)
            ->groupEnd();
        }

        // role filter
        if ($role !== 'Admin' && $role !== 'Petugas') {
            $builder->where('peminjaman.id_user', $userId);
        }

        $data['peminjaman'] = $builder->orderBy('id_peminjaman', 'DESC')->findAll();

        if ($role == 'Admin') {
            return view('admin/peminjaman', $data);
        } elseif ($role == 'Petugas') {
            return view('petugas/peminjaman', $data);
        } else {
            return view('peminjaman/index', $data);
        }
    }

    public function prosesTolak($id)
    {
        if (session()->get('role') !== 'Petugas') {
            return redirect()->to('/dashboard');
        }

        $alasan = $this->request->getPost('alasan_penolakan');

        $pinjam = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        $this->PeminjamanModel->update($id, [
            'status' => 'Ditolak',
            'alasan_penolakan' => $alasan
        ]);
    

        $this->AlatModel->update($pinjam['id_alat'], [
            'status' => 'Tersedia'
        ]);

        $this->LogModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Tolak: ' . $pinjam['nama_alat'] . ' | Alasan: ' . $alasan
        ]);

        return redirect()->to('/petugas/peminjaman');
    }

    public function ajukanPengembalian($id)
    {
        $pinjam = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->PeminjamanModel->update($id, [
            'status' => 'Menunggu Pengembalian'
        ]);

        $this->LogModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengajukan pengembalian: ' . $pinjam['nama_alat']
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Pengembalian diajukan');
    }

    public function validasiPengembalian($id)
    {
        if (session()->get('role') !== 'Petugas') {
            return redirect()->to('/dashboard');
        }

        $pinjam = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        $this->PeminjamanModel->update($id, [
            'status' => 'Dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        $this->AlatModel->update($pinjam['id_alat'], [
            'status' => 'Tersedia'
        ]);

        $this->LogModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Validasi pengembalian: ' . $pinjam['nama_alat']
        ]);

        return redirect()->back();
    }

    public function tolak($id)
    {
        if (session()->get('role') !== 'Petugas') {
            return redirect()->to('/dashboard');
        }

        $pinjam = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['peminjaman'] = $pinjam;

        return view('petugas/tolak_peminjaman', $data);
    }

    public function cetakLaporanPengembalian($id)
    {
        $data['pengembalian'] = $this->PeminjamanModel
            ->select('peminjaman.*, alat.nama_alat, user.email')
            ->join('alat', 'alat.id_alat = peminjaman.id_alat')
            ->join('user', 'user.id_user = peminjaman.id_user')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        return view('laporan/cetak_pengembalian', $data);
    }
}