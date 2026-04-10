<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    public function index()
    {
        $model = new \App\Models\CategoryModel();

        $data['category'] = $model->findAll();

        return view('category/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/category');
        }

        return view('category/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/category');
        }

        $model = new \App\Models\CategoryModel();

        $model->insert([
            'nama_category' => $this->request->getPost('nama_category')
        ]);

        return redirect()->to('/category')->with('success', 'Kategori ditambah');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/category');
        }

        $model = new \App\Models\CategoryModel();

        $data['category'] = $model->find($id);

        return view('category/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/category');
        }

        $model = new \App\Models\CategoryModel();

        $model->update($id, [
            'nama_category' => $this->request->getPost('nama_category')
        ]);

        return redirect()->to('/category')->with('success', 'Kategori diupdate');
    }

    public function delete($id)
    {
        $alatModel = new \App\Models\AlatModel();
        $categoryModel = new \App\Models\CategoryModel();

        // cek apakah ada alat yang pakai kategori ini
        $cek = $alatModel->where('id_category', $id)->countAllResults();

        if ($cek > 0) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena masih ada data alat dengan kategori ini!');
        }

        // kalau aman, baru hapus
        $categoryModel->delete($id);

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
