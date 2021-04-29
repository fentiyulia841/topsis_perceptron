<div class="page-header">
    <h1>Bencana</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="bencana" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Sektor</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                    <th>Hasil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_bencana b INNER JOIN tb_jenis j ON j.id_jenis=b.id_jenis INNER JOIN tb_sektor s ON s.id_sektor=b.id_sektor WHERE lokasi LIKE '%$q%' OR nama_jenis LIKE '%$q%' OR nama_sektor LIKE '%$q%' ORDER BY id_bencana DESC");

            $data = get_rel_bencana();

            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $row->lokasi ?></td>
                    <td><?= $row->tanggal_kejadian ?></td>
                    <td><?= $row->nama_jenis ?></td>
                    <td><?= $row->nama_sektor ?></td>
                    <?php foreach ($data[$row->id_bencana] as $key => $val) : ?>
                        <td><?= $CRIPS[$val]->nama_crips ?></td>
                    <?php endforeach ?>
                    <td><?= $ALTERNATIF[$row->id_alternatif] ?></td>
                    <td class="nw">
                        <!-- <a class="btn btn-xs btn-warning" href="?m=bencana_detail&ID=<?= $row->id_bencana ?>"><span class="glyphicon glyphicon-search"></span></a> -->
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=bencana_hapus&ID=<?= $row->id_bencana ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>