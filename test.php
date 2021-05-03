<h2>Proses Perceptron</h2>
<?php

// echo '<hr />';
// mengambil nilai min max pada table crips bobot
include 'config.php';
include 'includes/db.php';

$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
$row = $db->get_results("SELECT nilai_kriteria FROM tb_kriteria");
// print_r($row);
// die;
$input = [];

// foreach ($row as $key => $value) {
//     $input[] = $value['nilai_kriteria'];
// }

foreach ($row as $key => $value) {
    $input[] = $value->nilai_kriteria;
}

// $jumlah_input = 5;
// $input = array();
// for ($a = 1; $a <= $jumlah_input; $a++) {
//     foreach ($input as $key => $val) {
//         $input[$a][$key] = rand($row->bb, $row->ba);
//     }
// }

echo "nilai";
var_dump($input);


$targetAngka  = 1;

include ('perceptron/process/proses_perceptron.php');
$epoh = 1;
$perceptron = new Perceptron();

		// echo "<h4>EPOH ke-$epoh</h4>";
        $y_in = $perceptron->hitung_yin($input[0],$input[1],$input[2],$input[3],$input[4]);
        $hasilAktivasi = $perceptron->set_aktivasi($y_in);
        $perceptron->cek_target($targetAngka,$hasilAktivasi,$input[0],$input[1],$input[2],$input[3],$input[4]);
        $error= $perceptron->cek_error($hasilAktivasi);
        $error_bobot = $perceptron->func_error_bobot1($hasilAktivasi);

        echo "<table class='table table-striped table-hover'>
                <thead>
                
                <th>y_in</th>
                <th>Aktivasi</th>
                <th>Target</th>
                <th>Error</th>
                <th>Error Bobot</th>
                <th>Bobot Baru</th>
                </thead>
                <tbody>
                <tr>
                
                <td>".round($y_in,2)."</td>
                <td>$hasilAktivasi</td>
                <td>".$targetAngka."</td>
                <td>$error</td>
                <td>$error_bobot</td>
                <td>W1 = ".$perceptron->get_bobot1().", W2 = ".$perceptron->get_bobot2().", W3 = ".$perceptron->get_bobot3().", W4 = ".$perceptron->get_bobot4().", W5 = ".$perceptron->get_bobot5().", B = ".$perceptron->get_bobot1()."</td>
                </tr>
                </tbody>
            </table>";
            // if($perceptron->get_batas() == 1){
            //     break;
            // }
            
            // else {
            //     $perceptron->set_batas();
            //     $epoh++;
            // }
// }

$bobot = [];
$bobot[] = $perceptron->get_bobot1();
$bobot[] = $perceptron->get_bobot2();
$bobot[] = $perceptron->get_bobot3();
$bobot[] = $perceptron->get_bobot4();
$bobot[] = $perceptron->get_bobot5();



// foreach ($bobot as $val)
// {
//    echo "$val";
//    echo "<br />";
// }

?>