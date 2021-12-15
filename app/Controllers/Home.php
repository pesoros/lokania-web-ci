<?php

namespace App\Controllers;
use App\Models\Room;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function sessiondestroy()
    {
        session_start();
        session_destroy();  

        return redirect()->to(base_url('')); 
    }

    public function checkroom()
    {
        $Room = new Room();

        if($this->request->getPost("checkin") && $this->request->getPost("checkout")){
            $_SESSION['checkin_date'] = date('d-m-y', strtotime($this->request->getPost('checkin'))); 
            $_SESSION['checkout_date'] = date('d-m-y', strtotime($this->request->getPost('checkout')));
            $_SESSION['checkin_db'] = date('y-m-d', strtotime($this->request->getPost('checkin'))); 
            $_SESSION['checkout_db'] = date('y-m-d', strtotime($this->request->getPost('checkout')));
            // $_SESSION['datetime1'] = new DateTime($_SESSION['checkin_db']);
            // $_SESSION['datetime2'] = new DateTime($_SESSION['checkout_db']);
            $_SESSION['checkin_unformat'] = $this->request->getPost("checkin"); 
            $_SESSION['checkout_unformat'] = $this->request->getPost("checkout");
            // $_SESSION['interval'] = $_SESSION['datetime1']->diff($_SESSION['datetime2']);
        
            $_SESSION['total_night'] = 2;
        
        }
        if($this->request->getPost("totaladults")){
            $_SESSION['adults'] = $this->request->getPost("totaladults");
        }
        
        if($this->request->getPost("totalchildrens")){
            $_SESSION['childrens'] = $this->request->getPost("totalchildrens");
        }

        $getRoom = $Room->getRoom(array(
            "checkin" => $_SESSION['checkin_unformat'],
            "checkout" => $_SESSION['checkout_unformat'],
        ));

        $roomElement = "";
        foreach ($getRoom as $key => $value) {
            $roomDetail = $Room->getRoomDetail(array(
                "id" => $value['room_id'],
            ));
            $element = "";

            if ($value['availableroom'] == null) {
                foreach ($roomDetail as $keyDetail => $valueDetail) {
                    $element .=  "					<p><h4>".$valueDetail['room_name']."</h4></p>\n";
                    $element .=  "					<div class=\"row\">\n";
                    $element .=  "					\n";
                    $element .=  "						<div class=\"large-4 columns\">\n";
                    $element .=  "							<img src=\"".$valueDetail['imgpath']."\"></img>\n";
                    $element .=  "						</div>\n";
                    $element .=  "						<div class=\"large-4 columns\">\n";
                    $element .=  "						<p><span class=\"fontgrey\">Occupancy : </span> ".$valueDetail['occupancy']."<br>\n";
                    $element .=  "						<span class=\"fontgrey\">Size : </span> ".$valueDetail['size']."\n";
                    $element .=  "						<br><span class=\"fontgrey\">View : </span> ".$valueDetail['view']."</p>\n";
                    $element .=  "\n";
                    $element .=  "						</div>\n";
                    $element .=  "						<div class=\"large-4 columns\">\n";
                    $element .=  "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">".$valueDetail['rate']."</span><span class=\"fontgrey\">/ night</span><br>\n";
                    $element .=  "						<span style=\"text-align:right;\">".$valueDetail['total_room']." room available</span>\n";
                    $element .=  "						</p>\n";
                    $element .=  "							<div class=\"row\">\n";
                    $element .=  "								<div class=\"large-11 columns\">\n";
                    $element .=  "									<label class=\"fontcolor\">\n";
                    $element .=  "										<select  class=\"no_of_room\" name=\"qtyroom".$valueDetail['room_id']."\"  id=\"room".$valueDetail['room_id']."\" onChange=\"selection(".$valueDetail['room_id'].")\" style=\"width:100%; color:black; height:45px;\" >\n";
                    $element .=  "											<option value=\"0\">0</option>\n";
                                                                    $i = 1;
                                                                    while($i <= $valueDetail['total_room'])
                                                                    {
                    $element .=  "											<option value=\"".$i."\">".$i."</option>\n";	
                                                                    $i = $i+1;
                                                                    }
                    $element .=  "										</select>\n";
                    $element .=  "									</label>\n";
                    $element .=  "								</div>\n";
                    $element .=  "								<div class=\"large-1 columns\">\n";
                    $element .=  "<input type=hidden name=\"selectedroom".$valueDetail['room_id']."\" value=\"".$valueDetail['room_id']."\">";
                    $element .=  "<input type=hidden name=\"room_name".$valueDetail['room_id']."\" value=\"".$valueDetail['room_name']."\">";
                    //$element .=  "				<button type=\"submit\"  class=\"book button small\" style=\"background-color:#2ecc71; width:100%; height:45px; !important;\" >Book</button>\n";	
                    $element .=  "								</div>\n";
                    $element .=  "							</div>\n";
                    $element .=  "						</div>\n";
                    $element .=  "						\n";
                    $element .=  "					</div>\n";
                    $element .=  "					\n";
                    $element .=  "				<hr>";

                    $roomElement .= $element;
                }
            } else {
                foreach ($roomDetail as $keyDetail => $valueDetail) {
                    $element .= "					<p><h4>".$valueDetail['room_name']."</h4></p>\n";
                    $element .= "					<div class=\"row\">\n";
                    $element .= "					\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "							<img src=\"".$valueDetail['imgpath']."\"></img>\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p><span class=\"fontgrey\">Occupancy : </span> ".$valueDetail['occupancy']."<br>\n";
                    $element .= "						<span class=\"fontgrey\">Size : </span> ".$valueDetail['size']."\n";
                    $element .= "						<br><span class=\"fontgrey\">View : </span> ".$valueDetail['view']."</p>\n";
                    $element .= "\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">".$valueDetail['rate']."</span><span class=\"fontgrey\">/ night</span><br>\n";
                    $element .= "						<span style=\"text-align:right;\">".$value['availableroom']." room available</span>\n";
                    $element .= "						</p>\n";
                    $element .= "							<div class=\"row\">\n";
                    $element .= "								<div class=\"large-11 columns\">\n";
                    $element .= "									<label class=\"fontcolor\">\n";
                    $element .= "										<select  class=\"no_of_room\" name=\"qtyroom".$valueDetail['room_id']."\" id=\"room".$valueDetail['room_id']."\" onChange=\"selection(".$valueDetail['room_id'].")\"  style=\"width:100%; color:black; height:45px;\" ;\">\n";
                    $element .= "											<option  value=\"0\">0</option>\n";
                                                                    $i = 1;
                                                                    while($i <= $value['availableroom'])
                                                                    {
                    $element .= "											<option value=\"".$i."\">".$i."</option>\n";	
                                                                    $i = $i+1;
                                                                    }
                    $element .= "										</select>\n";
                    $element .= "									</label>\n";
                    $element .= "								</div>\n";
                    $element .= "								<div class=\"large-1 columns\">\n";
                    $element .= "<input type=hidden name=\"selectedroom".$valueDetail['room_id']."\"  id=\"selectedroom".$valueDetail['room_id']."\" value=\"".$valueDetail['room_id']."\">";
                    $element .= "<input type=hidden name=\"room_name".$valueDetail['room_id']."\" id=\"room_name".$valueDetail['room_id']."\" value=\"".$valueDetail['room_name']."\">";
                    $element .= "								</div>\n";
                    $element .= "							</div>\n";
                    $element .= "						</div>\n";
                    $element .= "						\n";
                    $element .= "					</div>\n";
                    $element .= "					\n";
                    $element .= "				<hr>";

                    $roomElement .= $element;
                }
            }
        }

        $result['roomElement'] = $roomElement;

        return view('home/checkroom', $result);
    }
}
