<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Volunteers extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $volunteers = $userModel
            ->where('role', 'VOLUNTEER')
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/volunteers/index', [
            'volunteers' => $volunteers,
        ]);
    }
}