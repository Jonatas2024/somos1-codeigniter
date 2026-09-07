<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MinistryModel;
use App\Models\MinistryFunctionModel;
use App\Models\UserFunctionModel;

class Volunteers extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $ministryModel = new MinistryModel();
        $functionModel = new MinistryFunctionModel();
        $userFunctionModel = new UserFunctionModel();

        $volunteers = $userModel
            ->where('role', 'VOLUNTEER')
            ->orderBy('name', 'ASC')
            ->findAll();

        foreach ($volunteers as &$volunteer) {
            $volunteer['ministry'] = null;
            $volunteer['functions'] = [];

            if (! empty($volunteer['ministryId'])) {
                $volunteer['ministry'] = $ministryModel->find($volunteer['ministryId']);
            }

            $userFunctions = $userFunctionModel
                ->where('userId', $volunteer['id'])
                ->findAll();

            foreach ($userFunctions as $userFunction) {
                $function = $functionModel->find($userFunction['functionId']);

                if ($function) {
                    $volunteer['functions'][] = $function;
                }
            }
        }

        return view('admin/volunteers/index', [
            'volunteers' => $volunteers,
        ]);
    }
}