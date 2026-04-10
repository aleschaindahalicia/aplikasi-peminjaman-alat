<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ActivityLogModel;

class DashboardController extends BaseController
{
    protected $logModel;
    protected $userModel;

    public function __construct()
    {
        $this->logModel = new ActivityLogModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $role = session()->get('role');

        $this->logModel->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengakses dashboard ' . $role
        ]);

        if ($role === 'Admin') return view('dashboard/admin');
        if ($role === 'Petugas') return view('dashboard/petugas');
        return view('dashboard/peminjam');
    }
}