<div class="page-header">
    <h1>TOPSIS</h1>
</div>
<?php
$id_pola = $_GET['ID'];
$pola = $db->get_row("SELECT * FROM tb_pola WHERE id_pola='$id_pola'");
$pola_detail = get_pola_detail($id_pola);
?>
Jenis: <?= $JENIS[$pola->id_jenis] ?><br />
Sektor: <?= $SEKTOR[$pola->id_sektor] ?><br />
Tanggal Kejadian: <?= $pola->tanggal_kejadian ?><br />
Tanggal Input: <?= $pola->tanggal_input ?><br />
<hr />
<?php
if ($_POST) {
    $nilai = $_POST['nilai'];
    foreach ($nilai as $key => $val) {
        foreach ($val as $k => $v) {
            $db->query("UPDATE tb_pola_detail SET id_crips='$v' WHERE id_pola='$id_pola' AND id_alternatif='$key' AND id_kriteria='$k'");
        }
    }
    print_msg('Nilai tersimpan!', 'success');
    $pola_detail = get_pola_detail($id_pola);
}
$data = $pola_detail;
$data_nilai = get_rel_nilai($data);
$topsis = new TOPSIS($data_nilai, $ATRIBUT, $BOBOT);
$rank = get_rank($topsis->preferensi);
// echo '<pre>' . print_r($topsis, 1) . '</pre>';
?>
<form method="post">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Data Nilai</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover nw">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <?php foreach ($KRITERIA as $key => $val) : ?>
                            <th><?= $val->nama_kriteria ?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
                <?php foreach ($pola_detail as $key => $val) : ?>
                    <tr>
                        <td><?= $ALTERNATIF[$key] ?></td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td>
                                <select class="form-control" name="nilai[<?= $key ?>][<?= $k ?>]">
                                    <?= get_crips_option($k, $v) ?>
                                </select>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=pola"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </div>
    </div>
</form>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover nw">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($data as $key => $val) : ?>
                <tr>
                    <td><?= $ALTERNATIF[$key] ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $CRIPS[$v]->nama_crips ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nilai Hasil Analisa</h3>
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
                    <td><?= $ALTERNATIF[$key] ?></td>
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
        <h3 class="panel-title">Normalisasi</h3>
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
                    <td><?= $ALTERNATIF[$key] ?></td>
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
                    <td><?= $ALTERNATIF[$key] ?></td>
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
                    <td><?= $key ?></td>
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
            <?php foreach ($rank as $key => $val) : ?>
                <tr>
                    <td><?= $val ?></td>
                    <td><?= $ALTERNATIF[$key] ?></td>
                    <td><?= round($topsis->jarak_solusi[$key]['positif'], 5) ?></td>
                    <td><?= round($topsis->jarak_solusi[$key]['negatif'], 5) ?></td>
                    <td><?= round($topsis->preferensi[$key], 5) ?></td>
                </tr>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>