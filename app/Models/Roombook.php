<?php

namespace App\Models;

use CodeIgniter\Model;

class Roombook extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'roombook';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
}
