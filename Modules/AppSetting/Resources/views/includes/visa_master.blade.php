<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Visa/Master Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.visa_master.enable')))
                    {{ html()->checkbox('visa_master_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('visa_master_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_version">Version</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.version') }}" id="visa_master_version" name="visa_master_version" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_currency">Currency</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.currency') }}" id="visa_master_currency" name="visa_master_currency" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_hash_key">Hash Secret Key</label>
        <input type="password" value="{{ config('appsetting.payment.visa_master.hash_key') }}" id="visa_master_hash_key" name="visa_master_hash_key" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_merchant_id">Merchant ID</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.merchant_id') }}" id="visa_master_merchant_id" name="visa_master_merchant_id" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_payment_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.payment_url') }}"  id="visa_master_payment_url" name="visa_master_payment_url" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_frontend_url">Frontend URL</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.frontend_url') }}" disabled="disabled"  id="visa_master_frontend_url" name="visa_master_frontend_url" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_backend_url">Backend URL</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.backend_url') }}"  disabled="disabled" id="visa_master_backend_url" name="visa_master_backend_url" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-radios">
            <label class="col-md-3">Visa/Master Charge Type</label>
            <div class="md-radio-inline">
                <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.visa_master.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="visa_master_charge_type" id="visa_master_charge_type1">
                    <label for="visa_master_charge_type1">
                        <span class=""></span>
                        <span class="check"></span>
                        <span class="box"></span> Percentage </label>
                </div>
                <div class="md-radio">
                    <input type="radio" {{ (config('appsetting.payment.visa_master.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="visa_master_charge_type" id="visa_master_charge_type2">
                    <label for="visa_master_charge_type2">
                        <span class=""></span>
                        <span class="check"></span>
                        <span class="box"></span> Amount </label>
                </div>
            </div>
</div>
<div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="visa_master_charge">Visa/Master Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.visa_master.charge') }}" id="visa_master_charge" name="visa_master_charge" class="form-control col-md-9">
 </div>
</div>