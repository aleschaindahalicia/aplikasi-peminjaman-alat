<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ActivityLogModel;

class ProfileController extends BaseController
{
    protected $model;
    protected $LogModel;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->LogModel = new ActivityLogModel();
    }

    /* ===================== TAMPIL PROFILE ===================== */

    public function index()
    {
        $data['user'] = $this->model->find(session()->get('id_user'));
        return view('profile/index', $data);
    }

    /* ===================== FORM EDIT ===================== */

    public function edit()
    {
        $data['user'] = $this->model->find(session()->get('id_user'));
        return view('profile/edit', $data);
    }

    /* ===================== UPDATE PROFILE ===================== */

    public function update()
    {
        $id = session()->get('id_user');

        $data = [
            'email'     => $this->request->getPost('email'),
            'nama_user' => $this->request->getPost('nama_user'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'alamat'    => $this->request->getPost('alamat')
        ];

        $this->model->update($id, $data);

        $this->LogModel->insert([
            'id_user'  => $id,
            'activity' => 'Mengupdate profile sendiri'
        ]);

        return redirect()->to('/profile')->with('success', 'Profile berhasil diupdate');
    }

    /* ===================== UPDATE PASSWORD ===================== */

    public function updatePassword()
    {
        $id = session()->get('id_user');
        $user = $this->model->find($id);

        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // cek password lama
        if (!password_verify($oldPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }

        // cek konfirmasi password
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak sama');
        }

        // // minimal panjang password
        // if (strlen($newPassword) < 3) {
        //     return redirect()->back()->with('error', 'Password minimal 6 karakter');
        // }

        // update password
        $this->model->update($id, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        $this->LogModel->insert([
            'id_user'  => $id,
            'activity' => 'Mengubah password sendiri'
        ]);

        return redirect()->to('/profile')->with('success', 'Password berhasil diubah');
    }
}