<?php
	include ('proses_status.php');
	include ("proses_normalisasi.php"); 
 
if(isset($_POST['jmldata'])){
	$jml_data = $_POST['jmldata'];
	if (isset($_POST['tb1'])) {
		for ($i=1; $i <= $jml_data; $i++) { 
			// $tinggiBadan[$i] = $_POST['tb'.$i];
			// $beratBadan[$i] = $_POST['bb'.$i];

			$keadaan[$i] = $_POST['tb'.$i];
			$struktur[$i] = $_POST['bb'.$i];


			$aktivitas[$i] = $_POST['akt'.$i];
			$fungsi[$i] = $_POST['fgs'.$i];
			$lain[$i] = $_POST['lain'.$i];

			$keadaanAngka[$i] = keadaanKeAngka($keadaan[$i]);
			$strukturAngka[$i] = strukturKeAngka($struktur[$i]);
			$fungsiAngka[$i] = fungsiKeAngka($fungsi[$i]);	
			$lainAngka[$i] = lainKeAngka($lain[$i]);	
			$aktivitasAngka[$i] = aktivitasKeAngka($aktivitas[$i]);			
		}
		//Normalisasi Data
		// $minTB = min($tinggiBadan);
		// $maxTB = max($tinggiBadan);
		// $minBB = min($beratBadan);
		// $maxBB = max($beratBadan);
		$minKed = min($keadaanAngka);
		$maxKed = max($keadaanAngka);

		$minStk = min($strukturAngka);
		$maxStk = max($strukturAngka);

		$minAk = min($aktivitasAngka);
		$maxAk = max($aktivitasAngka);

		$minFgs = min($fungsiAngka);
		$maxFgs = max($fungsiAngka);

		$minLain = min($lainAngka);
		$maxLain = max($lainAngka);

		for ($i=1; $i <= $jml_data; $i++) { 
			$normalisasiTB[$i] = round(normalisasi($keadaanAngka[$i],$maxKed,$minKed),2);
			$normalisasiBB[$i] = round(normalisasi($strukturAngka[$i],$maxStk,$minStk),2);
			$normalisasiAk[$i] = round(normalisasi($aktivitasAngka[$i],$maxAk,$minAk),2);
			$normalisasiFgs[$i] = round(normalisasi($fungsiAngka[$i],$maxFgs,$minFgs),2);
			$normalisasiLain[$i] = round(normalisasi($lainAngka[$i],$maxLain,$minLain),2);
		}
	}
}

		function akhir ($x1,$x2,$x3) {
			$w1 = $_POST['w1'];
			$w2 = $_POST['w2'];
			$w3 = $_POST['w3'];
			$b = $_POST['b'];
			$treshold = 0.5;
			$rumus=($w1*$x1)+($w2*$x2)+($w3*$x3)+$b;
			// echo "rumus = ",$rumus,"--##";
			// echo "##w1 = ",$w1," w2 = ",$w2," w3 = ",$w3," B = ",$b;
			// echo "##x1 = ",$x1," x2 = ",$x2," x3 = ",$x3;
			if ($rumus>$treshold) {
				return "Berat";
			}elseif ($rumus<=$treshold && $rumus>=(-$treshold)) {
				return "Sedang";
			}elseif ($rumus<(-$treshold)) {
				return "Ringan";
			}	
		}

 ?>