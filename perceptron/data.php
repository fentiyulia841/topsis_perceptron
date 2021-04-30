<?php 
	include ("process/hasil_pemrosessan.php");
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>PROJECT JST</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>  	
	<script type="text/javascript" src="js/npm.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#btn-data").click(function () {
				$("#data_asli").hide();
				$("#data_angka").fadeIn();
			})

			$("#btn-angka").click(function () {
				$("#data_asli").fadeIn();
				$("#data_angka").hide();
			})

			$("#btn-normal").click(function () {
				$("#data_normal").slideToggle();
			})

			$("#btn-hitung").click(function () {
				$("#data_hitung").slideDown();
			})
			
		})
	</script>	
 </head>

 <body>
 	<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">DSS Disaster</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
					</ul>
				</div>
			</div>
	</nav>

	<div class="container" style="margin-top: 80px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3>Data Kerusakan Bangunan</h3>
			</div>

			<!-- panel data asli -->
			<div class="panel-body" id="data_asli">
				<table class="table table-striped table-hover">
					<thead>
						<th>Data ke</th>
						<th>Keadaan Bangunan</th>
						<th>Struktur Bangunan</th>
						<th>Fisik Bangunan</th>
						<th>Fungsi Bangunan</th>
						<th>Keadaan Lain</th>
						<th>Status Kerusakan</th>
					</thead>
					<tbody>
						<?php 
							for ($i=1; $i <= $jml_data; $i++) { 
								echo "<tr>";
								echo "<td>". $i ."</td>";
								echo "<td>". $keadaan[$i] ."</td>";
								echo "<td>". $struktur[$i] ."</td>";
								echo "<td>". $aktivitas[$i] ."</td>";
								echo "<td>". $fungsi[$i] ."</td>";
								echo "<td>". $lain[$i] ."</td>";
								echo "<td>". $target[$i] ."</td>";
								echo "</tr>";
							}
						 ?>
					</tbody>
				</table>
				<button type="button" class="btn btn-primary btn-block" id="btn-data">Data Kerusakan Dalam Bentuk Angka</button>
			</div>
			<!-- end -->

			<!-- panel data angka -->
			<div class="panel-body" id="data_angka" style="display: none;">
				<table class="table table-striped table-hover">
					<thead>
						<th>Data ke</th>
						<th>Keadaan Bangunan</th>
						<th>Struktur Bangunan</th>
						<th>Fisik Bangunan</th>
						<th>Fungsi Bangunan</th>
						<th>Keadaan Lain</th>
						<th>Status Kerusakan</th>
					</thead>
					<tbody>
						<?php 
							for ($i=1; $i <= $jml_data; $i++) { 
								echo "<tr>";
								echo "<td>". $i ."</td>";
								echo "<td>". $keadaanAngka[$i] ."</td>";
								echo "<td>". $strukturAngka[$i] ."</td>";
								echo "<td>". $aktivitasAngka[$i] ."</td>";
								echo "<td>". $fungsiAngka[$i] ."</td>";
								echo "<td>". $lainAngka[$i] ."</td>";
								echo "<td>". $targetAngka[$i] ."</td>";
								echo "</tr>";
							}
						 ?>
					</tbody>
				</table>
				<button type="button" class="btn btn-primary btn-block" id="btn-angka">Data Asli</button>
				<button type="button" class="btn btn-danger btn-block" id="btn-normal">Normalisasi Data</button>
			</div>
			<!-- end -->
		</div> 
		<!-- end panel primary -->
		
		<!-- 5 panel data hasil normalisasi -->
		<div class="panel panel-primary" id="data_normal" style="display: none;">
			<div class="panel-heading">
				<h3>Data Hasil Normalisasi</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover">
					<thead>
						<th>Data ke</th>
						<th>Keadaan Bangunan</th>
						<th>Struktur Bangunan</th>
						<th>Fisik Bangunan</th>
						<th>Fungsi Bangunan</th>
						<th>Keadaan Lain</th>
						<th>Status Kerusakan</th>
					</thead>
					<tbody>
						<?php 
							for ($i=1; $i <= $jml_data; $i++) { 
								echo "<tr>";
								echo "<td>". $i ."</td>";
								echo "<td>".$normalisasiTB[$i]."</td>";
								echo "<td>".$normalisasiBB[$i]."</td>";
								echo "<td>".$normalisasiAk[$i]."</td>";
								echo "<td>".$normalisasiFgs[$i]."</td>";
								echo "<td>".$normalisasiLain[$i]."</td>";
								echo "<td>".$targetAngka[$i]."</td>";
								echo "</tr>";
							}
						 ?>
					</tbody>
				</table>
				<button type="button" class="btn btn-primary btn-block" id="btn-hitung">Hitung Dengan Perceptron</button>
			</div>
		</div>
		<!-- panel normalisasi end -->
	
		<!-- panel hasil hitung perceptron -->
		<div class="panel panel-primary" id="data_hitung" style="display: none">
			<div class="panel-heading">
				<h3>Hasil Perhitungan</h3>
			</div>
			<!-- panel body start -->
			<div class="panel-body">

					<!-- php start -->
					<?php
					include ('process/proses_perceptron.php');
					$epoh = 1;
					$perceptron = new Perceptron();
					while (true) {
						echo "<h4>EPOH ke-$epoh</h4>";
						for ($i=1; $i <= $jml_data; $i++) {
							$y_in = $perceptron->hitung_yin($normalisasiTB[$i],$normalisasiBB[$i],$normalisasiAk[$i],$normalisasiFgs[$i],$normalisasiLain[$i]);
							$hasilAktivasi = $perceptron->set_aktivasi($y_in);
							$perceptron->cek_target($targetAngka[$i],$hasilAktivasi,$normalisasiTB[$i],$normalisasiBB[$i],$normalisasiAk[$i],$normalisasiFgs[$i],$normalisasiLain[$i]);
							echo "<table class='table table-striped table-hover'>
									<thead>
									<th>Data ke</th>
									<th>y_in</th>
									<th>hasil_aktivasi</th>
									<th>target</th>
									<th>Bobot dan Bias</th>
									</thead>
									<tbody>
									<tr>
									<td>$i</td>
									<td>".round($y_in,2)."</td>
									<td>$hasilAktivasi</td>
									<td>".$targetAngka[$i]."</td>
									<td>W1 = ".$perceptron->get_bobot1().", W2 = ".$perceptron->get_bobot2().", W3 = ".$perceptron->get_bobot3().", W4 = ".$perceptron->get_bobot4().", W5 = ".$perceptron->get_bobot5().", B = ".$perceptron->get_bobot1()."</td>
									</tr>
									</tbody>
								</table>";
							}
							if($perceptron->get_batas() == $jml_data){
								break;
							}else {
								$perceptron->set_batas();
								$epoh++;
							}
						}
					?>
				<!-- php end -->

				<form method="POST" action="hitung_data.php">
					<div class="form-group">
						<input type="hidden" name="w1" value="<?php echo $perceptron->get_bobot1(); ?>"></input>
						<input type="hidden" name="w2" value="<?php echo $perceptron->get_bobot2(); ?>"></input>
						<input type="hidden" name="w3" value="<?php echo $perceptron->get_bobot3(); ?>"></input>
						<input type="hidden" name="w4" value="<?php echo $perceptron->get_bobot4(); ?>"></input>
						<input type="hidden" name="w5" value="<?php echo $perceptron->get_bobot5(); ?>"></input>
						<input type="hidden" name="b" value="<?php echo $perceptron->get_bias(); ?>"></input>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Hitung Data Testing</button>
				</form>
			
			</div>
			<!-- panel body end -->
		</div>
		<!-- end panel hitung perceptron -->

	</div>
 </body>
 </html>