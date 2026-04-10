<?php

use App\Models\ActivityModel;

function log_activity($activity)
{
    $model = new ActivityLogModel();

    $model->insert([
        'id_user'       => session()->get('id_user'),
        'activity'     => $activity,
        'created_at'    => date('Y-m-d H:i:s')
    ]);
}