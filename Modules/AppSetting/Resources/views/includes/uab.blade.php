<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">UAB Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.uab.enable')))
                    {{ html()->checkbox('uab_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('uab_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_merchant_id">Merchant ID</label>
        <input type="text" value="{{ config('appsetting.payment.uab.merchant_id') }}" id="uab_merchant_id" name="uab_merchant_id" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_merchant_id">Merchant Access Key</label>
        <input type="text" value="{{ config('appsetting.payment.uab.merchant_access_key') }}" id="uab_access_key" name="uab_merchant_access_key" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_merchant_id">Merchant Channel</label>
        <input type="text" value="{{ config('appsetting.payment.uab.merchant_channel') }}" id="uab_merchant_channel" name="uab_merchant_channel" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_secret_key">Secret Key</label>
        <input type="password" value="{{ config('appsetting.payment.uab.secret_key') }}" id="uab_secret_key" name="uab_secret_key" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_ins_id">Ins ID</label>
        <input type="text" value="{{ config('appsetting.payment.uab.ins_id') }}" id="uab_ins_id" name="uab_ins_id" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_client_secret">Client Secret</label>
        <input type="password" value="{{ config('appsetting.payment.uab.client_secret') }}" id="uab_client_secret" name="uab_client_secret" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_payment_method">Payment Method</label>
        <input type="text" value="{{ config('appsetting.payment.uab.payment_method') }}" id="uab_payment_method" name="uab_payment_method" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_payment_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.uab.payment_url') }}"  id="uab_payment_url" name="uab_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_backend_url">Backend URL</label>
        <input type="text" value="{{ config('appsetting.payment.uab.backend_url') }}"  disabled="disabled" id="uab_backend_url" name="uab_backend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_frontend_url">Frontend Success URL</label>
        <input type="text" value="{{ config('appsetting.payment.uab.frontend_success_url') }}" disabled="disabled"  id="uab_frontend_success_url" name="uab_frontend_success_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_frontend_url">Frontend Failed URL</label>
        <input type="text" value="{{ config('appsetting.payment.uab.frontend_failed_url') }}" disabled="disabled"  id="uab_frontend_failed_url" name="uab_frontend_failed_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_payment_expire_in_second">Payment Expired In Second</label>
        <input type="number" value="{{ config('appsetting.payment.uab.payment_expire_in_second') }}" id="uab_payment_expire_in_second" name="uab_payment_expire_in_second" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">UAB Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.uab.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="uab_charge_type" id="uab_charge_type1">
                <label for="uab_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.uab.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="uab_charge_type" id="uab_charge_type2">
                <label for="uab_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="uab_charge">UAB Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.uab.charge') }}" id="uab_charge" name="uab_charge" class="form-control col-md-9">
    </div>
</div>