<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Paylater</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.paylater.enable')))
                    {{ html()->checkbox('paylater_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('paylater_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paylater_expiry">Paylater Expiry</label>
        <input type="text" value="{{ config('appsetting.payment.paylater.paylater_expiry') }}" id="paylater_expiry" name="paylater_expiry" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Paylater Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.paylater.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="paylater_charge_type" id="paylater_charge_type1">
                <label for="paylater_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.paylater.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="paylater_charge_type" id="paylater_charge_type2">
                <label for="paylater_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="paylater_charge">Paylater Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.paylater.charge') }}" id="paylater_charge" name="paylater_charge" class="form-control col-md-9">
     </div>
</div>
