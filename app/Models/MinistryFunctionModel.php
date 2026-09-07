<?php

namespace App\Models;

use CodeIgniter\Model;

class MinistryFunctionModel extends Model
{
    protected $table            = 'MinistryFunction';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
        'name',
        'description',
        'active',
        'ministryId',
        'createdAt',
        'updatedAt',
    ];

    protected $useTimestamps = false;
}