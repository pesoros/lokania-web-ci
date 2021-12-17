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
        $session = session();
        $Room = new Room();

        if ($this->request->getPost("checkin") && $this->request->getPost("checkout")) {
            $toSession['checkin_date'] = date('d-m-y', strtotime($this->request->getPost('checkin')));
            $toSession['checkout_date'] = date('d-m-y', strtotime($this->request->getPost('checkout')));
            $toSession['checkin_db'] = date('y-m-d', strtotime($this->request->getPost('checkin')));
            $toSession['checkout_db'] = date('y-m-d', strtotime($this->request->getPost('checkout')));
            // $toSession['datetime1'] = new DateTime($toSession['checkin_db']);
            // $toSession['datetime2'] = new DateTime($toSession['checkout_db']);
            $toSession['checkin_unformat'] = $this->request->getPost("checkin");
            $toSession['checkout_unformat'] = $this->request->getPost("checkout");
            // $toSession['interval'] = $toSession['datetime1']->diff($toSession['datetime2']);

            $toSession['total_night'] = 2;

        }
        if ($this->request->getPost("totaladults")) {
            $toSession['adults'] = $this->request->getPost("totaladults");
        }

        if ($this->request->getPost("totalchildrens")) {
            $toSession['childrens'] = $this->request->getPost("totalchildrens");
        }

        $getRoom = $Room->getRoomAvail(array(
            "checkin" => $toSession['checkin_unformat'],
            "checkout" => $toSession['checkout_unformat'],
        ));

        $session->set($toSession);

        $roomElement = "";
        foreach ($getRoom as $key => $value) {
            $roomDetail = $Room->getRoomAvailDetail(array(
                "id" => $value['room_id'],
            ));
            $element = "";

            if ($value['availableroom'] == null) {
                foreach ($roomDetail as $keyDetail => $valueDetail) {
                    $element .= "					<p><h4>" . $valueDetail['room_name'] . "</h4></p>\n";
                    $element .= "					<div class=\"row\">\n";
                    $element .= "					\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "							<img src=\"" . $valueDetail['imgpath'] . "\"></img>\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p><span class=\"fontgrey\">Occupancy : </span> " . $valueDetail['occupancy'] . "<br>\n";
                    $element .= "						<span class=\"fontgrey\">Size : </span> " . $valueDetail['size'] . "\n";
                    $element .= "						<br><span class=\"fontgrey\">View : </span> " . $valueDetail['view'] . "</p>\n";
                    $element .= "\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">" . $valueDetail['rate'] . "</span><span class=\"fontgrey\">/ night</span><br>\n";
                    $element .= "						<span style=\"text-align:right;\">" . $valueDetail['total_room'] . " room available</span>\n";
                    $element .= "						</p>\n";
                    $element .= "							<div class=\"row\">\n";
                    $element .= "								<div class=\"large-11 columns\">\n";
                    $element .= "									<label class=\"fontcolor\">\n";
                    $element .= "										<select  class=\"no_of_room\" name=\"qtyroom" . $valueDetail['room_id'] . "\"  id=\"room" . $valueDetail['room_id'] . "\" onChange=\"selection(" . $valueDetail['room_id'] . ")\" style=\"width:100%; color:black; height:45px;\" >\n";
                    $element .= "											<option value=\"0\">0</option>\n";
                    $i = 1;
                    while ($i <= $valueDetail['total_room']) {
                        $element .= "											<option value=\"" . $i . "\">" . $i . "</option>\n";
                        $i = $i + 1;
                    }
                    $element .= "										</select>\n";
                    $element .= "									</label>\n";
                    $element .= "								</div>\n";
                    $element .= "								<div class=\"large-1 columns\">\n";
                    $element .= "<input type=hidden name=\"selectedroom" . $valueDetail['room_id'] . "\" value=\"" . $valueDetail['room_id'] . "\">";
                    $element .= "<input type=hidden name=\"room_name" . $valueDetail['room_id'] . "\" value=\"" . $valueDetail['room_name'] . "\">";
                    //$element .=  "                <button type=\"submit\"  class=\"book button small\" style=\"background-color:#2ecc71; width:100%; height:45px; !important;\" >Book</button>\n";
                    $element .= "								</div>\n";
                    $element .= "							</div>\n";
                    $element .= "						</div>\n";
                    $element .= "						\n";
                    $element .= "					</div>\n";
                    $element .= "					\n";
                    $element .= "				<hr>";

                    $roomElement .= $element;
                }
            } else {
                foreach ($roomDetail as $keyDetail => $valueDetail) {
                    $element .= "					<p><h4>" . $valueDetail['room_name'] . "</h4></p>\n";
                    $element .= "					<div class=\"row\">\n";
                    $element .= "					\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "							<img src=\"" . $valueDetail['imgpath'] . "\"></img>\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p><span class=\"fontgrey\">Occupancy : </span> " . $valueDetail['occupancy'] . "<br>\n";
                    $element .= "						<span class=\"fontgrey\">Size : </span> " . $valueDetail['size'] . "\n";
                    $element .= "						<br><span class=\"fontgrey\">View : </span> " . $valueDetail['view'] . "</p>\n";
                    $element .= "\n";
                    $element .= "						</div>\n";
                    $element .= "						<div class=\"large-4 columns\">\n";
                    $element .= "						<p ><span class=\"fontgrey\">Rate : MYR </span><span style=\"font-size:24px;\">" . $valueDetail['rate'] . "</span><span class=\"fontgrey\">/ night</span><br>\n";
                    $element .= "						<span style=\"text-align:right;\">" . $value['availableroom'] . " room available</span>\n";
                    $element .= "						</p>\n";
                    $element .= "							<div class=\"row\">\n";
                    $element .= "								<div class=\"large-11 columns\">\n";
                    $element .= "									<label class=\"fontcolor\">\n";
                    $element .= "										<select  class=\"no_of_room\" name=\"qtyroom" . $valueDetail['room_id'] . "\" id=\"room" . $valueDetail['room_id'] . "\" onChange=\"selection(" . $valueDetail['room_id'] . ")\"  style=\"width:100%; color:black; height:45px;\" ;\">\n";
                    $element .= "											<option  value=\"0\">0</option>\n";
                    $i = 1;
                    while ($i <= $value['availableroom']) {
                        $element .= "											<option value=\"" . $i . "\">" . $i . "</option>\n";
                        $i = $i + 1;
                    }
                    $element .= "										</select>\n";
                    $element .= "									</label>\n";
                    $element .= "								</div>\n";
                    $element .= "								<div class=\"large-1 columns\">\n";
                    $element .= "<input type=hidden name=\"selectedroom" . $valueDetail['room_id'] . "\"  id=\"selectedroom" . $valueDetail['room_id'] . "\" value=\"" . $valueDetail['room_id'] . "\">";
                    $element .= "<input type=hidden name=\"room_name" . $valueDetail['room_id'] . "\" id=\"room_name" . $valueDetail['room_id'] . "\" value=\"" . $valueDetail['room_name'] . "\">";
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

    public function guestroom()
    {
        $session = session();
        $Room = new Room();
        
        if (!isset($toSession['room_id'])) {

            $toSession['room_id'] = array();

            $toSession['roomname'] = array();

            $toSession['roomqty'] = array();
            $toSession['ind_rate'] = array();
            $toSession['total_amount'] = 0;
            $toSession['deposit'] = 0;
        }

        $getRoomAll = $Room->getRoomAll();
        
        foreach ($getRoomAll as $key => $row) {
            if (isset($_POST["qtyroom" . $row['room_id'] . ""]) && !empty($_POST["qtyroom" . $row['room_id'] . ""])) {
                $toSession['room_id'][$key] = $_POST["selectedroom" . $row['room_id'] . ""];
                $toSession['roomqty'][$key] = $_POST["qtyroom" . $row['room_id'] . ""];
                $toSession['roomname'][$key] = $_POST["room_name" . $row['room_id'] . ""];

                $toSession['ind_rate'][$key] = $row['rate'] * $_POST["qtyroom" . $row['room_id'] . ""];
                $toSession['total_amount'] = ($row['rate'] * $_POST["qtyroom" . $row['room_id'] . ""] * session('total_night')) + $toSession['total_amount'];
                $toSession['deposit'] = $toSession['total_amount'] * 0.15;
            }
        }

        $session->set($toSession);

        return view('home/guestroom');
    }
}
