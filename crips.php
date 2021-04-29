<div class="page-header">
    <h1>Nilai Skala Pembobotan dan Penilaian</h1>
</div>
<div class="panel panel-default">

    <!-- panel pencarian dan refresh -->
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="crips" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian...">
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=crips_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <!-- end -->

    <!-- panel data pembobotan -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Nama</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT *
                FROM tb_crips c INNER JOIN tb_kriteria k ON k.id_kriteria=c.id_kriteria 
                WHERE k.nama_kriteria LIKE '%$q%' 
                ORDER BY k.id_kriteria, nilai");
            $no = 1;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->id_kriteria ?></td>
                    <td><?= $row->nama_kriteria ?></td>
                    <td><?= $row->nama_crips ?></td>
                    <td><?= $row->nilai ?></td>
                    <td>
                    <a class="btn btn-info btn-circle btn-sm" 
                        href="?m=crips_ubah&ID=<?= $row->id_crips ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a class="btn btn-danger btn-circle btn-sm" 
                        href="aksi.php?act=crips_hapus&ID=<?= $row->id_crips ?>" 
                        onclick="return confirm('Hapus data?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <!-- end -->


</div>