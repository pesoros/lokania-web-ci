<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Local -->
<link rel="stylesheet" href="scss/style.css">

<script>
	$(document).ready(function () {
		$("#checkout").datepicker();
		$("#checkin").datepicker(
			{
			minDate: new Date(),
			onSelect: function (dateText, inst) {
				var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
				$("#checkout").datepicker("option", "minDate", date);
			}
		});
	});
</script>

<style>
	.header {
		position: relative;
		text-align: center;
		color: white;
	}

	.logo {
		width: 50px;
		fill: white;
		padding-right: 15px;
		display: inline-block;
		vertical-align: middle;
	}

	.inner-header {
		height: 65vh;
		width: 100%;
		margin: 0;
		padding: 0;
		max-width: 360px;
		padding: 0px 10px;
	}

	.flex {
		/*Flexbox for containers*/
		display: inline-flex;
		justify-content: center;
		align-items: center;
		text-align: center;
	}

</style>

</head>

<body style="background-color: var(--yellow);">

	<!-- <header class="header">

		<nav class="nav">
			<div class="logo">LOKANIA.</div>
			<ul>
				<li><a href="">Masuk</a></li>
				<li><a href="">Daftar</a></li>
			</ul>
		</nav>

	</header> -->

	<div class="header">

		<!--Content before waves-->
		<div class="inner-header flex">



			<form name="form" action="<?= base_url('checkroom') ?>" method="post" onSubmit="return validateForm(this);">

				<div class="row">
					<img src="<?= base_url('/img/logo-lokania.png') ?>" alt="" style="width:250px;">
					<p style="margin-top: -35px;margin-bottom: 70px;">#CariKamardiLokaniaAja</p>
				</div>

				<!-- <div class="row">
					<p class="form-title" style="color: white;">Cari Hotel?</p>
					<br>
				</div> -->

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<p style="text-align: left;margin-left: 4px;margin-bottom: 5px;">Di mana Anda akan menginap?</p>
								<input name="location" id="location" class="input-box" placeholder="Pilih Kota" />
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<input name="checkin" id="checkin" class="input-box" placeholder="Check In" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<input name="checkout" id="checkout" class="input-box" placeholder="Check Out" />
							</div>
						</div>

						<div class="row">

							<div class="col-md-2 col-sm-2 col-xs-2">
								<i class="fas fa-user-alt" style="font-size: 25px;margin-top: 7px;margin-left: 15px;"></i>
							</div>

							<div class="col-md-5 col-sm-5 col-xs-5">
								<select name="totaladults" id="totaladults" class="input-box">
									<option value="1">1 Dewasa</option>
									<option value="2">2 Dewasa</option>
									<option value="3">3 Dewasa</option>
									<option value="4">4 Dewasa</option>
									<option value="5">5 Dewasa</option>
								</select>
							</div>

							<div class="col-md-5 col-sm-5 col-xs-5">
								<select name="totalchildrens" id="totalchildrens" class="input-box">
									<option value="0">0 Anak</option>
									<option value="1">1 Anak</option>
									<option value="2">2 Anak</option>
									<option value="3">3 Anak</option>
									<option value="4">4 Anak</option>
									<option value="5">5 Anak</option>
								</select>
							</div>

						</div>

						<div class="row">
							<div class="col-md-12">
								<button name="submit" href="" class="input-box" style="background-color:var(--blue);">
									<i class="fas fa-search" style="color: white;"></i>
								</button>
							</div>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>

	<footer>
		<p style="margin-top: -30px; font-size: 15px;"><a href="">Daftar</a><span> / </span><a href="">Masuk</a></p>
		<p>2022 © Lokania | Info: 085158307774</p>
	</footer>

	<script>
		function validateForm(form) {
			var a = form.checkin.value;
			var b = form.checkout.value;
			var c = form.totaladults.value;
			var d = form.totalchildrens.value;
			var e = form.location.value;

			if (e == "") {
				alert("Pilih Kota");
				return false;
			}
			if (a == null || b == null || a == "" || b == "") {
				alert("Pilih Tanggal");
				return false;
			}
			if (c == "") {
				if (d == "") {
					alert("Minimal 1 Dewasa");
					return false;
				}
			}
		}
	</script>
</body>

</html>