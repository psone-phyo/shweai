@extends ('backend.layouts.app')

@section ('title', appName() . ' | ' . __('merchantuser::labels.backend.merchantuser.management'))

@section('breadcrumb-links')
    @include('merchantuser::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style("https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css") }}
    {{ style('assets/plugins/sweetalert2/sweetalert2.min.css') }}
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('merchantuser::labels.backend.merchantuser.management') }} <small class="text-muted">{{ __('merchantuser::labels.backend.merchantuser.list') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('merchantuser::includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="merchantuser-table" class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.id') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.merchant') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.name') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.email') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.mobile') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.nrc') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.created_by') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.active') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.last_updated') }}</th>
                            <th>{{ __('merchantuser::labels.backend.merchantuser.table.actions') }}</th>
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
    <!-- {{ script("js/backend/plugin/datatables/dataTables-extend.js") }} -->
    {{ script('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#merchantuser-table').DataTable({
                serverSide: true,
                ajax: {
                    url: '{!! route("admin.merchantuser.get") !!}',
                    type: 'post',
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                        else swal(xhr.responseJSON.message);
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'merchant.bussiness_name', name: 'merchant.bussiness_name'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'user.email', name: 'user.email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'nrc', name: 'nrc'},
                    {data: 'created_user.name', name: 'created_user.name'},
                    {data: 'active', name: 'active'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                fnDrawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    load_plugins();
                }
            });
        });
    </script>
@endpush