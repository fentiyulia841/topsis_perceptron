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
		private $input1;
		private $input2;
		private $input3;
		private $input4;
		private $input5;

		function __construct(){
			$this->bobot[0] = 0.5;
			$this->bobot[1] = 0.5;
			$this->bobot[2] = 0.5;
			$this->bobot[3] = 0.5;
			$this->bobot[4] = 0.5;
			$this->bias = 0;
			$this->treshold = 0.5;
			$this->learning_rate = 0.1;
			$this->error = 0;
			$this->angka2 = 2;
			$this->target_angka = 1;	
			$this->input1 = 3;
			$this->input2 = 2;
			$this->input3 = 1;
			$this->input4 = 3;
			$this->input5 = 2;



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

		// function set_aktivasi($y_in){
		// 	if ($y_in > $this->treshold) {
		// 		return 3;
		// 	}elseif ($y_in<= $this->treshold && $y_in >=(-$this->treshold)) {
		// 		return 2;
		// 	}elseif ($y_in < (-$this->treshold)) {
		// 		return 2;
		// 	}
		// }


		function set_aktivasi($y_in){
			$set_aktivasi = 1/(1+(exp(-($y_in))));
			return $set_aktivasi;
		}

		// cek error
		function cek_error($set_aktivasi){
			// $eror_cek =  
			$error = ($this->error - $set_aktivasi) * ($this->error - $set_aktivasi);
			return $error;
		}


		// hitung error/bobot untuk hitung bobot baru
		function func_error_bobot1($aktivasi, $input){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = ($this->angka2 * ($this->target_angka - $aktivasi)) * $aktivasi * ($this->target_angka - $aktivasi) * $input;
			return $error_bobot;
		}

		function func_error_bobot2($aktivasi, $input){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = ($this->angka2 * ($this->target_angka - $aktivasi)) * $aktivasi * ($this->target_angka - $aktivasi) * $input;
			return $error_bobot;
		}

		function func_error_bobot3($aktivasi, $input){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = ($this->angka2 * ($this->target_angka - $aktivasi)) * $aktivasi * ($this->target_angka - $aktivasi) * $input;
			return $error_bobot;
		}

		function func_error_bobot4($aktivasi, $input){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = ($this->angka2 * ($this->target_angka - $aktivasi)) * $aktivasi * ($this->target_angka - $aktivasi) * $input;
			return $error_bobot;
		}

		function func_error_bobot5($aktivasi, $input){
			// $angka2 = -2;
			// $target_angka = 1;
			$error_bobot = ($this->angka2 * ($this->target_angka - $aktivasi)) * $aktivasi * ($this->target_angka - $aktivasi) * $input;
			return $error_bobot;
		}

		function bobot_new1($error_bobot){
		
			$bobot_baru = $this->bias - ($this->learning_rate * $error_bobot);
			return $bobot_baru; 
		}

		function bobot_new2($error_bobot){
		
			$bobot_baru = $this->bias - ($this->learning_rate * $error_bobot);
			return $bobot_baru; 
		}

		function bobot_new3($error_bobot){
		
			$bobot_baru = $this->bias - ($this->learning_rate * $error_bobot);
			return $bobot_baru; 
		}

		function bobot_new4($error_bobot){
		
			$bobot_baru = $this->bias - ($this->learning_rate * $error_bobot);
			return $bobot_baru; 
		}

		function bobot_new5($error_bobot){
		
			$bobot_baru = $this->bias - ($this->learning_rate * $error_bobot);
			return $bobot_baru; 
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