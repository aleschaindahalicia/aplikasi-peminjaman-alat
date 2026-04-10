<?php
  
namespace App\Controllers;

use App\Controllers\BaseController;  
use App\Models\UserModel;
  
class UserController extends BaseController
  
{
    protected $UserModel;
  
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
  
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $builder = $this->UserModel;
  
        if ($keyword) {  
            $builder = $builder->like('nama_user', $keyword)
                               ->orLike('email', $keyword);
            
            // Log activity untuk pencarian

            $logModel = new \App\Models\ActivityLogModel();  
            $logModel->insert([
                'id_user'  => session()->get('id_user'),
                'activity' => 'Mencari user dengan keyword: ' . $keyword
            ]);
        }
  
        $data['user'] = $builder->findAll();

        return view('admin/user', $data);  
    }
  
    public function create()
    {
        return view('admin/user_create');
    }
  
    public function store()
    {
        // Validasi email unik
  
        $email = $this->request->getPost('email');
        $existingUser = $this->UserModel->where('email', $email)->first();
        
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email sudah digunakan oleh user lain');
        }
  
        $data = [  
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $email,
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_hp'     => $this->request->getPost('no_hp'),
            'alamat'    => $this->request->getPost('alamat'),
            'role'      => $this->request->getPost('role')
        ];
  
        $this->UserModel->insert($data);
  
        $logModel = new \App\Models\ActivityLogModel();
        $logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Menambah user baru: ' . $email
        ]);
  
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }
  
    public function edit($id)
    {
        $data['editUser'] = $this->UserModel->find($id);
  
        if (!$data['editUser']) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan');
        }
  
        return view('admin/user_edit', $data);
    }
  
    public function update($id)
    {
        // Validasi email unik (kecuali untuk user yang sedang diedit)
  
        $email = $this->request->getPost('email');
        $existingUser = $this->UserModel->where('email', $email)->where('id_user !=', $id)->first();
    
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email sudah digunakan oleh user lain');
        }
  
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $email,
            'no_hp'     => $this->request->getPost('no_hp'),
            'alamat'    => $this->request->getPost('alamat'),
            'role'      => $this->request->getPost('role')
        ];
  
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
  
        $this->UserModel->update($id, $data);
  
        $logModel = new \App\Models\ActivityLogModel();
        $logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengupdate user ID:' . $id
        ]);
  
        return redirect()->to('/user')->with('success', 'User berhasil diupdate');
    }
  
    public function delete($id)
    {
        $this->UserModel->delete($id);

        $logModel = new \App\Models\ActivityLogModel();  
        $logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Menghapus user ID:' . $id
        ]);
  
        return redirect()->to('/user')->with('success', 'User berhasil dihapus');
    }
}