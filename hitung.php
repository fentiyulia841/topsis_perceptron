<div class="page-header">
    <h1>Hitung Bencana</h1>
</div>
<?php
$success = false;
if ($_POST) {
    $success = true;
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $id_jenis = $_POST['id_jenis'];
    $id_sektor = $_POST['id_sektor'];
    $nilai = $_POST['nilai'];
    if ($lokasi == '' || $tanggal == '' || $id_jenis == '' || $id_sektor == '') {
        print_msg('Field bertanda * tidak boleh kosong!');
        $success = false;
    }
}
include 'hitung_form.php';
if ($success)
    include 'hitung_hasil.php';
?>