<?php

namespace App\Models;

use CodeIgniter\Model;

class UserFunctionModel extends Model
{
    protected $table            = 'UserFunction';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
        'userId',
        'functionId',
        'createdAt',
    ];

    protected $useTimestamps = false;
}