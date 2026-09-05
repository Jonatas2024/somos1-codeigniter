<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'User';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
        'name',
        'email',
        'phone',
        'birthDate',
        'image',
        'role',
        'status',
        'ministryId',
        'createdAt',
        'updatedAt',
    ];

    protected $useTimestamps = false;
}