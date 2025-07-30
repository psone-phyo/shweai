<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">CB Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.cb.enable')))
                    {{ html()->checkbox('cbpay_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('cbpay_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_merchant_key">Merchant Key</label>
            <input type="text" value="{{ config('appsetting.payment.cb.merchant_key') }}" id="cbpay_merchant_key" name="cbpay_merchant_key" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_merchant_id">Merchant ID</label>
            <input type="text" value="{{ config('appsetting.payment.cb.merchant_id') }}" id="cbpay_merchant_id" name="cbpay_merchant_id" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_common_key">Common Key</label>
            <input type="password" value="{{ config('appsetting.payment.cb.common_key') }}"  id="cbpay_common_key" name="cbpay_common_key" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_currency">Currency</label>
            <input type="text" value="{{ config('appsetting.payment.cb.currency') }}" id="cbpay_currency" name="cbpay_currency" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_payment_url">Payment URL</label>
            <input type="text" value="{{ config('appsetting.payment.cb.payment_url') }}"  disabled="disabled" id="cbpay_payment_url" name="cbpay_payment_url" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_encrypt_salt">Encryption Salt Key</label>
            <input type="text" value="{{ config('appsetting.payment.cb.encrypt_salt') }}"  disabled="disabled" id="cbpay_encrypt_salt" name="cbpay_encrypt_salt" class="form-control col-md-9">
     </div>
     <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_encrypt_vector">Ecnryption Vector Key</label>
            <input type="text" value="{{ config('appsetting.payment.cb.encrypt_vector') }}"  disabled="disabled" id="cbpay_encrypt_vector" name="cbpay_encrypt_vector" class="form-control col-md-9">
     </div>
        
     <div class="form-group row form-md-radios">
        <label class="col-md-3">CB Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.cb.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="cbpay_charge_type" id="cbpay_charge_type1">
                <label for="cbpay_charge_type1">
                    <span class=""></span>
                    <span class="check"></span>
                    <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.cb.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="cbpay_charge_type" id="cbpay_charge_type2">
                <label for="cbpay_charge_type2">
                    <span class=""></span>
                    <span class="check"></span>
                    <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="cbpay_charge">CB Amount/Percentage</label>
            <input type="text" value="{{ config('appsetting.payment.cb.charge') }}" id="cbpay_charge" name="cbpay_charge" class="form-control col-md-9">
    </div>
</div>