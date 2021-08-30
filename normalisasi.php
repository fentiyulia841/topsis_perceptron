<div class="page-header">
    <h1>Normalisasi</h1>
</div>
<div class="panel panel-default">
    <!-- form tambah start -->
    <div class="panel-heading">
        <form class="form-inline">
            <!-- input name m -->
            <input type="hidden" name="m" value="normalisasi" />

            
            <!-- input name q -->
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>

        </form>
    </div>
    <!-- form tambah end -->

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>id_nilai</th>
                <th>id_kasus</th>
                <th>id_kriteria</th>
                <th>id_alternatif</th>
                <th>id_bobot</th>
                <th>id_skala</th>
                <th>Normalisasi</th>
                <!-- <th>Batas</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <?php

        // mengambil nilai pada form input kriteria name = "q"
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM 2normalisasi 
            WHERE idnilai LIKE '%$q%'                 
            ORDER BY idnilai");

        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->idnilai ?></td>
                <td><?= $row->idkasus ?></td>
                <td><?= $row->idkriteria ?></td>
                <td><?= $row->idalternatif ?></td>
                <td><?= $row->idbobot ?></td>
                <td><?= $row->idskala ?></td>
                <td><?= $row->normalisasi ?></td>
                <!-- <td><?= $row->bb ?>-<?= $row->ba ?></td> -->
 
                <!-- aksi updata dan delete -->
                <td>
                    <a class="btn btn-info btn-circle btn-sm" 
                        href="?m=kriteria_ubah&ID=<?= $row->idnilai ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a class="btn btn-danger btn-circle btn-sm" 
                        href="aksi.php?act=kriteria_hapus&ID=<?= $row->idnilai ?>" 
                        onclick="return confirm('Hapus data?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>


            </tr>
        <?php endforeach; ?>
    </table>


    <!-- <div class="panel-footer">
        <?php
        foreach ($VARIABEL as $key => $val) {
            $arr[] = $val->nilai_kriteria . '*' . $val->kode_kriteria;
        }
        ?>
        F(x) = [(<?= implode(' + ', $arr) . ') +' . $Y ?>]
        <br>dimana:
        <?php foreach ($VARIABEL as $key => $val) : ?>
            <br><?= $val->bb . " &leq; " . $val->kode_kriteria . " &leq; " . $val->ba ?>
        <?php endforeach ?>
    </div> -->

</div>