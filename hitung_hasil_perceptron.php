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



<!-- AG -->
<!-- <h2>Proses AG</h2> -->


<!-- <?php -->

// echo '<hr />';

// $row = $db->get_row("SELECT MIN(nilai) AS bb, MAX(nilai) AS ba FROM tb_crips");
// $jumlah_kromosom = 5;
// $max_generation = 10;
// $kromosom = array();
// for ($a = 1; $a <= $jumlah_kromosom; $a++) {
//     foreach ($KRITERIA as $key => $val) {
//         $kromosom[$a][$key] = rand($row->bb, $row->ba);
//     }
// }

// echo '<pre>' . print_r($kromosom, 1) . '</pre>';

// $atribut = array();
// $range = array();
// foreach ($KRITERIA as $key => $val) {
//     $atribut[$key] = 'benefit';
//     $range[$key] = array($val->bb, $val->ba);
// }
// $ag = new Perceptron($kromosom, $data, $atribut, $range);
// $ag->max_generation = $max_generation;
// $ag->debug = 0;
// $ag->generate();
// AG END





// ambil nilai bobot kromosom terbaru
// $bobot = $ag->best_cromossom;
// hitung bobot menggunakan topsis
$topsis = new TOPSIS($data, $atribut, $bobot);
// ?>



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