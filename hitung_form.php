<form method="post">
    <div class=" row">
        <div class="col-sm-6">
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="form-group">
                <label>Lokasi <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="lokasi" value="<?= set_value('lokasi') ?>" id="lokasi" />
                <p class="help-block">Gunakan pencarian di samping atau geser marker untuk menentukan lokasi.</p>
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
        <div class="col-sm-6">
            <div class="form-group">
                <input class="form-control" type="text" id="pac-input" placeholder="Cari lokasi" />
            </div>
            <div id="map" style="height: 400px;"></div>
            <div class="form-group">
                <label>Latitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="lat" id="lat" value="<?= set_value('lat') ?>" />
            </div>
            <div class="form-group">
                <label>Longitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="lng" name="lng" value="<?= set_value('lng') ?>" />
            </div>
        </div>
    </div>
</form>
<script>
    var defaultCenter = {
        lat: default_lat,
        lng: default_lng
    };
    var lines = [];

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: default_zoom,
            center: defaultCenter
        });

        var marker = new google.maps.Marker({
            position: defaultCenter,
            map: map,
            title: 'Click to zoom',
            draggable: true
        });

        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);

        var infowindow = new google.maps.InfoWindow({
            content: '<h4>Drag untuk pindah lokasi</h4>'
        });

        infowindow.open(map, marker);
        var infowindowContent = document.getElementById('infowindow-content');

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            console.log(place);
            document.getElementById('lokasi').value = place.formatted_address;
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent(place.name + '');
            infowindow.open(map, marker);
        });
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    }

    $(function() {
        initMap();
    })
</script>