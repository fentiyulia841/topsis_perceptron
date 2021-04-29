<h1>Hasil Pencarian</h1>

<?php
print_msg("Berdasarkan pencarian, ditemukan hasil yaitu <b>" . $ALTERNATIF[$id_alternatif] . '</b> sesuai pola di bawah:', 'success');
$pola = $db->get_row("SELECT * FROM tb_pola WHERE id_pola='$id_pola'");
$pola_detail = get_pola_detail($id_pola);
$_SESSION['post']['id_alternatif'] = $id_alternatif;
?>

Jenis: <?= $JENIS[$pola->id_jenis] ?><br />
Sektor: <?= $SEKTOR[$pola->id_sektor] ?><br />
Tanggal Kejadian: <?= $pola->tanggal_kejadian ?><br />
Tanggal Input: <?= $pola->tanggal_input ?><br />
Alternatif: <?= $ALTERNATIF[$id_alternatif] ?><br />

<?php foreach ($pola_detail[$id_alternatif] as $key => $val) : ?>
    - <?= $KRITERIA[$key]->nama_kriteria ?>: <?= $CRIPS[$val]->nama_crips ?> <br />
<?php endforeach ?>

<hr />

 
<a class="btn btn-primary" onclick="return confirm('Simpan Data?')" href="aksi.php?m=simpan_data"><span class="glyphicon glyphicon-save"></span> Simpan Data</a>