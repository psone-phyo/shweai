<?php
namespace Modules\Merchant\Enums;

class MerchantStatus{
    const ID_PENDING = 0;
    const ID_APPROVED = 1;
    const ID_REJECTED = 2;
    const ID_SUSPENDED = 3;

    const NAME_PENDING = "pending";
    const NAME_APPROVED = "approved";
    const NAME_REJECTED = "rejected";
    const NAME_SUSPENDED = "suspended";



    const AVAILABLES = [
        self::ID_PENDING => self::NAME_PENDING,
        self::ID_APPROVED => self::NAME_APPROVED,
        self::ID_REJECTED => self::NAME_REJECTED,
        self::ID_SUSPENDED => self::NAME_SUSPENDED,
    ];

    const AVAILABLES_CREATE = [
        self::ID_PENDING => self::NAME_PENDING,
        self::ID_APPROVED => self::NAME_APPROVED,
    ];
}