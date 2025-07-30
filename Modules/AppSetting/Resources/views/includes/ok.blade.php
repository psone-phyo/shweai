<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">OK Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.ok.enable')))
                    {{ html()->checkbox('ok_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('ok_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_apikey">Ok Api Key</label>
        <input type="text" value="{{ config('appsetting.payment.ok.apikey') }}" id="ok_apikey" name="ok_apikey" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_destination">Merchant Destination</label>
        <input type="text" value="{{ config('appsetting.payment.ok.destination') }}" id="ok_destination" name="ok_destination" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_merchant_name">Merchant Name</label>
        <input type="text" value="{{ config('appsetting.payment.ok.merchant_name') }}" id="ok_merchant_name" name="ok_merchant_name" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_payment_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.ok.payment_url') }}" id="ok_payment_url" name="ok_payment_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_frontend_url">Frontend URL</label>
        <input type="text" value="{{ config('appsetting.payment.ok.frontend_url') }}" id="ok_frontend_url" name="ok_frontend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Ok Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.ok.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="ok_charge_type" id="ok_charge_type1">
                <label for="ok_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.ok.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="ok_charge_type" id="ok_charge_type2">
                <label for="ok_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="ok_charge">Ok Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.ok.charge') }}" id="ok_charge" name="ok_charge" class="form-control col-md-9">
     </div>
</div>
