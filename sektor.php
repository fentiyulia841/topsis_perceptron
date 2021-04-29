<div class="page-header">
    <h1>Sektor</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="sektor" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=sektor_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_sektor WHERE nama_sektor LIKE '%$q%' ORDER BY id_sektor");

        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->nama_sektor ?></td>
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
</div>