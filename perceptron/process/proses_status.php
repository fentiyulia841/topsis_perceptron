<?php

	function cek_data($x){
		$result = false;
		$y = 0;
		if($x==1){
			$result = false;
		}else{
			for ($i=1; $i <= $x; $i++) { 
				$_POST['tb'.$i] = trim($_POST['tb'.$i]);
				$_POST['bb'.$i] = trim($_POST['bb'.$i]);
				if ($_POST['tb'.$i]!=null and $_POST['bb'.$i]!=null) {
					$y=$y+1;
					if ($y==$x) {
						$result = true;
					}
				} 
			}
		}
		return $result;
	}
	function htarget($trgt_keadaan,$trgt_struktur,$trgt_fisik, $trgt_fungsi, $trgt_lain){
		// $bmi = $berat/(($tinggi/100)*($tinggi/100));
		$avg = ($trgt_keadaan+$trgt_struktur+$trgt_fisik+$trgt_fungsi+$trgt_lain)/5;
		if($avg<2){
			$hasil = 'ringan';
		}elseif ($avg>=2 and $avg<=2.5) {
			$hasil = 'sedang';
		}elseif ($avg>2.5) {
			$hasil = 'berat';
		}
		return $hasil;
	}

	function keadaanKeAngka($keadaan){
		if ($keadaan == 'Masih Berdiri') {
			return 3;	
		}elseif($keadaan == 'Miring'){
			return 1;
		}elseif($keadaan == 'Roboh Total'){
			return 2;
		}
	}

	function strukturKeAngka($struktur){
		if ($struktur == 'Sebagian Kecil Rusak Ringan') {
			return 3;	
		}elseif($struktur == 'Sebagian Kecil Rusak'){
			return 2;
		}elseif($struktur == 'Sebagian Besar Rusak'){
			return 1;
		}
	}


	// fisik
	function aktivitasKeAngka($aktivitas){
		if ($aktivitas == '<30%') {
			return 1;	
		}elseif($aktivitas == '30-50%'){
			return 2;
		}elseif($aktivitas == '>50%'){
			return 3;
		}
	}

	function targetKeAngka($target){
		if ($target == 'ringan') {
			return -1;
		}elseif($target == 'sedang'){
			return 0;
		}elseif($target == 'berat'){
			return 1;
		}
	}

	function fungsiKeAngka($fungsi){
		if ($fungsi == 'Tidak Berbahaya') {
			return 1;	
		}elseif($fungsi == 'Relatif Bahaya'){
			return 2;
		}elseif($fungsi == 'Membahayakan'){
			return 3;
		}
	}

	function lainKeAngka($lain){
		if ($lain == 'Sebagian Kecil Rusak') {
			return 1;	
		}elseif($lain == 'Sebagian Besar Rusak'){
			return 2;
		}elseif($lain == 'Rusak Total'){
			return 3;
		}
	}
?>