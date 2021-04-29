<div class="page-header">
    <h1>Tambah Pola</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Jenis Bencana <span class="text-danger">*</span></label>
                <select class="form-control" name="id_jenis">
                    <?= get_jenis_option(set_value('id_jenis')) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Sektor <span class="text-danger">*</span></label>
                <select class="form-control" name="id_sektor">
                    <?= get_sektor_option(set_value('id_sektor')) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal_kejadian" value="<?= set_value('tanggal_kejadian', date('Y-m-d')) ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pola"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>