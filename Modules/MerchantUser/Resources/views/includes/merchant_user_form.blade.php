{{-- Name --}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.name'))->class('col-md-2 form-control-label')->for('name') }}

    <div class="col-md-10">
        {{ html()->text('name', old('name', $merchantUser->user->name ?? ''))->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.name'))->required() }}
    </div>
</div>

{{-- Email --}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.email'))->class('col-md-2 form-control-label')->for('email') }}

    <div class="col-md-10">
        {{ html()->email('email', old('email', $merchantUser->user->email ?? ''))->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.email'))->required() }}
    </div>
</div>

{{-- Mobile --}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.mobile'))->class('col-md-2 form-control-label')->for('mobile') }}

    <div class="col-md-10">
        {{ html()->text('mobile', old('mobile', $merchantUser->user->mobile ?? ''))->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.mobile'))->required() }}
    </div>
</div>

    {{-- NRC --}}
    <div class="form-group row">
        {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.nrc'))->class('col-md-2 form-control-label')->for('nrc') }}

        <div class="col-md-10">
            {{ html()->text('nrc', $merchantUser->nrc ?? '')->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.nrc'))->required() }}
        </div>
    </div>

@if (!isset($merchantUser))
{{-- User password--}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.password'))->class('col-md-2 form-control-label')->for('password') }}

    <div class="col-md-10">
        {{ html()->text('password')->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.password'))->required() }}
    </div>
</div>

{{-- User password--}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

    <div class="col-md-10">
        {{ html()->text('password_confirmation')->class('form-control')->placeholder(__('merchantuser::labels.backend.merchantuser.table.password_confirmation'))->required() }}
    </div>
</div>

{{-- Active --}}
<div class="form-group row">
    {{ html()->label(__('merchantuser::labels.backend.merchantuser.table.active'))->class('col-md-2 form-control-label')->for('active') }}

    <div class="col-md-10">
        {{ html()->select('active', [1 => 'Active', 0 => 'Inactive'])->class('form-control select2 merchantuser_active')->required() }}
    </div>
</div>
@endif