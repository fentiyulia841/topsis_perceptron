<div class="page-header">
    <h1>Tambah Crips</h1>
</div> 

<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>

        <form method="post">

            <div class="form-group">
                <label>Id Kriteria</label>
                <select class="form-control" name="id_kriteria"><?= get_idkriteria_option(set_value('id_kriteria')) ?></select>
            </div>

            <div class="form-group">
                <label>Nama Kriteria</label>
                <select class="form-control" name="nama_kriteria"><?= get_kriteria_option(set_value('nama_kriteria')) ?></select>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama_crips" value="<?= set_value('nama_crips') ?>" />
            </div>

            <div class="form-group">
                <label>Nilai</label>
                <input class="form-control" type="text" name="nilai" value="<?= set_value('nilai') ?>" />
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=crips"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>

    </div>


</div>