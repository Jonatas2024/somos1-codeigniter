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

    public function new()
    {
        $ministryModel = new MinistryModel();
        $functionModel = new MinistryFunctionModel();

        $ministries = $ministryModel
            ->where('active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        $functions = $functionModel
            ->where('active', true)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/volunteers/new', [
            'ministries' => $ministries,
            'functions' => $functions,
        ]);
    }

    public function create()
    {
        $userModel = new UserModel();
        $userFunctionModel = new UserFunctionModel();

        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));
        $phone = trim((string) $this->request->getPost('phone'));
        $birthDate = $this->request->getPost('birthDate');
        $ministryId = $this->request->getPost('ministryId');
        $functions = $this->request->getPost('functions') ?? [];

        $existingUser = $userModel
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Este e-mail já está cadastrado.');
        }

        $userId = $this->generateUuid();
        $now = date('Y-m-d H:i:s');

        $userModel->insert([
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'phone' => $phone !== '' ? $phone : null,
            'birthDate' => ! empty($birthDate) ? $birthDate : null,
            'image' => null,
            'role' => 'VOLUNTEER',
            'status' => 'ACTIVE',
            'ministryId' => ! empty($ministryId) ? $ministryId : null,
            'createdAt' => $now,
            'updatedAt' => $now,
        ]);

        foreach ($functions as $functionId) {
            $userFunctionModel->insert([
                'id' => $this->generateUuid(),
                'userId' => $userId,
                'functionId' => $functionId,
                'createdAt' => $now,
            ]);
        }

        return redirect()
            ->to(site_url('admin/volunteers'))
            ->with('success', 'Voluntário cadastrado com sucesso.');
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);

        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf(
            '%s%s-%s-%s-%s-%s%s%s',
            str_split(bin2hex($data), 4)
        );
    }
}