<?php
error_reporting(~E_NOTICE);
session_start();

include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/perceptron_class.php';
include 'includes/topsis_class.php';

$mod = $_GET['m'];
$act = $_GET['act'];

$rows = $db->get_results("SELECT * FROM tb_alternatif ORDER BY id_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->id_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT * FROM tb_jenis ORDER BY id_jenis");
foreach ($rows as $row) {
    $JENIS[$row->id_jenis] = $row->nama_jenis;
}

$rows = $db->get_results("SELECT * FROM tb_sektor ORDER BY id_sektor");
foreach ($rows as $row) {
    $SEKTOR[$row->id_sektor] = $row->nama_sektor;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
foreach ($rows as $row) {
    $VARIABEL[$row->kode_kriteria] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_crips ORDER BY id_kriteria, nilai");
$CRIPS = array();
foreach ($rows as $row) {
    $CRIPS[$row->id_crips] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
$KRITERIA = array();
$ATRIBUT = array();
$BOBOT = array();
foreach ($rows as $row) {
    $KRITERIA[$row->id_kriteria] = $row;
    $ATRIBUT[$row->id_kriteria] = 'benefit';
    $BOBOT[$row->id_kriteria] = $row->nilai_kriteria;
}

function get_pola_detail($id_pola)
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_pola_detail WHERE id_pola='$id_pola' ORDER BY id_alternatif, id_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->id_alternatif][$row->id_kriteria] = $row->id_crips;
    }
    return $arr;
}

function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $value) {
        $new[$key] = $no++;
    }
    return $new;
}

function get_option($option_name)
{
    global $db;
    return $db->get_var("SELECT option_value FROM tb_options WHERE option_name='$option_name'");
}

function update_option($option_name, $option_value)
{
    global $db;
    return $db->query("UPDATE tb_options SET option_value='$option_value' WHERE option_name='$option_name'");
}
function get_rel_nilai($relasi)
{
    global $CRIPS;

    $arr = array();
    foreach ($relasi as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $CRIPS[$v]->nilai;
        }
    }

    return $arr;
}
function get_jenis_option($selected)
{
    global $JENIS;
    $a = '';
    foreach ($JENIS as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

// mengambil nama kriteria di tb_kriteria
function get_kriteria_option($selected)
{
    global $KRITERIA;
    $a = '';
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_kriteria</option>";
        else
            $a .= "<option value='$key'>$val->nama_kriteria</option>";
    }
    return $a;
}

// mengambil nama kriteria di tb_kriteria
function get_idkriteria_option($selected)
{
    global $KRITERIA;
    $a = '';
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->id_kriteria</option>";
        else
            $a .= "<option value='$key'>$val->id_kriteria</option>";
    }
    return $a;
}

function get_sektor_option($selected)
{
    global $SEKTOR;
    $a = '';
    foreach ($SEKTOR as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

function get_crips_option($id_kriteria, $selected = 0)
{
    global $CRIPS;
    $a = '';
    foreach ($CRIPS as $key => $val) {
        if ($val->id_kriteria == $id_kriteria) {
            if ($val->id_crips == $selected)
                $a .= "<option value='$val->id_crips' selected>$val->nama_crips ($val->nilai)</option>";
            else
                $a .= "<option value='$val->id_crips'>$val->nama_crips ($val->nilai)</option>";
        }
    }
    return $a;
}

function get_rel_bencana()
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_bencana_detail ORDER BY id_bencana, id_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->id_bencana][$row->id_kriteria] = $row->id_crips;
    }
    return $arr;
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function esc_field($str)
{
    return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}
