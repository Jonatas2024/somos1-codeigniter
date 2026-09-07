<?php

namespace App\Models;

use CodeIgniter\Model;

class MinistryModel extends Model
{
    protected $table            = 'Ministry';
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
        'createdAt',
        'updatedAt',
    ];

    protected $useTimestamps = false;
}