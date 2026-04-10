<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;

class ActivityLogController extends BaseController
{
    public function index()
    {
        $model = new ActivityLogModel();

        // Ambil data activity log + email user
        $data['logs'] = $model->select('activity_log.*, user.email')
                              ->join('user', 'user.id_user = activity_log.id_user', 'left')
                              ->orderBy('created_at', 'DESC')
                              ->findAll();

        // Log activity akses activity log
        $model->insert([
            'id_user'  => session()->get('id_user'),
            'activity' => 'Mengakses halaman Activity Log'
        ]);

        return view('admin/activity_log', $data);
    }
}