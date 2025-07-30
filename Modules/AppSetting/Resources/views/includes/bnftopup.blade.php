<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">BNF Topup</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.topup.enable')))
                    {{ html()->checkbox('topup_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('topup_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="version">App Version</label>
        <input type="text" value="{{ config('appsetting.payment.topup.version') }}" id="version" name="version" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="app_id">App Id</label>
        <input type="text" value="{{ config('appsetting.payment.topup.appid') }}" id="app_id" name="app_id" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="secret_key">App Secret Key</label>
        <input type="text" value="{{ config('appsetting.payment.topup.secretkey') }}" id="secret_key" name="secret_key" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="topup_url">Payment Url</label>
        <input type="text" value="{{ config('appsetting.payment.topup.topup_url') }}" id="topup_url" name="topup_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Topup Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.topup.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="topup_charge_type" id="topup_charge_type1">
                <label for="topup_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.topup.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="topup_charge_type" id="topup_charge_type2">
                <label for="topup_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="topup_charge">Topup Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.topup.charge') }}" id="topup_charge" name="topup_charge" class="form-control col-md-9">
    </div>

</div>
