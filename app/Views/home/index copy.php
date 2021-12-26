<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="scss/datepicker.css" rel="stylesheet" type="text/css" />
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<link rel="stylesheet" href="scss/style.css">
<link rel="stylesheet" href="scss/datepicker.css">

<script>
	$(document).ready(function () {
		$("#checkout").datepicker();
		$("#checkin").datepicker({
			minDate: new Date(),
			onSelect: function (dateText, inst) {
				var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
				$("#checkout").datepicker("option", "minDate", date);
			}
		});
	});
</script>

</head>

<body style="background-color: var(--white);">

	<header class="header">

		<nav class="nav">
			<div class="logo">LOKANIA.</div>
			<ul>
				<li><a href="">Masuk</a></li>
				<li><a href="">Daftar</a></li>
			</ul>
		</nav>

	</header>


	<div class="row row-body">

		<p class="form-title" style="color: var(--blue);">Cari Hotel?</p>
		<form name="form" action="<?= base_url('checkroom') ?>" method="post" onSubmit="return validateForm(this);">

			<div class="row">

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<input name="location" id="location" class="input-box" placeholder="Pilih Kota" />
						</div>
						<div class="col-md-3">
							<select name="totaladults" id="totaladults" class="input-box">
								<option value="" disabled selected>Dewasa</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="col-md-3">
							<select name="totalchildrens" id="totalchildrens" class="input-box">
								<option value="" disabled selected>Anak-Anak</option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input name="checkin" id="checkin" class="input-box" placeholder="Check In" />
						</div>
						<div class="col-md-6">
							<input name="checkout" id="checkout" class="input-box" placeholder="Check Out" />
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<button name="submit" href="" class="input-box" style="background-color:var(--yellow);">
								<i class="fas fa-search" style="color:var(--blue);"></i>
							</button>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>

	<footer>
		POWERED BY LOKANIA.
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