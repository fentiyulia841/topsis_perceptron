<?php
require_once 'functions.php';

/** kriteria **/ 
if ($mod == 'kriteria_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $nilai_kriteria = $_POST['nilai_kriteria'];
    $bb = $_POST['bb'];
    $ba = $_POST['ba'];

    if ($kode_kriteria == '' || $nama_kriteria == '' || $nilai_kriteria == '' || $bb == '' || $ba == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_kriteria(kode_kriteria, nama_kriteria, nilai_kriteria, bb, ba) VALUES ('$kode_kriteria', '$nama_kriteria', '$nilai_kriteria', '$bb', '$ba')");

        $id_kriteria = $db->insert_id;
        $db->query("INSERT INTO tb_pola_detail (id_pola, id_alternatif, id_kriteria) SELECT id_pola, id_alternatif, '$id_kriteria' FROM tb_pola, tb_alternatif");

        redirect_js("index.php?m=kriteria");
    }
} elseif ($mod == 'kriteria_ubah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $nilai_kriteria = $_POST['nilai_kriteria'];
    $bb = $_POST['bb'];
    $ba = $_POST['ba'];

    if ($kode_kriteria == '' || $nama_kriteria == '' || $nilai_kriteria == '' || $bb == '' || $ba == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria' AND id_kriteria<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("UPDATE tb_kriteria SET kode_kriteria='$kode_kriteria', nama_kriteria='$nama_kriteria', nilai_kriteria='$nilai_kriteria', bb='$bb', ba='$ba' WHERE id_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }
} elseif ($act == 'kriteria_hapus') {
    $db->query("DELETE FROM tb_kriteria WHERE id_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_pola_detail WHERE id_kriteria='$_GET[ID]'");
    // $db->query("DELETE FROM tb_bencana_detail WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
}
//sektor
elseif ($mod == 'sektor_tambah') {
    $nama_sektor = $_POST['nama_sektor'];
    if ($nama_sektor == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_sektor(nama_sektor) VALUES ('$nama_sektor')");
        redirect_js("index.php?m=sektor");
    }
} elseif ($mod == 'sektor_ubah') {
    $nama_sektor = $_POST['nama_sektor'];

    if ($nama_sektor == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_sektor SET nama_sektor='$nama_sektor' WHERE id_sektor='$_GET[ID]'");
        redirect_js("index.php?m=sektor");
    }
} elseif ($act == 'sektor_hapus') {
    $db->query("DELETE FROM tb_sektor WHERE id_sektor='$_GET[ID]'");
    header("location:index.php?m=sektor");
}

//alternatif
elseif ($mod == 'alternatif_tambah') {
    $nama_alternatif = $_POST['nama_alternatif'];
    if ($nama_alternatif == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_alternatif(nama_alternatif) VALUES ('$nama_alternatif')");
        $id_alternatif = $db->insert_id;
        $db->query("INSERT INTO tb_pola_detail (id_pola, id_alternatif, id_kriteria) SELECT id_pola, '$id_alternatif', id_kriteria FROM tb_pola, tb_kriteria");
        redirect_js("index.php?m=alternatif");
    }
} elseif ($mod == 'alternatif_ubah') {
    $nama_alternatif = $_POST['nama_alternatif'];

    if ($nama_alternatif == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_alternatif SET nama_alternatif='$nama_alternatif' WHERE id_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }
} elseif ($act == 'alternatif_hapus') {
    $db->query("DELETE FROM tb_alternatif WHERE id_alternatif='$_GET[ID]'");
    $db->query("DELETE FROM tb_pola_detail WHERE id_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
}

//jenis
elseif ($mod == 'jenis_tambah') {
    $nama_jenis = $_POST['nama_jenis'];
    if ($nama_jenis == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_jenis(nama_jenis) VALUES ('$nama_jenis')");
        redirect_js("index.php?m=jenis");
    }
} elseif ($mod == 'jenis_ubah') {
    $nama_jenis = $_POST['nama_jenis'];

    if ($nama_jenis == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_jenis SET nama_jenis='$nama_jenis' WHERE id_jenis='$_GET[ID]'");
        redirect_js("index.php?m=jenis");
    }
} elseif ($act == 'jenis_hapus') {
    $db->query("DELETE FROM tb_jenis WHERE id_jenis='$_GET[ID]'");
    header("location:index.php?m=jenis");
}


//pola
elseif ($mod == 'pola_tambah') {
    $id_jenis = $_POST['id_jenis'];
    $id_sektor = $_POST['id_sektor'];
    $tanggal_kejadian = $_POST['tanggal_kejadian'];

    if ($id_jenis == '' || $id_sektor == '' || $tanggal_kejadian == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_pola(id_jenis, id_sektor, tanggal_kejadian, tanggal_input) VALUES ('$id_jenis', '$id_sektor', '$tanggal_kejadian', NOW())");

        $id_pola = $db->insert_id;
        $db->query("INSERT INTO tb_pola_detail (id_pola, id_alternatif, id_kriteria) SELECT '$id_pola', id_alternatif, id_kriteria FROM tb_alternatif, tb_kriteria");

        redirect_js("index.php?m=pola");
    }
} elseif ($mod == 'pola_ubah') {
    $nama_pola = $_POST['nama_pola'];

    if ($nama_pola == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_pola SET nama_pola='$nama_pola' WHERE id_pola='$_GET[ID]'");
        redirect_js("index.php?m=pola");
    }
} elseif ($act == 'pola_hapus') {
    $db->query("DELETE FROM tb_pola WHERE id_pola='$_GET[ID]'");
    header("location:index.php?m=pola");
}


/** crips */
elseif ($mod == 'crips_tambah') {
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $nama_crips = $_POST['nama_crips'];
    $nilai = $_POST['nilai'];

    if ($id_kriteria == '' || $nama_kriteria == '' || $nama_crips == '' || $nilai == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_crips (id_kriteria, nama_kriteria, nama_crips, nilai) VALUES ('$id_kriteria','$nama_kriteria', '$nama_crips', '$nilai')");
        redirect_js("index.php?m=crips&nama_kriteria");
    }



} else if ($mod == 'crips_ubah') {
    $id_kriteria = $_POST['id_kriteria'];
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_crips = $_POST['nama_crips'];
    $nilai = $_POST['nilai'];

    if ($id_kriteria == '' || $nama_kriteria == '' || $nama_crips == '' || $nilai == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_crips SET id_kriteria='$id_kriteria', nama_kriteria='$nama_kriteria', nama_crips='$nama_crips', nilai='$nilai' WHERE id_crips='$_GET[ID]'");
        redirect_js("index.php?m=crips&nama_kriteria");
    }



} else if ($act == 'crips_hapus') {
    $db->query("DELETE FROM tb_crips WHERE id_crips='$_GET[ID]'");
    header("location:index.php?m=crips&kode_kriteria");
} elseif ($mod == 'simpan_data') {
    $post = $_SESSION['post'];
    $lokasi = $post['lokasi'];
    $tanggal = $post['tanggal'];
    $id_jenis = $post['id_jenis'];
    $id_sektor = $post['id_sektor'];
    $nilai = $post['nilai'];

    $id_alternatif = $post['id_alternatif'];
    $db->query("INSERT INTO tb_bencana (lokasi, tanggal_kejadian, tanggal_input, id_jenis, id_sektor, id_alternatif) VALUES ('$lokasi', '$tanggal', NOW(), '$id_jenis', '$id_sektor','$id_alternatif')");
    $id_bencana = $db->insert_id;
    foreach ($nilai as $key => $val) {
        $db->query("INSERT INTO tb_bencana_detail (id_bencana, id_kriteria, id_crips) VALUES ('$id_bencana', '$key', '$val')");
    }
    if ($post['bobot']) {
        foreach ($post['bobot'] as $key => $val)
            $db->query("UPDATE tb_kriteria SET nilai_kriteria='$val' WHERE id_kriteria='$key'");
    }
    header("location:index.php?m=bencana");
} else if ($act == 'bencana_hapus') {
    $db->query("DELETE FROM tb_bencana WHERE id_bencana='$_GET[ID]'");
    header("location:index.php?m=bencana");
}
