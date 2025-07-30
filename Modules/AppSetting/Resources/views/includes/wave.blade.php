<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Wave Money Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.wave.enable')))
                    {{ html()->checkbox('wave_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('wave_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="wave_publickey">Wave Public Key</label> 
        <input type="password" value="{{ config('appsetting.payment.wave.public_key') }}" id="wave_public_key" name="wave_public_key" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="wave_privatekey">Wave Private Key</label>
        <input type="password" value="{{ config('appsetting.payment.wave.private_key') }}" id="wave_private_key" name="wave_private_key" class="form-control col-md-9">
    </div>
    {{-- <div class="form-group row form-md-line-input form-md-floating-label">
        <input type="text" value="{{ config('appsetting.payment.wave.public_key') }}" id="wave_public_key" name="wave_public_key" class="form-control col-md-9">
        <label for="wave_public_key">Wave Public Key</label> 
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <input type="text" value="{{ config('appsetting.payment.wave.private_key') }}" id="wave_private_key" name="wave_private_key" class="form-control col-md-9">
        <label for="wave_private_key">Wave Private Key</label>
    </div> --}}
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Wave Money Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.wave.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="wave_charge_type" id="wave_charge_type1">
                <label for="wave_charge_type1">
                    <span class=""></span>
                    <span class="check"></span>
                    <span class="box"></span> Percentage
                </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.wave.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="wave_charge_type" id="wave_charge_type2">
                <label for="wave_charge_type2">
                    <span class=""></span>
                    <span class="check"></span>
                    <span class="box"></span> Amount 
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="wave_charge">Wave Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.wave.charge') }}" id="wave_charge" name="wave_charge" class="form-control col-md-9">
    </div>
</div>