<input id="pac-input" class="controls" type="text" placeholder="Search Place" style="width:30%;">

<div class="form-group row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <div id="map-canvas" style="width:97%;height:400px;">

        </div>
        <div id="ajax_msg"></div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 form-control-label" for="input-latitude">@lang('merchant::labels.backend.merchant.table.latitude')<span
            class="text-danger">*</span></label>
    <div class="col-md-10">
        <input value="{{ $latitude ?? '' }}" class="form-control" type="text" name="latitude" id="input-latitude"
            placeholder="@lang('merchant::labels.backend.merchant.table.latitude')" maxlength="191" required="">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2 form-control-label" for="input-longitude">@lang('merchant::labels.backend.merchant.table.longitude')<span
            class="text-danger">*</span></label>
    <div class="col-md-10">
        <input class="form-control" value="{{ $longitude ?? '' }}" type="text" name="longitude" id="input-longitude"
            placeholder="@lang('merchant::labels.backend.merchant.table.longitude')" maxlength="191" required="">
    </div>
</div>

@push('before-scripts')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('appsetting.basic.map_key') }}&libraries=weather,geometry,visualization,places,drawing&callback=initMap">
    </script>
@endpush

@push('after-scripts')
    <script>
        function initMap() {
            var mapOptions = {
                @if (old('latitude') && old('longitude'))
                    center: new google.maps.LatLng('{{ old('latitude') }}', '{{ old('longitude') }}'),
                @elseif (isset($latitude) && isset($longitude))
                    center: new google.maps.LatLng('{{ $latitude }}', '{{ $longitude }}'),
                @else
                    center: new google.maps.LatLng(16.798703652839684, 96.14947007373053),
                @endif
                zoom: 13
            };
            console.log(mapOptions);
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            @if (old('latitude') && old('longitude'))
                var marker_position = new google.maps.LatLng('{{ old('latitude') }}', '{{ old('longitude') }}');
            @elseif (isset($latitude) && isset($longitude))
                var marker_position = new google.maps.LatLng('{{ $latitude }}', '{{ $longitude }}');
            @else
                var marker_position = new google.maps.LatLng(16.798703652839684, 96.14947007373053);
            @endif
            var input = /** @type {HTMLInputElement} */ (
                document.getElementById('pac-input'));

            var types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                position: marker_position,
                draggable: true,
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });


            google.maps.event.addListener(marker, "mouseup", function(event) {
                $('#input-latitude').val(this.position.lat());
                $('#input-longitude').val(this.position.lng());
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setIcon( /** @type {google.maps.Icon} */ ({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                $('#input-latitude').val(place.geometry.location.lat());
                $('#input-longitude').val(place.geometry.location.lng());
                infowindow.open(map, marker);
            });


            google.maps.event.addListener(marker, 'dragend', function(event) {
                $('#input-latitude').val(event.latLng.lat());
                $('#input-longitude').val(event.latLng.lng());

            });

        }
        if ($('#map-canvas').length != 0) {
            window.addEventListener('load', initMap);
        }
    </script>
@endpush
