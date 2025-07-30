<div class="card-header">
    <div class="row form-md-line-input">
        <label class="col-md-3 form-control-label">MAB Payment</label>
        <div class="col-md-9">
            <label class="switch switch-label switch-pill switch-primary">
                @if((config('appsetting.payment.mab.enable')))
                    {{ html()->checkbox('mab_enable', true)->class('switch-input') }}
                @else
                    {{ html()->checkbox('mab_enable', false)->class('switch-input') }}
                @endif
                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
            </label>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_merchantid">Merchant Id</label>
        <input type="text" value="{{ config('appsetting.payment.mab.mab_merchantid') }}" id="mab_merchantid" name="mab_merchantid" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_sharekey">Shared Key</label>
        <input type="text" value="{{ config('appsetting.payment.mab.mab_sharekey') }}" id="mab_sharekey" name="mab_sharekey" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_name">Merchant Name</label>
        <input type="text" value="{{ config('appsetting.payment.mab.mab_name') }}" id="mab_name" name="mab_name" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_url">Payment URL</label>
        <input type="text" value="{{ config('appsetting.payment.mab.mab_url') }}" id="mab_url" name="mab_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_frontend_url">Frontend URL</label>
        <input type="text" value="{{ config('appsetting.payment.mab.mab_frontend_url') }}" id="mab_frontend_url" name="mab_frontend_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="act_url">Act URL</label>
        <input type="text" value="{{ config('appsetting.payment.mab.act_url') }}" id="act_url" name="act_url" class="form-control col-md-9">
    </div>
    <div class="form-group row form-md-radios">
        <label class="col-md-3">Mab Charge Type</label>
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.mab.charge_type') == 'percentage')?'checked="checked"':'' }} value="percentage" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type1">
                <label for="mab_charge_type1">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Percentage </label>
            </div>
            <div class="md-radio">
                <input type="radio" {{ (config('appsetting.payment.mab.charge_type') == 'amount')?'checked="checked"':'' }} value="amount" class="md-radiobtn" name="mab_charge_type" id="mab_charge_type2">
                <label for="mab_charge_type2">
                <span class=""></span>
                <span class="check"></span>
                <span class="box"></span> Amount </label>
            </div>
        </div>
    </div>
    <div class="form-group row form-md-line-input form-md-floating-label">
        <label class="col-md-3" for="mab_charge">MAB Charge Amount/Percentage</label>
        <input type="text" value="{{ config('appsetting.payment.mab.charge') }}" id="mab_charge" name="mab_charge" class="form-control col-md-9">
     </div>
</div>
