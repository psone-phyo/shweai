<?php

namespace Modules\MerchantUser\Repositories;

use Modules\MerchantUser\Entities\MerchantUser;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MerchantUserRepository.
 */
class MerchantUserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function __construct(MerchantUser $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->get();
    }

    /**
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->with('merchant')->with('user')->with('createdUser')
            ->select('*');
    }
}
