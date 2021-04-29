<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_kriteria" value="<?= set_value('kode_kriteria', kode_oto('kode_kriteria', 'tb_kriteria', 'K', 1)) ?>" />
            </div> 

            <div class="form-group">
                <label>Nama Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_kriteria" value="<?= set_value('nama_kriteria') ?>" />
            </div>

            <div class="form-group">
                <label>Nilai Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai_kriteria" value="<?= set_value('nilai_kriteria') ?>" />
            </div>

            <div class="form-group">
                <label>Batas Bawah <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="bb" value="<?= set_value('bb') ?>" />
            </div>

            <div class="form-group">
                <label>Batas Atas <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="ba" value="<?= set_value('ba') ?>" />
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
            
        </form>


    </div>
</div>