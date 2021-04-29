<div class="page-header">
    <h1>Pola</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="pola" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=pola_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>



    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Bencana</th>
                <th>Sektor</th>
                <th>Tanggal Kejadian</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>


        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_pola p INNER JOIN tb_jenis j ON j.id_jenis=p.id_jenis INNER JOIN tb_sektor s ON s.id_sektor=p.id_sektor WHERE nama_jenis LIKE '%$q%' OR nama_sektor LIKE '%$q%' ORDER BY id_pola");

        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->nama_jenis ?></td>
                <td><?= $row->nama_sektor ?></td>
                <td><?= $row->tanggal_kejadian ?></td>
                <td><?= $row->tanggal_input ?></td>
                <td>
                    <a class="btn btn-xs btn-primary" 
                    href="?m=pola_topsis&ID=<?= $row->id_pola ?>">
                    <span class="glyphicon glyphicon-signal"></span>TOPSIS</a>
                    
                    <a class="btn btn-info btn-circle btn-sm" 
                        href="?m=pola_ubah&ID=<?= $row->id_pola ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a class="btn btn-danger btn-circle btn-sm" 
                        href="aksi.php?act=pola_hapus&ID=<?= $row->id_pola ?>" 
                        onclick="return confirm('Hapus data?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
</div>