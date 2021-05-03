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

$y_in = $perceptron->hitung_yin($input[0],$input[1],$input[2],$input[3],$input[4]);
$hasilAktivasi = $perceptron->set_aktivasi($y_in);
$perceptron->cek_target($targetAngka,$hasilAktivasi,$input[0],$input[1],$input[2],$input[3],$input[4]);
$error= $perceptron->cek_error($hasilAktivasi);
$error_bobot = $perceptron->func_error_bobot1($hasilAktivasi,$input[0]);
$error_bobot2 = $perceptron->func_error_bobot2($hasilAktivasi,$input[1]);
$error_bobot3 = $perceptron->func_error_bobot3($hasilAktivasi,$input[2]);
$error_bobot4 = $perceptron->func_error_bobot4($hasilAktivasi,$input[3]);
$error_bobot5 = $perceptron->func_error_bobot5($hasilAktivasi,$input[4]);
$bobot_baru = $perceptron->bobot_new1($error_bobot);
$bobot_baru2 = $perceptron->bobot_new2($error_bobot2);
$bobot_baru3 = $perceptron->bobot_new3($error_bobot3);
$bobot_baru4 = $perceptron->bobot_new4($error_bobot4);
$bobot_baru5 = $perceptron->bobot_new5($error_bobot5);

echo "<table class='table table-striped table-hover'>
        <thead>
        
        <th>y_in</th>
        <th>Aktivasi</th>
        <th>Target</th>
        <th>Error</th>
        
        
        </thead>
        <tbody>
        <tr>
        
        <td>".round($y_in,2)."</td>
        <td>$hasilAktivasi</td>
        <td>".$targetAngka."</td>
        <td>$error</td>

        
        </tr>
        </tbody>
    </table>";

echo "<table class='table table-striped table-hover'>
    <thead>
    
    <th>Error Bobot 1</th>
    <th>Error Bobot 2</th>
    <th>Error Bobot 3</th>
    <th>Error Bobot 4</th>
    <th>Error Bobot 5</th>

    </thead>
    <tbody>
    <tr>
    
    <td>$error_bobot</td>
    <td>$error_bobot2</td>
    <td>$error_bobot3</td>
    <td>$error_bobot4</td>
    <td>$error_bobot5</td>
    
    </tr>
    </tbody>
</table>";


echo "<table class='table table-striped table-hover'>
    <thead>
    
    <th>Bobot Baru 1</th>
    <th>Bobot Baru 2</th>
    <th>Bobot Baru 3</th>
    <th>Bobot Baru 4</th>
    <th>Bobot Baru 5</th>
    
    </thead>
    <tbody>
    <tr>
    
    <td>$bobot_baru</td>
    <td>$bobot_baru2</td>
    <td>$bobot_baru3</td>
    <td>$bobot_baru4</td>
    <td>$bobot_baru5</td>
    
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