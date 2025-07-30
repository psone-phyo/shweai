<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">OneTwoThree Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.onetwothree.enable')))
                    {{ html()->checkbox('onetwothree_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('onetwothree_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">

 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_merchantid">Merchant ID</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.MerchantID') }}" id="onetwothree_merchantid" name="onetwothree_merchantid" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_merchantpassword">Merchant Key Password</label>
        <input type="password" value="{{ config('appsetting.payment.onetwothree.Merchantpassword') }}" id="onetwothree_merchantpassword" name="onetwothree_merchantpassword" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_version">Version</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.Version') }}" id="onetwothree_version" name="onetwothree_version" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_currencycode">Currency</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.CurrencyCode') }}" id="onetwothree_currencycode" name="onetwothree_currencycode" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_countrycode">Country Code</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.CountryCode') }}" id="onetwothree_countrycode" name="onetwothree_countrycode" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_agentcode">Agent Code</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.AgentCode') }}" id="onetwothree_agentcode" name="onetwothree_agentcode" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_channelcode">Channel Code</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.ChannelCode') }}" id="onetwothree_channelcode" name="onetwothree_channelcode" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_apikey">API Key</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.ApiKey') }}" id="onetwothree_apikey" name="onetwothree_apikey" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="onetwothree_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.onetwothree.Url') }}"  id="onetwothree_url" name="onetwothree_url" class="form-control col-md-9">
 </div>
 
 <div class="form-group row form-md-radios">
    <label class="col-md-3">OneTwoThree Charge Type</label>
    <div class="md-radio-inline">
        <div class="md-radio">
        <input type="radio" {{ (config('appsetting.payment.onetwothree.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="onetwothree_charge_type" id="onetwothree_charge_type1">
            <label for="onetwothree_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
            <input type="radio" {{ (config('appsetting.payment.onetwothree.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="onetwothree_charge_type" id="onetwothree_charge_type2">
            <label for="onetwothree_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
        </div>
    </div>
</div>
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="onetwothree_charge">OneTwoThree Amount/Percentage</label>
    <input type="text" value="{{ config('appsetting.payment.onetwothree.charge') }}" id="onetwothree_charge" name="onetwothree_charge" class="form-control col-md-9">
 </div>
</div>