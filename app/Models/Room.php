<?php

namespace App\Models;

use CodeIgniter\Model;

class Room extends Model
{
    protected $table            = 'room';
    protected $primaryKey       = 'room_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
    }

    public function getRoomAll()
    {
        $query = $this->db->query("
            select room.* from room 
        ");

        return $query->getResult('array');
    }

    public function getRoomAvail($data = array())
    {
        $datestart =  $data['checkin'];
        $dateend =  $data['checkout'];

        $query = $this->db->query("
            SELECT r.room_id, (r.total_room-br.total) as availableroom from room as r LEFT JOIN ( 	
            SELECT roombook.room_id, sum(roombook.totalroombook) as total from roombook where roombook.booking_id IN 
                (
                    SELECT b.booking_id as bookingID from booking as b 
                    where 
                    (b.checkin_date between '".$datestart."' AND '".$dateend."') 
                    OR 
                    (b.checkout_date between '".$dateend."' AND '".$datestart."')
                )
            
            group by roombook.room_id
            )
            as br
            ON r.room_id = br.room_id
        ");

        return $query->getResult('array');
    }

    public function getRoomAvailDetail($data = array())
    {
        $id =  $data['id'];

        $query = $this->db->query("
            select room.* from room where room.room_id = ".$id."
        ");

        return $query->getResult('array');
    }
}
