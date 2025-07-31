@extends ('backend.layouts.app')

@section ('title', appName() . ' | ' . __('merchant::labels.backend.merchant.management'))

@section('breadcrumb-links')
    @include('merchant::includes.breadcrumb-links')
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
                    @if ($type == 'rejected')
                        {{ __('merchant::labels.backend.merchant.rejected_management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.rejected_list') }}</small>
                    @elseif ($type == 'suspended')
                        {{ __('merchant::labels.backend.merchant.suspended_management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.suspended_list') }}</small>
                    @elseif ($type == 'pending')
                        {{ __('merchant::labels.backend.merchant.inactive_management') }}  {{-- or pending_management if you have --}}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.inactive_list') }}</small>
                    @elseif ($type == 'approved')
                        {{ __('merchant::labels.backend.merchant.management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.list') }}</small>
                    @else
                        {{ __('merchant::labels.backend.merchant.management') }}
                        <small class="text-muted">{{ __('merchant::labels.backend.merchant.list') }}</small>
                    @endif
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('merchant::includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col-md-3">
                <select name="active" id="active" class="form-control select2 changeSearch">
                    <option value="1">{{ __('merchant::labels.backend.merchant.table.active') }}</option>
                    <option value="0">{{ __('merchant::labels.backend.merchant.table.inactive') }}</option>
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="merchant-table" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('merchant::labels.backend.merchant.table.id') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.name') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.business_name') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.email') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.phone') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.registration_number') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.approximate_sale') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.website_url') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.status') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.active') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.created_by') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.last_updated_by') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.approved_at') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.last_updated') }}</th>
                                <th>{{ __('merchant::labels.backend.merchant.table.actions') }}</th>
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
    {{ script('assets/plugins/select2/js/select2.full.min.js')}}
    {{ script("assets/plugins/select2/component/components-select2.js") }}

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#merchant-table').DataTable({
                serverSide: true,
                ajax: {
                    url: '{!! route("admin.merchant.get") !!}',
                    type: 'post',
                    data: function (d) {
                        d.type = '{{ $type }}';
                        d.active = $('#active').val();
                    },
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                        else swal(xhr.responseJSON.message);
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'business_name', name: 'business_name'},
                    {data: 'business_email', name: 'business_email'},
                    {data: 'business_mobile', name: 'business_mobile'},
                    {data: 'registration_number', name: 'registration_number'},
                    {data: 'approximate_sale', name: 'approximate_sale'},
                    {data: 'website_url', name: 'website_url'},
                    {data: 'status', name: 'status'},
                    {data: 'active', name: 'active'},
                    {data: 'created_user.name', name: 'created_user.name', searchable: false},
                    {data: 'updated_user.name', name: 'updated_user.name', searchable: false},
                    {data: 'approved_at', name: 'approved_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                fnDrawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    load_plugins();
                }
            });

            $('.changeSearch').on('change', function() {
                $('#merchant-table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush