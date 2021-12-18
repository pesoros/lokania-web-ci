<?php

namespace App\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Roombook;

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

    public function insertandemail()
    {
        $session = session();
        $Booking = new Booking();

        $toSession['firstname'] = $_POST["firstname"];
        $toSession['lastname'] = $_POST["lastname"];
        $toSession['email'] = $_POST["email"];
        $toSession['phone'] = $_POST["phone"];
        $toSession['addressline1'] = $_POST["addressline1"];

        $toSession['postcode'] = $_POST["postcode"];
        $toSession['city'] = $_POST["city"];
        $toSession['state'] = $_POST["state"];
        $toSession['country'] = $_POST["country"];

        if (isset($_POST["addressline2"])) {
            $toSession['addressline2'] = $_POST["addressline2"];
        } else {

            $toSession['addressline2'] = "";
        }
        if (isset($_POST["specialrequirements"])) {
            $toSession['special_requirement'] = $_POST["specialrequirements"];
        } else {

            $toSession['special_requirement'] = "";
        }

        $session->set($toSession);

        $Booking = new Booking();

        $data = [
            'total_adult' => session('adults'),
            'total_children' => session('childrens'),
            'checkin_date' => session('checkin_db'),
            'checkout_date' => session('checkout_db'),
            'special_requirement' => session('special_requirement'),
            'payment_status' => 'pending',
            'total_amount' => session('total_amount'),
            'deposit' => session('deposit'),
            'first_name' => session('firstname'),
            'last_name' => session('lastname'),
            'email' => session('email'),
            'telephone_no' => session('phone'),
            'add_line1' => session('addressline1'),
            'add_line2' => session('addressline2'),
            'city' => session('city'),
            'state' => session('state'),
            'postcode' => session('postcode'),
            'country' => session('country'),
        ];

        $Booking->insert($data);
        $idInsert = $Booking->insertID();
        $session->set('booking_id', $idInsert);

        foreach (session('room_id') as $key => $value) {

            $Roombook = new Roombook();

            $datarb = [
                'booking_id' => session('booking_id'),
                'room_id' => $value,
                'totalroombook' => session('roomqty')[$key],
                'id' => null,
            ];

            $Roombook->insert($datarb);

        }

        $to = session('email');
        $subject = "Booking Confirmation";
        $message = "<html><body>";

        $message .= "<table class=\"body-wrap\">\n";

        $message .= "	<tr>\n";
        $message .= "		<td></td>\n";
        $message .= "		<td class=\"container\" width=\"600\">\n";
        $message .= "			<div class=\"content\">\n";
        $message .= "				<table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $message .= "					<tr>\n";
        $message .= "						<td class=\"content-wrap aligncenter\">\n";
        $message .= "							<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $message .= "								<tr>\n";
        $message .= "									<td class=\"content-block\">\n";
        $message .= "										<h1>Room Booked!</h1>\n";
        $message .= "									</td>\n";
        $message .= "								</tr>\n";
        $message .= "								<tr>\n";
        $message .= "									<td class=\"content-block\">\n";
        $message .= "										<h2>Thanks for giving us opportunity to serve you.</h2>\n";
        $message .= "									</td>\n";
        $message .= "								</tr>\n";
        $message .= "								<tr>\n";
        $message .= "									<td class=\"content-block\">\n";
        $message .= "										<table class=\"invoice\">\n";
        $message .= "											<tr>\n";
        $message .= "												<td>Dear " . session('firstname') . " " . session('lastname') . "<br><br><b>Booking ID #" . session('booking_id') . "</b><br><b>" . session('total_night') . "</b> night stay(s) from <b>" . session('checkin_date') . "</b> to <b>" . session('checkout_date') . "</b><br>No. of Guest :<b> " . session('adults') . "</b> Adult(s) & <b>" . session('childrens') . "</b> Child(s)<br><br><b>Contact Detail</b><br>" . session('addressline1') . ", " . session('addressline2') . "<br>" . session('postcode') . " " . session('city') . ", <br>" . session('state') . ", " . session('country') . "<br>Phone <b>" . session('phone') . "</b><br>Email <b>" . session('email') . "</b><br><br><br></td>\n";
        $message .= "											</tr>\n";
        $message .= "											<tr>\n";
        $message .= "												<td>\n";
        $message .= "													<table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\">\n";

        $count = 0;
        foreach (session('room_id') as &$value0) {
            $message .= "														<tr>\n";
            $message .= "															<td style=\"width:200px;\"><b>" . session('roomqty')[$count] . " " . session('roomname')[$count] . "</b></td>\n";
            $message .= "															<td  style=\"width:200px;\"> <b>RM" . session('ind_rate')[$count] . "</b></td>\n";
            $message .= "														</tr>\n";
            $count = $count + 1;
        };

        $message .= "														<tr>\n";
        $message .= "															<td style=\"width:200px;\">Total</td>\n";
        $message .= "															<td  style=\"width:200px;\"> <b>RM" . session('total_amount') . "</b></td>\n";
        $message .= "														</tr>\n";
        $message .= "														<tr>\n";
        $message .= "															<td style=\"width:200px;\">15% Deposit Due</td>\n";
        $message .= "															<td  style=\"width:200px;\"><b>RM" . session('deposit') . "</b></td>\n";
        $message .= "														</tr>\n";
        $message .= "														\n";
        $message .= "													</table>\n";

        $message .= "													<br><b>";
        $message .= "                     <form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_top\">\n";
        $message .= "					<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\n";
        $message .= "					<input type=\"hidden\" name=\"hosted_button_id\" value=\"3FWZ42DLC5BJ2\">\n";
        $message .= "					<input type=\"hidden\" name=\"lc\" value=\"MY\">\n";
        $message .= "					<input type=\"hidden\" name=\"item_name\" value=\"15% Hotel Deposit for Booking ID #" . session('booking_id') . "; \">\n";
        $message .= "					<input type=\"hidden\" name=\"amount\" value=\"" . session('deposit') . "\">\n";
        $message .= "					<input type=\"hidden\" name=\"currency_code\" value=\"MYR\">\n";
        $message .= "					<input type=\"hidden\" name=\"button_subtype\" value=\"services\">\n";
        $message .= "					<input type=\"hidden\" name=\"no_note\" value=\"0\">\n";
        $message .= "					<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest\">\n";
        $message .= "					<input type=\"hidden\" name=\"custom\" value=\"" . session('booking_id') . "\">\n";
        $message .= "					<br><button class=\"button small \" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\" style=\"background-color:#2ecc70;border:0px solid #18ab29; display:inline-block; color:#ffffff; font-size:15px; padding:5px 5px;\">Pay Deposit Via Paypal Here</button>\n";
        $message .= "					<img alt=\"\" border=\"0\" src=\"https://www.paypalobjects.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\n";
        $message .= "					</form>";
        $message .= "					<br>Notes & Policy:</b>\n";

        $message .= "															<br>\n";
        $message .= "															<b>1. Please pay 15% deposit to confirmed your booking.</b><br>\n";
        $message .= "															2. This hotel are not allowed etc etc<br>\n";
        $message .= "															3. Please check in before bla bla<br>\n";
        $message .= "															4. The hotel management has right to cancelled the booking\n";
        $message .= "															<br>\n";
        $message .= "															\n";
        $message .= "												</td>\n";
        $message .= "											</tr>\n";
        $message .= "										</table>\n";
        $message .= "									</td>\n";
        $message .= "								</tr>\n";
        $message .= "								<tr>\n";
        $message .= "								</tr>\n";
        $message .= "								<tr>\n";
        $message .= "									<td>\n";
        $message .= "										<br><br>Hotel Address, Street Your address, 50450 Kuala Lumpur, Malaysia\n";
        $message .= "									</td>\n";
        $message .= "								</tr>\n";
        $message .= "							</table>\n";
        $message .= "						</td>\n";
        $message .= "					</tr>\n";
        $message .= "				</table>\n";
        $message .= "				<div class=\"footer\">\n";
        $message .= "					<table width=\"100%\">\n";
        $message .= "						<tr>\n";
        $message .= "							<td><br>Questions? Email <a href=\"mailto:\">info@hotel.com.my or Call Us at 0000000</a></td>\n";
        $message .= "						</tr>\n";
        $message .= "					</table>\n";
        $message .= "				</div></div>\n";
        $message .= "		</td>\n";
        $message .= "		<td></td>\n";
        $message .= "	</tr>\n";
        $message .= "</table>";

        $message .= "</body></html>";

        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('bpypgh@gmail.com', 'Confirm Registration');

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

        // return redirect()->to(base_url('reservationcomplete'));
    }

    public function reservationcomplete()
    {
        return view('home/reservationcomplete');
    }
}
