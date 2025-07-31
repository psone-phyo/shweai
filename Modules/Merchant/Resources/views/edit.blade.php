@extends ('backend.layouts.app')

@section('title', __('merchant::labels.backend.merchant.management') . ' | ' .
    __('merchant::labels.backend.merchant.edit'))

@section('breadcrumb-links')
    @include('merchant::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
@endpush

@section('content')
    @inject('merchantStatus', 'Modules\Merchant\Enums\MerchantStatus')

    {{ html()->modelForm($merchant, 'PATCH', route('admin.merchant.update', $merchant->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('merchant::labels.backend.merchant.management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.edit') }}</small>
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
                            {{ html()->text('mm_company_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.mm_company_name'))->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_name'))->class('col-md-2 form-control-label')->for('business_name') }}
                        <div class="col-md-10">
                            {{ html()->text('business_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.business_name'))->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- mm_business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.mm_business_name'))->class('col-md-2 form-control-label')->for('mm_business_name') }}
                        <div class="col-md-10">
                            {{ html()->text('mm_business_name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.mm_business_name'))->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- Registration Number --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.registration_number'))->class('col-md-2 form-control-label')->for('registration_number') }}
                        <div class="col-md-10">
                            {{ html()->text('registration_number')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.registration_number'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_email'))->class('col-md-2 form-control-label')->for('business_email') }}
                        <div class="col-md-10">
                            {{ html()->email('business_email')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.business_email'))->attribute('maxlength', 191)->required() }}
                        </div>
                    </div>

                    {{-- Phone --}}
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
                            {{ html()->textarea('address')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.address')) }}
                        </div>
                    </div>

                    {{-- Choose Location on Map --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.choose_location'))->class('col-md-2 form-control-label')->for('choose_location') }}
                        <div class="col-md-10">
                            <input id="pac-input" class="controls" type="text" placeholder="Search Place">
                            <div id="map-canvas" style="width:97%; height:400px;"></div>
                            <div id="ajax_msg"></div>
                        </div>
                    </div>

                    {{-- Latitude & Longitude --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.location'))->class('col-md-2 form-control-label') }}
                        <div class="col-md-10" style="display: flex;">
                            <div class="col-md-6">
                                {{ html()->text('latitude', $merchant->latitude)->class('form-control')->id('input-latitude')->placeholder(__('merchant::labels.backend.merchant.table.latitude')) }}
                            </div>
                            <div class="col-md-6">
                                {{ html()->text('longitude', $merchant->longitude)->class('form-control')->id('input-longitude')->placeholder(__('merchant::labels.backend.merchant.table.longitude')) }}
                            </div>
                        </div>
                    </div>

                    {{-- Website URL --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.website_url'))->class('col-md-2 form-control-label')->for('website_url') }}
                        <div class="col-md-10">
                            {{ html()->text('website_url')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.website_url'))}}
                        </div>
                    </div>

                    {{-- Approximate Sale --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.approximate_sale'))->class('col-md-2 form-control-label')->for('approximate_sale') }}
                        <div class="col-md-10">
                            {{ html()->text('approximate_sale')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.approximate_sale'))}}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.status'))->class('col-md-2 form-control-label')->for('status') }}
                        <div class="col-md-10">
                            {{ html()->select('status', $merchantStatus::AVAILABLES_CREATE, $merchant->status)->class('form-control select2 merchant_status')->required() }}
                        </div>
                    </div>

                    {{-- Active --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.active'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->select('active', [1 => 'Active', 0 => 'Inactive'], $merchant->active)->class('form-control select2 merchant_active')->required() }}
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.merchant.index'), __('buttons.general.cancel')) }}
                </div><!--col-->
                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
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
            const defaultLat = parseFloat($('#input-latitude').val()) || 16.798703652839684;
            const defaultLng = parseFloat($('#input-longitude').val()) || 96.14947007373053;
            const defaultPosition = new google.maps.LatLng(defaultLat, defaultLng);

            const mapOptions = {
                center: defaultPosition,
                zoom: 13
            };

            const map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            const input = document.getElementById('pac-input');
            const types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            const infowindow = new google.maps.InfoWindow();
            const marker = new google.maps.Marker({
                position: defaultPosition,
                draggable: true,
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            // 🔁 Update lat/lng on drag
            google.maps.event.addListener(marker, 'dragend', function() {
                const lat = this.getPosition().lat();
                const lng = this.getPosition().lng();
                $('#input-latitude').val(lat);
                $('#input-longitude').val(lng);
            });

            // 📍 Autocomplete address selection
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                infowindow.close();
                marker.setVisible(false);

                const place = autocomplete.getPlace();
                if (!place.geometry) return;

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                $('#input-latitude').val(place.geometry.location.lat());
                $('#input-longitude').val(place.geometry.location.lng());
                $('input[name=address]').val(place.formatted_address);

                const address = place.address_components?.map(comp => comp.short_name).slice(0, 3).join(' ') || '';

                infowindow.setContent(`<div><strong>${place.name}</strong><br>${address}</div>`);
                infowindow.open(map, marker);
            });
        }

        // 🧠 Only init if map-canvas exists
        if ($('#map-canvas').length) {
            google.maps.event.addDomListener(window, 'load', initMap);
        }


        $(document).ready(function() {
            $('.merchant_status').select2({
                placeholder: "Choose Status",
                width: '100%'
            });

            $('.merchant_active').select2({
                placeholder: "Choose Active",
                width: '100%'
            });
        });
    </script>
@endpush
