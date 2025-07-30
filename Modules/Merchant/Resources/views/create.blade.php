@extends ('backend.layouts.app')

@section ('title', __('merchant::labels.backend.merchant.management') . ' | ' . __('merchant::labels.backend.merchant.create'))

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
                        {{ html()->label(__('merchant::labels.backend.merchant.table.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div>

                    {{-- mm_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.mm_name'))->class('col-md-2 form-control-label')->for('mm_name') }}

                        <div class="col-md-10">
                            {{ html()->text('mm_name')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.mm_name'))
                                ->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.business_name'))->class('col-md-2 form-control-label')->for('business_name') }}

                        <div class="col-md-10">
                            {{ html()->text('business_name')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.business_name'))
                                ->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- mm_business_name --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.mm_business_name'))->class('col-md-2 form-control-label')->for('mm_business_name') }}

                        <div class="col-md-10">
                            {{ html()->text('mm_business_name')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.mm_business_name'))
                                ->attribute('maxlength', 191) }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.phone'))->class('col-md-2 form-control-label')->for('phone') }}

                        <div class="col-md-10">
                            {{ html()->text('phone')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.phone'))
                                ->attribute('maxlength', 20)
                                ->required() }}
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->textarea('address')
                                ->class('form-control')
                                ->placeholder(__('merchant::labels.backend.merchant.table.address')) }}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group row">
                        {{ html()->label(__('merchant::labels.backend.merchant.table.status'))->class('col-md-2 form-control-label')->for('status') }}

                        <div class="col-md-10">
                            {{  html()->select('staus', $merchantStatus::AVAILABLES_CREATE)
                                    ->class("form-control select2 merchant_status")
                                    ->required()
                                    }}

                        </div>
                    </div>

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
{{ script('assets/plugins/select2/js/select2.full.min.js')}}
{{ script("assets/plugins/select2/component/components-select2.js") }}

<script>
$(document).ready(function(){
    $('.merchant_status').select2({
        placeholder: "Choose Status",
        width: '100%'
    });
});

</script>
@endpush