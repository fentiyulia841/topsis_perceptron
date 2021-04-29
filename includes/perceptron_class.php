<?php
class Perceptron
{
    var $time_start; //menyimpan waktu mulai proses algotitma
    var $time_end; //menyimpan waktu selesai proses algoritma

    var $variable;
    var $y;
    var $range;

    var $num_crommosom; //jumlah kromosom awal yang dibangkitkan
    var $crommosom = array(); //array kromosom sesuai $num_cromosom 

    var $TITIK = array();

    var $data = array();
    var $generation = 0; //generasi ke....
    var $max_generation = 25; //maksimal generasi

    var $success = false; //keadaan jika sudah ada sulosi terbaik
    var $debug = true; //menampilkan debug jika diset true;  
    var $fitness = array(); //nilai fitness setiap kromosom
    var $console = ""; //menyimpan proses algoritma 

    var $total_fitness = 0; //menyimpan total fitness untuk masing-masing kromosom
    var $probability  = array(); //menyimpan probabilitas fitness masing-masing kromosom
    var $com_pro = array(); //menyimpan fitness komulatif untuk masing masing kromosom
    var $rand = array(); //menyimpan bilangan rand())
    var $parent = array(); //menyimpan parent saat crossover

    var $best_fitness = 0; //menyimpan nilai fitness tertinggi
    public $best_cromossom = array(); //menyimpan kromosom dengan fitness tertinggi 

    var $crossover_rate = 75; //prosentase kromosom yang akan dipindah silang
    var $mutation_rate = 25; //prosentase kromosom yang akan dimutasi

    var $fitness_history = array();

    var $temp = array();

    var $titik_awal = '';

    /**
     * konstruktor ketiga pertama kali memanggil class AG
     * inputan waktu, ruang, dan kuliah 
     */
    function __construct($kromosom, $data, $atribut, $range)
    {
        foreach ($kromosom as $key => $val) {
            $this->key_kromosom[] = $key;
            $this->crommosom[] = $val;
        }
        $this->data = $data;
        $this->atribut = $atribut;
        $this->range = $range;
        // echo '<pre>' . print_r($this->range, 1) . '</pre>';
    }
    /**
     * mulai memproses algoritma     
     */
    function generate()
    {
        global $db;
        $this->time_start = microtime(true); //seting watu awal eksekusi                
        /**
         * proses algoritma akan diulang sampai memperoleh nilai 1
         * atau sudah mencapai maksimum generasi (sesuai yang diinputkan)
         */
        while (($this->generation < $this->max_generation) && $this->success == false) {
            $this->generation++;
            $this->console .= "<h4>Generasi ke-$this->generation</h4>";
            $this->show_crommosom();
            $this->calculate_all_fitness();
            $this->show_fitness();

            if (!$this->success) { //jika fitness terbaik belum mencapai 0, dilanjutkan ke proses seleksi
                $this->get_com_pro();
                $this->selection();
                $this->show_crommosom();
                $this->calculate_all_fitness();
                $this->show_fitness();
            }
            if (!$this->success) { //jika fitness terbaik belum mencapai 1, dilanjutkan ke proses crossover
                $this->crossover();
                $this->show_crommosom();
                $this->calculate_all_fitness();
                $this->show_fitness();
            }
            if (!$this->success) { //jika fitness terbaik belum mencapai 1, dilanjutkan ke proses mutasi
                $this->mutation();
                $this->show_crommosom();
                $this->calculate_all_fitness();
                $this->show_fitness();
            }
        }

        $this->time_end = microtime(true); //seting waktu akhir eksekusi

        $time = $this->time_end - $this->time_start;

        /**
         * menampilan hasil algoritma
         */
        echo "<pre style='font-size:0.8em'>\nFITNESS TERBAIK: $this->best_fitness";
        echo "\nExecution Time: $time seconds";
        echo "\nMemory Usage: " . memory_get_usage() / 1024 . ' kilo bytes';
        echo "\nGENERASI: $this->generation";
        // echo "\nCromosom Akhir:";
        //echo "\nFitness: $this->generation";
        // foreach ($this->crommosom as $key => $val) {
        //     echo "\n" . $this->print_cros($val);
        // }
        echo "\nCROMOSSOM (BOBOT KRITERIA) TERBAIK:  " .  $this->print_cros($this->best_cromossom) . "</pre>";
        echo "</pre>";
        //menampilkan proses algoritma                             
        $this->get_debug();
        return $this->best_cromossom;
    }









    //mencari nilai crossover dari dua induk
    function get_crossover($key1, $key2)
    {

        $this->temp['induk'] .= "chro[$key1] x chro[$key2] \n";

        $cro1 = $this->crommosom[$key1];
        $cro2 = $this->crommosom[$key2];

        $new_cro = $cro1;
        $offspring = rand(0, count($cro1) - 1);
        $no = 0;
        foreach ($cro1 as $key => $val) {
            if ($no <= $offspring)
                $new_cro[$key] = $cro1[$key];
            else
                $new_cro[$key] = $cro2[$key];
            $no++;
        }
        $this->temp['point'] .= "C[$key1] = $offspring \n";
        $this->temp['detail'] .= "Offspring[$key1] : $offspring = chromosome[$key1] x chromosome[$key2] \n";
        $this->temp['detail'] .= '            = [' .  $this->print_cros($cro1) . '] x [' .  $this->print_cros($cro2) . "] \n";
        $this->temp['detail'] .= '            = [' .  $this->print_cros($new_cro) . "] \n";

        return $new_cro;
    }
    /**
     * proses Crossover (pindah silang pada AG)
     */
    function crossover()
    {
        $this->console .= "<h5>Pindah silang generasi ke-$this->generation</h5>";
        $parent = array();

        //menentukan kromosom mana saja sebagai induks
        //jumlahnya berdasarkan crossover rate 

        $this->console .= "Pertama kita bangkitkan bilangan acak R sebanyak jumlah populasi";
        foreach ($this->crommosom as $key => $val) {
            $rnd = mt_rand() / mt_getrandmax();
            $this->console .= "\nrand([$key]) : " . round($rnd, 3);
            if ($rnd <= $this->crossover_rate / 100)
                $parent[] = $key;
        }

        //menampilkan parent/induk setiap pindah silang        
        foreach ($parent as $key => $val) {
            //$this->console.="Parent[$key] : $val \n";
            //$this->console.="Ofspring[$val] : ";
        }

        $parent = $parent;
        $c = count($parent);


        //mulai proses pindah silang sesuai jumlah induk
        $this->temp['induk'] = '';
        $this->temp['detail'] = '';
        $this->temp['point'] = '';
        if ($c > 1) {
            for ($a = 0; $a < $c - 1; $a++) {
                $new_cro[$parent[$a]] = $this->get_crossover($parent[$a],  $parent[$a + 1]);
            }
            //$this->console.="Ofspring[".$parent[($c-1)]."] = chromosome[".$parent[($c-1)]."] x chromosome[$parent[0]] \n";
            $new_cro[$parent[$c - 1]] = $this->get_crossover($parent[$c - 1],  $parent[0]);

            //menyimpan kromosom hasil pindah silang dan fitnessnya
            foreach ($new_cro as $key => $val) {
                $this->crommosom[$key] = $val;
            }
        }

        $this->console .= "\nInduk crossover: \n" . $this->temp['induk'];
        $this->console .= "Proses crossover: \n" . $this->temp['detail'];
        $this->console .= "Dengan demikian populasi chromosome setelah melalui proses crossover adalah: \n";
    }
    function get_rand()
    {
        $this->rand = array();
        //reset($this->fitness);
        foreach ($this->fitness as $key => $val) {
            $r = mt_rand() / mt_getrandmax();
            $this->rand[] = $r;
            $this->console .= "R[$key] : " . round($r, 4) . " \n";
        }
    }
    /**
     * proses seleksi, memilih gen secara acak
     * dimana fitness yang besar mendapatkan kesempata yang lebih besar
     */
    function selection()
    {
        $this->console .= "<h5>Seleksi generasi ke-$this->generation</h5>";
        $this->get_rand();
        $new_cro = array();
        $new_fitness = array();
        foreach ($this->rand as $key => $val) {
            $k = $this->choose_selection($val);
            $new_cro[$key] = $this->crommosom[$k];
            $new_fitness[$key] = $this->fitness[$k];
            $this->console .= "K[$key] = K[$k] \n";
        }
        $this->crommosom = $new_cro;
        $this->fitness = $new_fitness;
    }
    /**
     * mencari probabilitas untuk setiap fitness
     * rumusnya adalah  fitness / total fitness
     */
    function get_probability()
    {
        $this->probability = array();
        foreach ($this->fitness as $key => $val) {
            $this->probability[] = $val / array_sum($this->fitness);
            $this->console .= "P[$key]: " . round($this->probability[$key], 4) . "\n";
        }
        $this->console .= "Total P: " . round(array_sum($this->probability), 4) . "\n";
    }
    /**
     * mencari nilai probabilitas komulatif
     * 
     * */
    function get_com_pro()
    {
        $this->get_probability();
        $this->com_pro = array();
        $x = 0;
        foreach ($this->probability as $key => $val) {
            $x += $val;
            $this->com_pro[] = $x;
            $this->console .= "PK[$key] : " . round($x, 4) . " \n";
        }
        $this->com_pro;
    }
    /**
     * mencari total fitness 
     */
    function get_total_fitness()
    {
        $this->total_fitness = 0;
        //reset($this->fitness);
        foreach ($this->fitness as $key => $val) {
            $this->total_fitness += $val;
        }
        return $this->total_fitness;
    }
    /**
     * menampilkan nilai fitnes untuk masing-masing kromosom
     */
    function show_fitness()
    {
        foreach ($this->fitness as $key => $val) {
            $this->console .= "F[$key] = " . round($val, 4) . "\n";
        }
        $this->get_total_fitness();
        $this->console .= "Total F: " . round($this->total_fitness, 4) . "\n";
    }
    /**
     * menghitung fitness pada semua kromosom
     */
    function calculate_all_fitness()
    {
        foreach ($this->crommosom as $key => $val) {
            $this->calculate_fitness($key);
        }
    }

    /**
     * menghitung fitnes pada kromosom tertentu 
     */
    function calculate_fitness($key)
    {
        $kromosom = $this->crommosom[$key];
        $topsis = new TOPSIS($this->data, $this->atribut, $kromosom);

        // echo '<pre>' . print_r($topsis->preferensi, 1) . '</pre>';

        $this->fitness[$key] = max($topsis->preferensi);

        if ($this->fitness[$key] == 1)
            $this->success = true;

        if ($this->fitness[$key] > $this->best_fitness) {
            $this->best_fitness = $this->fitness[$key];
            $this->best_cromossom = $kromosom;
        }
    }
    /**
     * menampilkan semua kromosom 
     */
    function show_crommosom()
    {
        $crommosom = $this->crommosom;
        $a = array();
        foreach ($crommosom as $key => $val) {
            $a[] =  "Cro $key: " .  $this->print_cros($val);
        }
        $this->console .= implode(" \n", $a) . "\n";
    }

    function print_cros($val)
    {
        return implode(", ", $val);
    }

    /**
     * proses mutasi pada AG
     * mutasi dilakukan sesuai prosentase "Mutation Rate" yang diinputkan
     */
    function mutation()
    {
        $this->console .= "<h5>Mutasi generasi ke-$this->generation</h5>";
        $gen_per_cro = count($this->crommosom[0]);
        $total_gen = count($this->crommosom) * $gen_per_cro;
        $total_mutation = ceil($this->mutation_rate / 100 * $total_gen);

        $gen_keys = array_keys($this->crommosom[0]);

        for ($a = 1; $a <= $total_mutation; $a++) {
            $rand = rand(1, $total_gen);

            $cro_index = ceil($rand / $gen_per_cro) - 1;
            $gen_index = $rand % $gen_per_cro;
            $gen_key = $gen_keys[$gen_index];

            $this->console .= "rand($rand): [cro: $cro_index, gen $gen_index] = " .  $this->print_cros($this->crommosom[$cro_index]);
            $this->crommosom[$cro_index][$gen_key] = rand($this->range[$gen_key][0], $this->range[$gen_key][1]);
            $this->console .= " = " . $this->print_cros($this->crommosom[$cro_index]) . " \n";
        }
    }

    function is_stop()
    {
        $total = 7;

        if (count($this->fitness_history) < $total)
            return false;

        $this->fitness_history = array_values($this->fitness_history);

        unset($this->fitness_history[0]);

        $arr =  $this->fitness_history;

        if (count(array_unique($arr)) == 1) {
            return true;
        }
        return false;
    }







    /**
     * menampilkan print out dari proses algoritma
     */
    function get_debug()
    {
        if ($this->debug)
            echo "<pre style='font-size:0.8em'>$this->console</pre>";
    }

    /**
     * memilih berdasarkan bilangan random yang diinputkan
     * */
    function choose_selection($rand_numb = 0)
    {
        foreach ($this->com_pro as $key => $val) {
            if ($rand_numb <= $val)
                return $key;
        }
    }
}
