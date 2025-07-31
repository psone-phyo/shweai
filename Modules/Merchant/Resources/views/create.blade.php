@extends ('backend.layouts.app')

@section('title', __('merchant::labels.backend.merchant.management') . ' | ' .
    __('merchant::labels.backend.merchant.create'))

@section('breadcrumb-links')
    @include('merchant::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
@endpush

@section('content')
    @inject('merchantStatus', 'Modules\Merchant\Enums\MerchantStatus')

    {{ html()->form('POST', route('admin.merchant.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('merchant::labels.backend.merchant.management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- Name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.company_name'))->class('col-md-2 form-control-label')->for('company_name') }}

                        <div class="col-md-10">
                            {{ html()->text('company_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.company_name'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- mm_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.mm_company_name'))->class('col-md-2 form-control-label')->for('mm_company_name') }}

                        <div class="col-md-10">
                            {{ html()->text('mm_company_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.mm_company_name'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_name'))->class('col-md-2 form-control-label')->for('business_name') }}

                        <div class="col-md-10">
                            {{ html()->text('business_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.business_name'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- mm_business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.mm_business_name'))->class('col-md-2 form-control-label')->for('mm_business_name') }}

                        <div class="col-md-10">
                            {{ html()->text('mm_business_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.mm_business_name'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- mm_business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.registration_number'))->class('col-md-2 form-control-label')->for('registration_number') }}

                        <div class="col-md-10">
                            {{ html()->text('registration_number')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.registration_number'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- Business Email --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_email'))->class('col-md-2 form-control-label')->for('business_email') }}

                        <div class="col-md-10">
                            {{ html()->email('business_email')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.business_email'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- Business Phone --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_mobile'))->class('col-md-2 form-control-label')->for('business_mobile') }}

                        <div class="col-md-10">
                            {{ html()->text('business_mobile')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.business_mobile'))->attribute('maxlength', 20)->required() }}
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->textarea('address')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.address'))->required() }}
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.choose_location'))->class('col-md-2 form-control-label')->for('choose_location') }}

                        <div class="col-md-10">
                            <input id="pac-input" class="controls" type="text" placeholder="Search Place">
                            <div id="map-canvas" style="width:97%;height:400px;"></div>
                            <div id="ajax_msg"></div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.location'))->class('col-md-2 form-control-label')->for('location') }}

                        <div class="col-md-10" style="display: flex;">
                            <div class="col-md-6">
                                {{ html()->text('latitude')->class('form-control')->id('input-latitude')->placeholder(__('merchant::labels.backend.merchant.table.latitude')) }}
                            </div>

                            <div class="col-md-6">
                                {{ html()->text('longitude')->class('form-control')->id('input-longitude')->placeholder(__('merchant::labels.backend.merchant.table.longitude')) }}
                            </div>

                        </div><!--col-->
                    </div><!--form-group-->

                    {{-- Website URL --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.website_url'))->class('col-md-2 form-control-label')->for('website_url') }}

                        <div class="col-md-10">
                            {{ html()->text('website_url')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.website_url')) }}
                        </div>
                    </div>

                    {{-- Approximate Sale --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.approximate_sale'))->class('col-md-2 form-control-label')->for('approximate_sale') }}

                        <div class="col-md-10">
                            {{ html()->text('approximate_sale')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.approximate_sale')) }}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.status'))->class('col-md-2 form-control-label')->for('status') }}

                        <div class="col-md-10">
                            {{ html()->select('status', $merchantStatus::AVAILABLES_CREATE)->class('form-control select2 merchant_status')->required() }}

                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.active'))->class('col-md-2 form-control-label')->for('merchant_active') }}

                        <div class="col-md-10">
                            {{ html()->select('merchant_active', [1 => 'Active', 0 => 'Inactive'])->class('form-control select2 merchant_active')->required() }}

                        </div>
                    </div>

                    <h4 class="mt-2">{{ __("merchant::labels.backend.merchant.merchant_ownership") }}</h4>
                        @include('merchantuser::includes.merchant_user_form')
                </div>

            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.merchant.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('appsetting.basic.map_key') }}&libraries=weather,geometry,visualization,places,drawing&callback=initMap"
        async defer></script>
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    {{ script('assets/plugins/select2/component/components-select2.js') }}

    <script>
        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(16.798703652839684, 96.14947007373053),
                zoom: 13
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            var marker_position = new google.maps.LatLng(16.798703652839684, 96.14947007373053);
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


            google.maps.event.addListener(marker, 'dragend', function() {
                const lat = this.getPosition().lat();
                const lng = this.getPosition().lng();

                $('#input-latitude').val(lat);
                $('#input-longitude').val(lng);
            });


            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
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

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                $('input[name=address]').val(place.formatted_address);

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });


            google.maps.event.addListener(marker, 'dragend', function() {
                $('#input-latitude').val(place.geometry.location.lat());
                $('#input-longitude').val(place.geometry.location.lng());

            });

        }

        if ($('#map-canvas').length != 0) {
            google.maps.event.addDomListener(window, 'load', initMap);
        }

        $(document).ready(function() {
            $('.merchant_status').select2({
                placeholder: "Choose Status",
                width: '100%'
            });

            $('.merchant_active').select2({
                placeholder: "Choose Status",
                width: '100%'
            });

        });
    </script>
@endpush
