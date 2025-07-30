<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">True Money Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.truemoney.enable')))
                    {{ html()->checkbox('true_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('true_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="true_hash_key">Hash Secret Key</label>
    <input type="password" value="{{ config('appsetting.payment.truemoney.hash_key') }}" id="true_hash_key" name="true_hash_key" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="true_merchant_id">Merchant ID</label>
    <input type="text" value="{{ config('appsetting.payment.truemoney.merchant_id') }}" id="true_merchant_id" name="true_merchant_id" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="true_url">Payment URL</label>
    <input type="text" value="{{ config('appsetting.payment.truemoney.true_url') }}"  id="true_url" name="true_url" class="form-control col-md-9">
 </div>                                                       
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="true_backend_url">Backend URL</label>
    <input type="text" value="{{ config('appsetting.payment.truemoney.backend_url') }}"  disabled="disabled" id="true_backend_url" name="true_backend_url" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-radios">
    <label class="col-md-3">True Money Charge Type</label>
    <div class="md-radio-inline">
        <div class="md-radio">
        <input type="radio" {{ (config('appsetting.payment.truemoney.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="true_charge_type" id="true_charge_type1">
            <label for="true_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
            <input type="radio" {{ (config('appsetting.payment.truemoney.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="true_charge_type" id="true_charge_type2">
            <label for="true_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
        </div>
    </div>
</div>
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="true_charge">True Money Amount/Percentage</label>
    <input type="text" value="{{ config('appsetting.payment.truemoney.charge') }}" id="true_charge" name="true_charge" class="form-control col-md-9">
 </div>
</div>