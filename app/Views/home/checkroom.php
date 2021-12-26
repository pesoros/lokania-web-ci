<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>
<meta name="reservation hotel for malaysia">
<meta name="zulkarnain" content="gambohnetwork.com.my">
<meta name="copyright" content="Hotel Malaysia, inc. Copyright (c) 2014">
<link rel="stylesheet" href="scss/foundation.css">
<link rel="stylesheet" href="scss/style.css">
<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta class="foundation-data-attribute-namespace">
<meta class="foundation-mq-xxlarge">
<meta class="foundation-mq-xlarge">
<meta class="foundation-mq-large">
<meta class="foundation-mq-medium">
<meta class="foundation-mq-small">
<style></style>
<meta class="foundation-mq-topbar">
</head>

<body class="fontbody">

	<div class="row foo" style="margin:30px auto 30px auto;">
		<div class="large-12 columns">
			<div class="large-3 columns centerdiv">
				<a href="<?= base_url('sessiondestroy') ?>" class="button round blackblur fontslabo">1</a>
				<p class="fontgrey">Please select Date</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="#" class="button round fontslabo" style="background-color:#2ecc71;">2</a>
				<p class="fontgrey">Select Room</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="#" class="button round blackblur fontslabo">3</a>
				<p class="fontgrey">Guest Details</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="#" class="button round blackblur fontslabo">4</a>
				<p class="fontgrey">Reservation Complete</p>
			</div>
		</div>

	</div>
	</div>

	<div class="row">
		<div class="large-4 columns blackblur fontcolor" style="margin-left:-10px; padding:10px;">

			<div class="large-12 columns ">
				<p><b>Your Reservation</b></p>
				<hr class="line">
				<form action="<?= base_url('sessiondestroy') ?>" method="post">
					<div class="row">
						<div class="large-12 columns">
							<div class="row">

								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgrey">Check In
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">: <?php echo session('checkin_date');?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgrey">Check Out
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">: <?php echo session('checkout_date');?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgrey">Adults
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">: <?php echo session('adults');?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgrey">Childrens
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">: <?php echo session('childrens');?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgrey" style="font-size:13.2px;">No. of Night Stay(s)
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">: <?php echo  session('total_night');?>
									</span>

								</div>
							</div>

						</div>
					</div>



					<div class="row">
						<div class="large-12 columns">
							<br><button name="submit" href="#" class="button small fontslabo"
								style="background-color:#2ecc71; width:100%;">Edit Reservation</button>
						</div>
					</div>
				</form>
			</div>
			<div class="large-12 columns" id="roomselected" style="display:none;">
				<hr>
				<br><label for="submit-form" class="book button small fontslabo"
					style="background-color:#2ecc71; width:100%; height:45px; !important;">Proceed To Book</label>
				<button name="submit" href="#" class="button small fontslabo" style="background-color:#2ecc71; width:100%;" >Proceed Booking</button>

			</div>



		</div>
		<div class="large-8 columns blackblur fontcolor" style="padding:10px">

			<div class="large-12 columns">
				<p><b>Choose Your Room</b></p>
				<hr class="line">
				<form action="<?= base_url('guestroom') ?>" method="post">
					<?php echo $roomElement; ?>
					<button type="submit" id="submit-form" class="hidden" style="display:none">Book</button>
				</form>
			</div>



		</div>

	</div>
	<script>
		function selection(id) {
			var e = document.getElementById('roomselected').style.display = 'block';

		}
	</script>
</body>

</html>