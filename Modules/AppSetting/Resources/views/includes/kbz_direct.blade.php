<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">KBZ Direct Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.kbz_direct.enable')))
                    {{ html()->checkbox('kbzdirectpay_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('kbzdirectpay_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_client_code">Client Code</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.client_code') }}" id="kbzdirectpay_client_code" name="kbzdirectpay_client_code" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_merchant_code">Merchant Code</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.merchant_code') }}" id="kbzdirectpay_merchant_code" name="kbzdirectpay_merchant_code" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_currency_code">Currency Code</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.currency_code') }}" id="kbzdirectpay_currency_code" name="kbzdirectpay_currency_code" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_success_flag">Success Flag(Y/N)</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.success_flag') }}" id="kbzdirectpay_success_flag" name="kbzdirectpay_success_flag" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_fail_flag">Fail Flag(Y/N)</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.fail_flag') }}" id="kbzdirectpay_fail_flag" name="kbzdirectpay_fail_flag" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.kbzdirectpay_url') }}"  id="kbzdirectpay_url" name="kbzdirectpay_url" class="form-control col-md-9">
    </div>                                                       
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_success_url">Success URL</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.success_url') }}"  disabled="disabled" id="kbzdirectpay_success_url" name="kbzdirectpay_success_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_failed_url">Failed URL</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.failed_url') }}"  disabled="disabled" id="kbzdirectpay_failed_url" name="kbzdirectpay_failed_url" class="form-control col-md-9">
    </div>
            
    <div class="form-group row form-md-radios">
            <label class="col-md-3">KBZ Direct Charge Type</label>
            <div class="md-radio-inline">
                <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.kbz_direct.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="kbzdirectpay_charge_type" id="kbzdirectpay_charge_type1">
                    <label for="kbzdirectpay_charge_type1">
                        <span class=""></span>
                        <span class="check"></span>
                        <span class="box"></span> Percentage </label>
                </div>
                <div class="md-radio">
                    <input type="radio" {{ (config('appsetting.payment.kbz_direct.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="kbzdirectpay_charge_type" id="kbzdirectpay_charge_type2">
                    <label for="kbzdirectpay_charge_type2">
                        <span class=""></span>
                        <span class="check"></span>
                        <span class="box"></span> Amount </label>
                </div>
            </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="kbzdirectpay_charge">KBZ Direct Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.kbz_direct.charge') }}" id="kbzdirectpay_charge" name="kbzdirectpay_charge" class="form-control col-md-9">
    </div>
</div>