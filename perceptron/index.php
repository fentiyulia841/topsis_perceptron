<!DOCTYPE html>
<html>
<head>
	<title>PROJECT JST</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>	
</head>
<body>
	<!-- menu navbar start -->
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
	<!-- menu navbar end -->

	<div class="container" style="margin-top: 50px;">
		<div class="page-header">
			<h1>Penentuan tingkat kerusakan bangunan Dengan Metode Perceptron</h1>
		</div>

				<!-- div panel menentukan jumlah data -->
				<div class="panel panel-primary">
					<!--  -->
					<div class="panel-heading">
						<h3>Menentukan Jumlah Data Training</h3>
					</div>
					<!--  -->

					<div class="panel-body">
						<form action="#" method="POST">
							<div class="form-group">
								<label for="sel1">Tambahkan Jumlah</label>
									<select class="form-control" id="sel1" name="jmldata">
									<?php 
									// looping jumlah data sampai 100
										for ($i=1; $i <= 100 ; $i++) { 
											echo "<option>".$i."</option>";
										}
									 ?>								
									</select>						
							</div>
							<!-- input name style -->
								<input type="hidden" name="style" value="show">
								<input type="submit" class="btn btn-primary" value="Submit" id="submit">
						</form>	
					</div>
				</div>
				<!-- div panel menentukan jumlah data -->

				<!-- php untuk mengambil jumlah data -->
				<?php
					// mengambil jumlah data pada input type name = style
					if(isset($_POST['style'])){ 
						$style=$_POST['style'];
						// mengambil jumlah data pada select class name = jmldata
						if(isset($_POST['jmldata'])){
							$x = $_POST['jmldata'];
						}else{
							$x=0;
						}
						
					}else{
						$style='none';
					}
				?>
				<!-- php end -->


				<!-- setelah jumlah data diketahui menampilkan form data sampel/pola -->
				<div class="panel panel-primary" id="data" style="display: <?php echo $style; ?>">
					<div class="panel-heading">
						<h3>Data Sampel</h3>
					</div>
					<div class="panel-body" id="konten">
						<form method="post" action="data.php">
							<table class="table table-hover">
								<thead>
								<tr>
									<th>Data ke</th>
									<th>Keadaan Bangunan</th>
									<th>Struktur Bangunan</th>
									<th>Fisik Bangunan</th>
									<th>Fungsi Bangunan</th>
									<th>Keadaan Lain</th>
								</tr>
								</thead>
								<tbody>
									<?php
									for ($i=1; $i <= $x ; $i++) { 
										echo "<tr>
											  	<td>$i</td>											  	
												<td><select name='tb$i'>
											  		<option>Masih Berdiri</option>
											  		<option>Miring</option>
											  		<option>Roboh Total</option>
											  		</select>
												</td>											  	
												<td><select name='bb$i'>
											  		<option>Sebagian Kecil Rusak Ringan</option>
											  		<option>Sebagian Kecil Rusak</option>
											  		<option>Sebagian Besar Rusak</option>
											  		</select>
												</td>
											  	<td><select name='akt$i'>
											  		<option><30%</option>
											  		<option>30-50%</option>
											  		<option>>50%</option>
											  		</select>
												</td>
												<td><select name='fgs$i'>
											  		<option>Tidak Berbahaya</option>
											  		<option>Relatif Bahaya</option>
											  		<option>Membahayakan</option>
											  		</select>
												</td>
												<td><select name='lain$i'>
											  		<option>Sebagian Kecil Rusak</option>
											  		<option>Sebagian Besar Rusak</option>
											  		<option>Rusak Total</option>
											  		</select>
												</td>
											  </tr>";
									}
									?>
								</tbody>
							</table>

							<!-- button submit jumlah data -->
							<input type="hidden" name="jmldata" value="<?php echo $x; ?>">
							<button type="submit "class="btn btn-primary btn-block">Submit</button>
							<!-- button submit jumlah data -->

						</form>
					</div>
				</div>
	</div>
</body>
</html>