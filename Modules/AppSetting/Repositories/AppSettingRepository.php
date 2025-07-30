<?php

namespace Modules\AppSetting\Repositories;

use App\Repositories\BaseRepository;
use Artisan;

/**
 * Class AppSettingRepository.
 */
class AppSettingRepository extends BaseRepository
{
    public function update($request) : bool
    {
        $tab = $request->tab;
        $filename = $request->filename;
        $data = $request->except('_token', '_method', 'tab','filename');

        if ($tab == 'basic') {
            $mainLogoUrl =  config('appsetting.basic.main_logo');
            if ($request->hasFile('main_logo')) {
                $file = $request->file('main_logo');
                $logoName = 'main_logo.'.$file->extension();
                $file->move(public_path('app_data/'), $logoName);
                $data['main_logo'] =  url('app_data/'.$logoName);
            }

            $logoUrl =  config('appsetting.basic.favicon');
            if ($request->hasFile('app_favicon')) {
                $file = $request->file('app_favicon');
                $faviconName = 'logo.'.$file->extension();
                $file->move(public_path('app_data/'), $faviconName);
                $data['app_favicon'] =  url('app_data/'.$faviconName);
            }

            $defaults = [
              config('appsetting.basic.appstore'), config('appsetting.basic.playstore'),
              config('appsetting.basic.youtubedemo'), config('appsetting.basic.name'),
              config('appsetting.basic.facebook'), config('appsetting.basic.email'),
              config('appsetting.basic.ticket_email'),config('appsetting.basic.phone'),
              config('appsetting.basic.viber_phone'),config('appsetting.basic.address'),
              config('appsetting.basic.app_dollar_rate'),config('appsetting.basic.app_reference_no'),
              config('appsetting.basic.map_key'),config('appsetting.basic.meta_keywords'),
              config('appsetting.basic.meta_description'),
              config('appsetting.basic.domain_url'),
              $mainLogoUrl,$logoUrl,
            ];
        } elseif ($tab == 'payment') {
            $defaults = [
                            config('appsetting.payment.paylater.paylater_expiry'),
                            config('appsetting.payment.paylater.charge_type'), config('appsetting.payment.paylater.charge'),

                            config('appsetting.payment.transfer.transfer_1'),
                            config('appsetting.payment.transfer.transfer_2'), config('appsetting.payment.transfer.transfer_3'),
                            config('appsetting.payment.transfer.transfer_4'), config('appsetting.payment.transfer.transfer_5'),
                            config('appsetting.payment.transfer.transfer_6'), config('appsetting.payment.transfer.transfer_7'),
                            config('appsetting.payment.transfer.transfer_8'), config('appsetting.payment.transfer.transfer_9'),
                            config('appsetting.payment.transfer.transfer_10'), config('appsetting.payment.transfer.charge_type'),
                            config('appsetting.payment.transfer.charge'),

                            config('appsetting.payment.bnfcredit.charge_type'), config('appsetting.payment.bnfcredit.charge'),

                            config('appsetting.payment.uab.merchant_id'), config('appsetting.payment.uab.merchant_access_key'),
                            config('appsetting.payment.uab.merchant_channel'), config('appsetting.payment.uab.secret_key'),
                            config('appsetting.payment.uab.ins_id'),config('appsetting.payment.uab.client_secret'),
                            config('appsetting.payment.uab.payment_method'), config('appsetting.payment.uab.payment_url'),
                            config('appsetting.payment.uab.payment_expire_in_second'),
                            config('appsetting.payment.uab.charge_type'), config('appsetting.payment.uab.charge'),
                        ];

            $paylaterEnable = (isset($data['paylater_enable']))?"true":"false";
            unset($data['paylater_enable']);
            $data['paylater_enable'] =  $paylaterEnable;
            $defaults[] = config('appsetting.payment.paylater.enable')?"true":"false";

            $transferEnable = (isset($data['transfer_enable']))?"true":"false";
            unset($data['transfer_enable']);
            $data['transfer_enable'] =  $transferEnable;
            $defaults[] = config('appsetting.payment.transfer.enable')?"true":"false";

            $depositEnable = (isset($data['credit_enable']))?"true":"false";
            unset($data['credit_enable']);
            $data['credit_enable'] =  $depositEnable;
            $defaults[] = config('appsetting.payment.bnfcredit.enable')?"true":"false";

            $uabEnable = (isset($data['uab_enable']))?"true":"false";
            unset($data['uab_enable']);
            $data['uab_enable'] =  $uabEnable;
            $defaults[] = config('appsetting.payment.uab.enable')?"true":"false";

        } elseif ($tab == 'email_sms') {
            $defaults = [
                config('appsetting.email.mail_driver'), config('appsetting.email.mail_host'),
                config('appsetting.email.mail_port'), config('appsetting.email.mail_username'),
                config('appsetting.email.mail_password'), config('appsetting.email.mail_encryption'),

                config('appsetting.sms.smspoh_url'),config('appsetting.sms.smspoh_secret'),
                config('appsetting.sms.smspoh_api_key'),config('appsetting.sms.smspoh_senderId'),
                config('appsetting.sms.smspoh_max_attempt'),config('appsetting.sms.smspoh_pin_length'),
                config('appsetting.sms.smspoh_duration'), config('appsetting.sms.smspoh_resend_cooldown'),
            ];
        }


        $content = file_get_contents(base_path() . '/.'.$filename);
        // replace default values with new ones
        $i = 0;

        // print('<pre>');
        // print_r($defaults);
        // print('<hr>');
        foreach ($data as $key => $value) {
            $content = str_replace(strtoupper($key).'="'.$defaults[$i].'"', strtoupper($key).'="'.$value.'"', $content);
            if(strpos($content,strtoupper($key).'="'.$value.'"')  === false) {
                return false;
            }
            $i++;
        }

        // Update .env file
        $path = base_path('.'.$filename);
        // $path = "/Applications/XAMPP/htdocs/bnfbus-v2/.env";
        if (file_exists($path)) {
            file_put_contents($path, $content);
        }

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return true;
    }
}
