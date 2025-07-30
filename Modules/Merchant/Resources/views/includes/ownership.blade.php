{{-- User Name--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.name'))->class('col-md-2 form-control-label')->for('name') }}

    <div class="col-md-10">
        {{ html()->text('name')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.name'))->required() }}
    </div>
</div>

{{-- User nrc--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.email'))->class('col-md-2 form-control-label')->for('email') }}

    <div class="col-md-10">
        {{ html()->text('email')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.email'))->required() }}
    </div>
</div>

{{-- User Mobile--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.mobile'))->class('col-md-2 form-control-label')->for('mobile') }}

    <div class="col-md-10">
        {{ html()->text('mobile')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.mobile'))->required() }}
    </div>
</div>

{{-- User NRC--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.nrc'))->class('col-md-2 form-control-label')->for('nrc') }}

    <div class="col-md-10">
        {{ html()->text('nrc')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.nrc'))->required() }}
    </div>
</div>

{{-- User NRC--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.password'))->class('col-md-2 form-control-label')->for('password') }}

    <div class="col-md-10">
        {{ html()->text('password')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.password'))->required() }}
    </div>
</div>

{{-- User NRC--}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

    <div class="col-md-10">
        {{ html()->text('password_confirmation')->class('form-control')->placeholder(__('merchant::labels.backend.merchant.table.password_confirmation'))->required() }}
    </div>
</div>

{{-- Active --}}
<div class="form-group row">
    {{ html()->label(__('merchant::labels.backend.merchant.table.active'))->class('col-md-2 form-control-label')->for('active') }}

    <div class="col-md-10">
        {{ html()->select('active', [1 => 'Active', 0 => 'Inactive'])->class('form-control select2 merchant_active')->required() }}
    </div>
</div>
