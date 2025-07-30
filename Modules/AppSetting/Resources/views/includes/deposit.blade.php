<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">{{ __('appsetting::labels.backend.appsetting.account_payment') }}</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.bnfcredit.enable')))
                    {{ html()->checkbox('credit_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('credit_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-radios">

        <label class="col-md-3">{{ __('appsetting::labels.backend.appsetting.account_charge_type') }}</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.bnfcredit.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="credit_charge_type" id="credit_charge_type1">
                <label for="credit_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span>{{ __('appsetting::labels.backend.appsetting.percentage') }}</label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.bnfcredit.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="credit_charge_type" id="credit_charge_type2">
                <label for="credit_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span>{{ __('appsetting::labels.backend.appsetting.amount') }}</label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="credit_charge">{{ __('appsetting::labels.backend.appsetting.amount_and_percentage') }}</label>
        <input type="text" value="{{ config('appsetting.payment.bnfcredit.charge') }}" id="credit_charge" name="credit_charge" class="form-control col-md-9">
     </div>
</div>
