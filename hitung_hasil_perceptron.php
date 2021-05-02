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

$row = $db->get_row("SELECT nilai FROM tb_crips ORDER BY RAND() LIMIT 5");

$normalisasi = [];

foreach ($row as $key => $value) {
    $normalisasi[] = $value['nilai'];
}

$targetAngka  = 1;

include ('perceptron/process/proses_perceptron.php');
$epoh = 1;
$perceptron = new Perceptron();
// while (true) {
		// echo "<h4>EPOH ke-$epoh</h4>";
        $y_in = $perceptron->hitung_yin($normalisasi[0],$normalisasi[1],$normalisasi[2],$normalisasi[3],$normalisasi[4]);
        $hasilAktivasi = $perceptron->set_aktivasi($y_in);
        $perceptron->cek_target($targetAngka,$hasilAktivasi,$normalisasi[0],$normalisasi[1],$normalisasi[2],$normalisasi[3],$normalisasi[4]);
        $error= $perceptron->cek_error($hasilAktivasi);

        echo "<table class='table table-striped table-hover'>
                <thead>
                
                <th>y_in</th>
                <th>Aktivasi</th>
                <th>Target</th>
                <th>Error</th>
                <th>Bobot dan Bias</th>
                </thead>
                <tbody>
                <tr>
                
                <td>".round($y_in,2)."</td>
                <td>$hasilAktivasi</td>
                <td>".$targetAngka."</td>
                <td>$error</td>
                <td>W1 = ".$perceptron->get_bobot1().", W2 = ".$perceptron->get_bobot2().", W3 = ".$perceptron->get_bobot3().", W4 = ".$perceptron->get_bobot4().", W5 = ".$perceptron->get_bobot5().", B = ".$perceptron->get_bobot1()."</td>
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
  

$bobot = [];
$bobot[] = $perceptron->get_bobot1();
$bobot[] = $perceptron->get_bobot2();
$bobot[] = $perceptron->get_bobot3();
$bobot[] = $perceptron->get_bobot4();
$bobot[] = $perceptron->get_bobot5();


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