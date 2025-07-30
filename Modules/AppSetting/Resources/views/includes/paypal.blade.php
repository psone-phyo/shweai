<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Paypal Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.paypal.enable')))
                    {{ html()->checkbox('paypal_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('paypal_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paypal_env">Paypal ENV</label>
        <input type="text" value="{{ config('appsetting.payment.paypal.env') }}" id="paypal_env" name="paypal_env" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paypal_client_id">Paypal Client ID</label>
        <input type="text" value="{{ config('appsetting.payment.paypal.client_id') }}" id="paypal_client_id" name="paypal_client_id" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paypal_secret">Paypal Secret Key</label>
        <input type="text" value="{{ config('appsetting.payment.paypal.secret') }}" id="paypal_secret" name="paypal_secret" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Paypal Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.paypal.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type1">
                <label for="paypal_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.paypal.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="paypal_charge_type" id="paypal_charge_type2">
                <label for="paypal_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paypal_charge">Paypal Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.paypal.charge') }}" id="paypal_charge" name="paypal_charge" class="form-control col-md-9">
     </div>
</div>
