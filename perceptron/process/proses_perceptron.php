<?php 
	class Perceptron{

		private $learning_rate;
		private $treshold;
		private $bobot= array();
		private $bias;
		private $tmp = array();
		private $batas;
		private $error;
		private $target_angka;
		private $angka2;
		private $normalisasi;

		function __construct(){
			$this->bobot[0] = 1;
			$this->bobot[1] = 2;
			$this->bobot[2] = 4;
			$this->bobot[3] = 1;
			$this->bobot[4] = 2;
			$this->bias = 0;
			$this->treshold = 0.5;
			$this->learning_rate = 0.4;
			$this->error = 0;
			$this->angka2 = -2;
			$this->target_angka = 1;	



			$this->tmp[0] = $this->bobot[0];
			$this->tmp[1] = $this->bobot[1];
			$this->tmp[2] = $this->bobot[2];
			$this->tmp[3] = $this->bobot[3];
			$this->tmp[4] = $this->bobot[4];
			$this->tmp[5] = $this->bias;
			$this->batas = 0;
		}
		function cek_target($target,$akt,$x1,$x2,$x3,$x4,$x5){
			if($target!=$akt){
				$this->bobot[0] = $this->bobot[0]+($this->learning_rate*$target*$x1);
				$this->bobot[1] = $this->bobot[1]+($this->learning_rate*$target*$x2);
				$this->bobot[2] = $this->bobot[2]+($this->learning_rate*$target*$x3);
				$this->bobot[3] = $this->bobot[3]+($this->learning_rate*$target*$x4);
				$this->bobot[4] = $this->bobot[4]+($this->learning_rate*$target*$x5);
				$this->bias = $this->bias+($this->learning_rate*$target);
				$this->tmp[0] = $this->bobot[0];
				$this->tmp[1] = $this->bobot[1];
				$this->tmp[2] = $this->bobot[2];
				$this->tmp[3] = $this->bobot[3];
				$this->tmp[4] = $this->bobot[4];
				$this->tmp[5] = $this->bias;
			}else{
				$this->batas = $this->batas + 1;
			}
		}

		function hitung_yin($x1,$x2,$x3,$x4,$x5){
			return $hasil = $this->bias+($x1*$this->bobot[0])+($x2*$this->bobot[1])+($x3*$this->bobot[2])+($x4*$this->bobot[3])+($x5*$this->bobot[4]);
		}
		function set_batas(){
			$this->batas = 0;
		}
		function get_batas(){
			return $this->batas;
		}
		function set_aktivasi($y_in){
			if ($y_in > $this->treshold) {
				return 1;
			}elseif ($y_in<= $this->treshold && $y_in >=(-$this->treshold)) {
				return 2;
			}elseif ($y_in < (-$this->treshold)) {
				return -1;
			}
		}

		// cek error
		function cek_error($set_aktivasi){
			// $eror_cek =  
			return $error = $this->error-$set_aktivasi^2;
		}


		// hitung error/bobot untuk hitung bobot baru
		function func_error_bobot1($aktivasi, $input1){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = $this->angka2 * ($this->target_angka - $this->$aktivasi) * $this->$aktivasi * ($this->target_angka - $this->$aktivasi) * $this->$input1;
			return $error_bobot;
		}

		function bobot_new($set_aktivasi){
			// $eror_cek =  
			return $error = $this->error-$set_aktivasi^2;
		}
		
		function get_bobot1(){
			return round($this->tmp[0],2);
		}


		function get_bobot2(){
			return round($this->tmp[1],2);
		}


		function get_bobot3(){
			return round($this->tmp[2],2);
		}

		function get_bobot4(){
			return round($this->tmp[3],2);
		}

		function get_bobot5(){
			return round($this->tmp[4],2);
		}


		function get_bias(){
			return round($this->tmp[5],2);
		}
		
		
	}
 ?>