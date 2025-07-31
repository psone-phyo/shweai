<?php

namespace Modules\Merchant\Entities;

use App\Enums\Table;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Merchant\Enums\MerchantStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = Table::MERCHANTS;

    protected $fillable = [
        'company_name',
        'mm_company_name',
        'business_name',
        'mm_business_name',
        'business_email',
        'business_mobile',
        'registration_number',
        'website_url',
        'approximate_sale',
        'address',
        'status',
        'active',
        'latitude',
        'longitude',
        'created_by',
        'last_updated_by',
        'approved_at',
    ];

    public function createdUser(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            MerchantStatus::ID_PENDING  => '<span class="badge badge-warning">Pending</span>',
            MerchantStatus::ID_APPROVED => '<span class="badge badge-success">Approved</span>',
            MerchantStatus::ID_REJECTED => '<span class="badge badge-danger">Rejected</span>',
            MerchantStatus::ID_SUSPENDED => '<span class="badge badge-secondary">Suspended</span>',
        ];
    return $statuses[$this->status] ?? 'Unknown';
    }
       /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(auth()->user()->can('admin.access.merchant.view')){
            return '<a href="'.route('admin.merchant.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info btn-sm"><i class="fas fa-search"></i>&nbsp;View</a>';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(auth()->user()->can('admin.access.merchant.edit')){
            return '<a href="'.route('admin.merchant.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>&nbsp;Edit</a>';
        }
        return '';
    }

     /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('admin.access.merchant.delete')) {
            return '<a href="'.route('admin.merchant.destroy', $this).'" data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'" class="btn btn-danger btn-sm"><i class="fas fa-trash" style="color: #fff;"></i>&nbsp;<span style="color: #fff;">Delete</span></a> ';
        }

        return '';
    }

    public function getSuspendButtonAttribute(){
        if (auth()->user()->can('admin.access.merchant.suspend')) {
            return '<a href="'.route('admin.merchant.suspend', $this).'" data-method="get"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.suspend').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.suspend').'" class="btn btn-dark btn-sm"><i class="fas fa-stop" style="color: #fff;"></i>&nbsp;<span style="color: #fff;">Suspend</span></a> ';
        }

        return '';
    }

    public function getUnsuspendButtonAttribute(){
        if (auth()->user()->can('admin.access.merchant.suspend')) {
            return '<a href="'.route('admin.merchant.suspend', $this).'" data-method="get"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.unsuspend').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.unsuspend').'" class="btn btn-success btn-sm"><i class="fas fa-stop" style="color: #fff;"></i>&nbsp;<span style="color: #fff;">Unsuspend</span></a> ';
        }

        return '';
    }


    public function getRejectButtonAttribute(){
        if (auth()->user()->can('admin.access.merchant.reject')) {
            return '<a href="'.route('admin.merchant.reject', $this).'" data-method="get"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.reject').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.reject').'" class="btn btn-warning btn-sm"><i class="fas fa-ban" style="color: #fff;"></i>&nbsp;<span style="color: #fff;">Reject</span></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
            $buttons = $this->getShowButtonAttribute().' '.$this->getEditButtonAttribute().' '.$this->getDeleteButtonAttribute();
            if ($this->status == MerchantStatus::ID_PENDING) {
                return $buttons.' '.$this->getRejectButtonAttribute();
            }elseif ($this->status == MerchantStatus::ID_APPROVED) {
                return $buttons.' '.$this->getSuspendButtonAttribute();
            } elseif ($this->status == MerchantStatus::ID_SUSPENDED) {
                return $buttons.' '.$this->getUnsuspendButtonAttribute();
            }
            return $buttons;
    }
}
