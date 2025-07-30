<div class="card-header">
	<div class="form-group row form-md-line-input">
        <label class="col-md-3 form-control-label">SMSPoh</label>
	</div>
</div>

<div class="card-body">
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_url">API URL</label>
            <input type="text" value="{{ config('appsetting.sms.smspoh_url') }}" id="smspoh_url" name="smspoh_api_url" class="form-control col-md-9">
        </div>
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_secret">Secret Key</label>
            <input type="text" value="{{ config('appsetting.sms.smspoh_secret') }}" id="smspoh_secret" name="smspoh_api_secret" class="form-control col-md-9">
        </div>

        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_api_key">API Key</label>
            <input type="text" value="{{ config('appsetting.sms.smspoh_api_key') }}" id="smspoh_api_key" name="smspoh_api_key" class="form-control col-md-9">
        </div>

        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_senderId">Sender ID</label>
            <input type="text" value="{{ config('appsetting.sms.smspoh_senderId') }}" id="smspoh_senderId" name="smspoh_sender_id" class="form-control col-md-9">
        </div>
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_max_attempt">Max Attempt</label>
            <input type="number" min="1" value="{{ config('appsetting.sms.smspoh_max_attempt') }}" id="smspoh_max_attempt" name="smspoh_max_attempt" class="form-control col-md-9">
        </div>
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_api_from">Pin Length</label>
            <input type="number" min="4" max="8" value="{{ config('appsetting.sms.smspoh_pin_length') }}" id="smspoh_pin_length" name="smspoh_pin_length" class="form-control col-md-9">
        </div>
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_duration">Duration (sec)</label>
            <input type="number" min="60" max="3600" value="{{ config('appsetting.sms.smspoh_duration') }}" id="smspoh_duration" name="smspoh_duration" class="form-control col-md-9">
        </div>
        <div class="form-group row form-md-line-input form-md-floating-label">
            <label class="col-md-3" for="smspoh_resend_cooldown">Resend Cooldown (sec)</label>
            <input type="number" min="30" value="{{ config('appsetting.sms.smspoh_resend_cooldown') }}" id="smspoh_resend_cooldown" name="smspoh_resend_cooldown" class="form-control col-md-9">
        </div>
</div>