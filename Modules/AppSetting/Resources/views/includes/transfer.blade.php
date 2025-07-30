 <div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">Bank Transfer Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.transfer.enable')))
                    {{ html()->checkbox('transfer_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('transfer_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_1">Bank Transfer 1</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_1') }}" id="transfer_1" name="transfer_1" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_2">Bank Transfer 2</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_2') }}" id="transfer_2" name="transfer_2" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_3">Bank Transfer 3</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_3') }}" id="transfer_3" name="transfer_3" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_4">Bank Transfer 4</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_4') }}" id="transfer_4" name="transfer_4" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_5">Bank Transfer 5</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_5') }}" id="transfer_5" name="transfer_5" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_6">Bank Transfer 6</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_6') }}" id="transfer_6" name="transfer_6" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_7">Bank Transfer 7</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_7') }}" id="transfer_7" name="transfer_7" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_8">Bank Transfer 8</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_8') }}" id="transfer_8" name="transfer_8" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_9">Bank Transfer 9</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_9') }}" id="transfer_9" name="transfer_9" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_10">Bank Transfer 10</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.transfer_10') }}" id="transfer_10" name="transfer_10" class="form-control col-md-9">
 </div>
 <div class="form-group row form-md-radios">
    <label class="col-md-3">Transfer Charge Type</label>
    <div class="md-radio-inline">
        <div class="md-radio">
        <input type="radio" {{ (config('appsetting.payment.transfer.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="transfer_charge_type" id="transfer_charge_type1">
            <label for="transfer_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
        </div>
        <div class="md-radio">
            <input type="radio" {{ (config('appsetting.payment.transfer.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="transfer_charge_type" id="transfer_charge_type2">
            <label for="transfer_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
        </div>
    </div>
</div>
<div class="form-group row form-md-line-input form-md-floating-label">
    <label class="col-md-3" for="transfer_charge">Transfer Charge Amount/Percentage</label>
    <input type="text" value="{{ config('appsetting.payment.transfer.charge') }}" id="transfer_charge" name="transfer_charge" class="form-control col-md-9">
 </div>
</div>