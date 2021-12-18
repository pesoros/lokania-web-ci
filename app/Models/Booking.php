<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{
    protected $table            = 'booking';
    protected $primaryKey       = 'booking_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields = [
        'booking_id',
        'total_adult',
        'total_children',
        'checkin_date',
        'checkout_date',
        'special_requirement',
        'payment_status',
        'total_amount',
        'deposit',
        'first_name',
        'last_name',
        'email',
        'telephone_no',
        'add_line1',
        'add_line2',
        'city',
        'state',
        'postcode',
        'country'
    ];
}
