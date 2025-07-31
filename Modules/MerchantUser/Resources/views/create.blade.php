@extends ('backend.layouts.app')

@section('title', __('merchantuser::labels.backend.merchantuser.management') . ' | ' .
    __('merchantuser::labels.backend.merchantuser.create'))

@section('breadcrumb-links')
    @include('merchantuser::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{ style('assets/plugins/select2/css/select2-bootstrap.min.css') }}
@endpush

@section('content')
    {{ html()->form('POST', route('admin.merchantuser.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('merchantuser::labels.backend.merchantuser.management') }}
                        <small class="text-muted">{{ __('merchantuser::labels.backend.merchantuser.create') }}</small>
                    </h4>
                </div>
            </div>

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- Merchant --}}
                    <div class="form-group row">
                        {{ html()->label(__("merchantuser::labels.backend.merchantuser.table.merchant"))->class('col-md-2 form-control-label')->for('merchant_id') }}
                        <div class="col-md-10">
                            <select name="merchant_id" class="form-control select2" required>
                                <option value="">-- Select Merchant --</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}"
                                        {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                        {{ $merchant->business_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    @include('merchantuser::includes.merchant_user_form')

                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.merchantuser.index'), __('buttons.general.cancel')) }}
                </div>
                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div>
            </div>
        </div>
    </div>
    {{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    {{ script('assets/plugins/select2/component/components-select2.js') }}

    <script>
        $('.select2').select2({
            theme: 'bootstrap'
        });
    </script>
@endpush
