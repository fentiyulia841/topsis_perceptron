<?php
include ('proses_status.php');
include ("proses_normalisasi.php");

$jml_data = $_POST['jmldata'];
//Main
	if (cek_data($jml_data)){
		//Penentuan Target
		// memanggil function pada class proses_status_
		for ($i=1; $i <= $jml_data ; $i++) {
			// $tinggiBadan[$i] = $_POST['tb'.$i];
			// $beratBadan[$i] = $_POST['bb'.$i];
			$keadaan[$i] = $_POST['tb'.$i];
			$struktur[$i] = $_POST['bb'.$i];
			$aktivitas[$i] = $_POST['akt'.$i];
			$fungsi[$i] = $_POST['fgs'.$i];			
			$lain[$i] = $_POST['lain'.$i];

			$keadaanAngka[$i] = keadaanKeAngka($keadaan[$i]);
			$strukturAngka[$i] = strukturKeAngka($struktur[$i]);
			$aktivitasAngka[$i] = aktivitasKeAngka($aktivitas[$i]);
			$fungsiAngka[$i] = fungsiKeAngka($fungsi[$i]);
			$lainAngka[$i] = lainKeAngka($lain[$i]);

			
			$target[$i] = htarget($keadaanAngka[$i],$strukturAngka[$i], $aktivitasAngka[$i],$fungsiAngka[$i], $lainAngka[$i]);
		}
		//Ubah Data ke Angka
		// memanggil fungsi aktivitaskeangka pada class proses status 
		for ($i=1; $i <= $jml_data; $i++) { 
			$aktivitasAngka[$i] = aktivitasKeAngka($aktivitas[$i]);
			$fungsiAngka[$i] = fungsiKeAngka($fungsi[$i]);
			$lainAngka[$i] = lainKeAngka($lain[$i]);
			$targetAngka[$i] = targetKeAngka($target[$i]);
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
			// memanggil fungsi normalisasi pada class proses_normalisasi
			$normalisasiTB[$i] = round(normalisasi($keadaanAngka[$i],$maxKed,$minKed),2);
			$normalisasiBB[$i] = round(normalisasi($strukturAngka[$i],$maxStk,$minStk),2);

			$normalisasiAk[$i] = round(normalisasi($aktivitasAngka[$i],$maxAk,$minAk),2);
			$normalisasiFgs[$i] = round(normalisasi($fungsiAngka[$i],$maxFgs,$minFgs),2);
			$normalisasiLain[$i] = round(normalisasi($lainAngka[$i],$maxLain,$minLain),2);
		}

	}else{
		echo "<script>window.location.href='index.php';</script>";
	}

?>