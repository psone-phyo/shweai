@extends ('backend.layouts.app')

@section('title', appName() . ' | ' . __('township::labels.backend.township.management'))

@section('breadcrumb-links')
    @include('township::includes.breadcrumb-links')
@endsection

@push('after-styles')
{{ style("https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css") }}
{{ style('assets/plugins/sweetalert2/sweetalert2.min.css') }}
{{ style('assets/plugins/select2/css/select2.min.css') }}
{{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('township::labels.backend.township.management') }} <small
                            class="text-muted">{{ __('township::labels.backend.township.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('township::includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="card-body row">

                <div class="form-group col-md-3">
                    <select name="region_id" id="region_id" class="form-control region_id select2"
                        title="Choose Vendor Category" data-live-search="true" data-size="10">
                        <option value="">Choose Region</option>
                        @foreach ($regions as $id => $name)
                            <option value="{{ $id }}" name="region_id">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <button type="button" id="reset" class="btn btn-danger"><i
                            class="fa fa-redo"></i>&nbsp;Reset</button>&nbsp;&nbsp;&nbsp;

                    <button type="button" id="adv_Search" class="btn btn-primary"><i
                            class="fa fa-search"></i>&nbsp;Search</button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table id="township-table" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('township::labels.backend.township.table.id') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.region') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.name') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.mm_name') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.status') }}</th>
                                    <th>@lang('merchant::labels.backend.merchant.table.latitude')</th>
                                    <th>@lang('merchant::labels.backend.merchant.table.longitude')</th>
                                    <th>{{ __('township::labels.backend.township.table.last_updated') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.created_user') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.updated_user') }}</th>
                                    <th>{{ __('township::labels.backend.township.table.actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

@push('after-scripts')
{{ script("js/backend/plugin/datatables/dataTables.min.js") }}
{{ script("js/backend/plugin/datatables/dataTables.bootstrap4.min.js") }}
{{ script("js/backend/plugin/datatables/dataTables-extend.js") }}
{{ script('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}
{{ script('assets/plugins/select2/js/select2.full.min.js')}}
{{ script("assets/plugins/select2/component/components-select2.js") }}

    <script>
        $(function() {

            $('#region_id').select2({
                placeholder: "Choose Region"
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var township_table;
            LoadVendorData();


            $('#adv_Search').click(function() {
                township_table.destroy();
                LoadVendorData();
            });

            function LoadVendorData() {

                township_table = $('#township-table').DataTable({
                    serverSide: true,
                    ajax: {
                        url: "{!! route('admin.township.get') !!}",
                        type: 'post',
                        data: function(d) {
                            d.region_id = $('#region_id option:selected').val();
                        },
                        error: function(xhr, err) {
                            if (err === 'parsererror')
                                location.reload();
                            else swal(xhr.responseJSON.message);
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'region',
                            name: 'region.name',
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'mm_name',
                            name: 'mm_name',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            sortable: false
                        },
                        {
                            data: 'latitude',
                            name: 'latitude',
                            sortable: false,
                            searchable: false,
                            visible: false,
                        },
                        {
                            data: 'longitude',
                            name: 'longitude',
                            sortable: false,
                            searchable: false,
                            visible: false,
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            sortable: false
                        },
                        {
                            data: 'created_by',
                            name: 'created_by',
                            sortable: false
                        },
                        {
                            data: 'last_updated_by',
                            name: 'last_updated_by',
                            sortable: false
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            searchable: false,
                            sortable: false
                        }
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    searchDelay: 500,
                    fnDrawCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        load_plugins();
                        $('#reset').click(function() {
                            $('#region_id').val(null).trigger("change");
                            township_table.ajax.reload();
                        });
                    }
                });
            }
        });
    </script>
@endpush
