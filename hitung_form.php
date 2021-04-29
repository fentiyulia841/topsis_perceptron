<form method="post">
    <div class=" row">
        <div class="col-sm-6">
            <?php if ($_POST) include 'aksi.php' ?>

            <div class="form-group">
                <label>Lokasi Bencana <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="lokasi" value="<?= set_value('lokasi') ?>" id="lokasi" />
            </div>

            <div class="form-group">
                <label>Tanggal Kejadian <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d')) ?>" />
            </div>

            <div class="form-group">
                <label>Jenis Bencana <span class="text-danger">*</span></label>
                <select class="form-control" name="id_jenis">
                    <?= get_jenis_option(set_value('id_jenis')) ?>
                </select>
            </div>

            <div class="form-group">
                <label>Sektor Bencana <span class="text-danger">*</span></label>
                <select class="form-control" name="id_sektor">
                    <?= get_sektor_option(set_value('id_sektor')) ?>
                </select>
            </div>


            <?php foreach ($KRITERIA as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val->nama_kriteria ?></label>
                    <select class="form-control" name="nilai[<?= $key ?>]">
                        <?= get_crips_option($key, $_POST['nilai'][$key]) ?>
                    </select>
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Hitung</button>
            </div>
        </div>


    </div>
</form>