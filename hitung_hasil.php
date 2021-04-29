<?php
$id_jenis = $_POST['id_jenis'];
$id_sektor = $_POST['id_sektor'];
$rows_pola = $db->get_results("SELECT * FROM tb_pola WHERE id_jenis='$id_jenis' AND id_sektor='$id_sektor' ORDER BY tanggal_kejadian DESC");


// echo '<pre>' . print_r($rows_pola, 1) . '</pre>';

if ($rows_pola) : // jika ditemukan jenis dan sektor yang sesuai
    $pola_details = array();
    $id_alternatif = '';
    $id_pola = '';
    foreach ($rows_pola as $row) {
        $pola_details[$row->id_pola] = get_pola_detail($row->id_pola);
        foreach ($pola_details[$row->id_pola] as $key => $val) {
            $match  = true;
            foreach ($val as $k => $v) {
                if ($nilai[$k] != $v) {
                    $match = false;
                    break;
                }
            }
            if ($match && !$id_alternatif) {
                $id_alternatif = $key;
                $id_pola = $row->id_pola;
                break;
            }
        }
        // if ($id_alternatif)
        //     break;
    }
    // echo '<pre>' . print_r($id_alternatif, 1) . '</pre>';
    $_SESSION['post'] = $_POST;
    if ($id_alternatif)
        include 'hitung_hasil_ketemu.php';
    else
        include 'hitung_hasil_ag.php';
else :
    print_msg('Tidak ditemukan hasil sesuai inputan jenis dan sektor bencana!');
endif;
