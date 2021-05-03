<?php
// echo '<pre>' . print_r($nilai, 1) . '</pre>';
$total_pola = count($pola_details);
$data = array();
foreach ($pola_details as $key => $val) {
    foreach ($val as $k => $v) {
        foreach ($v as $a => $b) {
            $selisih = abs($CRIPS[$b]->nilai - $CRIPS[$nilai[$a]]->nilai);
            $data["{$key}_{$k}"][$a] = (3 - $selisih) / (3 - 1);
        }
    }
}
print_msg("Ditemukan $total_pola pola sebagai berikut", 'info');
?>
<?php foreach ($pola_details as $key_pola => $val_pola) : ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Pola <?= $key ?></h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover nw">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <?php foreach ($KRITERIA as $key => $val) : ?>
                            <th><?= $val->kode_kriteria ?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
                <?php foreach ($val_pola as $key => $val) : ?>
                    <tr>
                        <td><?= $ALTERNATIF[$key] ?></td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td><?= $CRIPS[$v]->nilai ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
<?php endforeach ?>

<h2>Proses Perceptron</h2>
<?php

// echo '<hr />';
// mengambil nilai min max pada table crips bobot

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

$targetAngka  = 1;

include ('perceptron/process/proses_perceptron.php');
$epoh = 1;
$perceptron = new Perceptron();
// while (true) {
		// echo "<h4>EPOH ke-$epoh</h4>";
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



//             if($perceptron->get_batas() == 1){
//                 break;
//             }
            
//             else {
//                 $perceptron->set_batas();
//                 $epoh++;
//             }
// }

// $perceptron->get_bobot1();
// $perceptron->get_bobot2();
// $perceptron->get_bobot3();
// $perceptron->get_bobot4();
// $perceptron->get_bobot6();
  

// $bobot = [];
// $bobot[] = $perceptron->get_bobot1();
// $bobot[] = $perceptron->get_bobot2();
// $bobot[] = $perceptron->get_bobot3();
// $bobot[] = $perceptron->get_bobot4();
// $bobot[] = $perceptron->get_bobot5();


$bobot = [];
$bobot[] = $perceptron->bobot_new1($error_bobot);
$bobot[] = $perceptron->bobot_new2($error_bobot2);
$bobot[] = $perceptron->bobot_new3($error_bobot3);
$bobot[] = $perceptron->bobot_new4($error_bobot4);
$bobot[] = $perceptron->bobot_new5($error_bobot5);

$topsis = new TOPSIS($data, $atribut, $bobot);
?>

 

<h2>Perhitungan TOPSIS dengan Bobot Baru</h2>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Normalisasi Data Pola Terhadap Nilai Pilihan Kriteria</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover nw">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->kode_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($topsis->data as $key => $val) : ?>
                <tr>
                    <td>Pola <?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Normalisasi TOPSIS</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->kode_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($topsis->normal as $key => $val) : ?>
                <tr>
                    <td>Pola <?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Normalisasi Terbobot</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->kode_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($topsis->terbobot as $key => $val) : ?>
                <tr>
                    <td>Pola <?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Matriks Solusi Ideal</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->kode_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($topsis->solusi_ideal as $key => $value) : ?>
                <tr>
                    <th><?= $key ?></th>
                    <?php foreach ($value as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Jarak Solusi &amp; Nilai Preferensi</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Alternatif</th>
                    <th>Positif</th>
                    <th>Negatif</th>
                    <th>Preferensi</th>
                </tr>
            </thead>
            <?php
            $rank = get_rank($topsis->preferensi);
            foreach ($rank as $key => $val) : ?>
                <tr>
                    <td><?= $val ?></td>
                    <td>Pola <?= $key ?></td>
                    <td><?= round($topsis->jarak_solusi[$key]['positif'], 5) ?></td>
                    <td><?= round($topsis->jarak_solusi[$key]['negatif'], 5) ?></td>
                    <td><?= round($topsis->preferensi[$key], 5) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="panel-footer">
        <?php
        reset($rank);
        $kode_pola = key($rank);
        $arr = explode('_', $kode_pola);
        $id_alternatif = $arr[1];
        $_SESSION['post']['id_alternatif'] = $id_alternatif;
        $_SESSION['post']['bobot'] = $topsis->bobot;
        ?>
        Berdasarkan perhitungan di atas yang paling sesuai adalah <b><?= $ALTERNATIF[$id_alternatif] ?></b>
    </div>
</div>
<a class="btn btn-primary" onclick="return confirm('Simpan Data?')" href="aksi.php?m=simpan_data"><span class="glyphicon glyphicon-save"></span> Simpan Data</a>