<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="assets/favicon.ico" />
	<meta name="description" content="">
    <meta name="author" content="">

	<title>SB Admin 2 - Blank</title>
	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

	<link href="assets/css/yeti-bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/general.css" rel="stylesheet" />
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYoYWDkkxVBzR-qMaf8zhgZhyBYXGN6bU&language=id&region=ID&libraries=drawing,places,geometry"></script>
	<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
	<script>
		var default_lat = <?= get_option('default_lat') * 1 ?>;
		var default_lng = <?= get_option('default_lng') * 1 ?>;
		var default_zoom = <?= get_option('default_zoom') ?>;
	</script>

</head>

<body id="page-top">
	<!-- <nav class="navbar navbar-default navbar-static-top"> -->
		<div id="wrapper">


			<!-- <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="sidebar-brand-text mx-3" href="?">AG-TOPSIS</a>
			</div> -->


			<div id="navbar" class="navbar-collapse collapse">
				<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
					<li class="nav-item"><a class="nav-link collapsed" href="?m=kriteria">Kriteria</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=crips">Skala Pembobotan & Penilaian</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=sektor">Sektor</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=alternatif">Alternatif</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=jenis">Jenis Bencana</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=pola">Pola</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=hitung">Surveyor</a></li>
					<li class="nav-item"><a class="nav-link collapsed" href="?m=bencana">Bencana</a></li>
				</ul>
				<div class="navbar-text"></div>
			</div>

			
			<!--/.nav-collapse -->
			<div class="container-fluid">
				<?php
				if (file_exists($mod . '.php'))
					include $mod . '.php';
				else
					include 'home.php';
				?>
			</div>
			
		</div>
	<!-- </nav> -->

	<!-- content -->
	




	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
				<div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
		</div>
	</footer>

	 <!-- Scroll to Top Button-->
	 <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

	<!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>