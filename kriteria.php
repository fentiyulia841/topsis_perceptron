<div class="page-header">
    <h1>Kriteria</h1>
</div>
<div class="panel panel-default">
    <!-- form tambah start -->
    <div class="panel-heading">
        <form class="form-inline">
            <!-- input name m -->
            <input type="hidden" name="m" value="kriteria" />

            
            <!-- input name q -->
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>

            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>

            <!-- button tambah memanggil class kriteria_tambah.php untuk menambah data -->
            <div class="form-group">
                <a class="btn btn-primary" href="?m=kriteria_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>

        </form>
    </div>
    <!-- form tambah end -->

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Nilai</th>
                <!-- <th>Batas</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <?php

        // mengambil nilai pada form input kriteria name = "q"
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_kriteria 
            WHERE kode_kriteria LIKE '%$q%'                 
            ORDER BY kode_kriteria");

        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->kode_kriteria ?></td>
                <td><?= $row->nama_kriteria ?></td>
                <td><?= $row->nilai_kriteria ?></td>
                <!-- <td><?= $row->bb ?>-<?= $row->ba ?></td> -->
                <td>
                    <a class="btn btn-info btn-circle btn-sm" 
                        href="?m=kriteria_ubah&ID=<?= $row->id_kriteria ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a class="btn btn-danger btn-circle btn-sm" 
                        href="aksi.php?act=kriteria_hapus&ID=<?= $row->id_kriteria ?>" 
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