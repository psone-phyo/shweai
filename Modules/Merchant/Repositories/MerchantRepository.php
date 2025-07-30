<?php

namespace Modules\Merchant\Repositories;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Merchant\Entities\Merchant;
use Modules\Merchant\Enums\MerchantStatus;

/**
 * Class MerchantRepository.
 */
class MerchantRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function __construct(Merchant $model)
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
        return $this->model
            ->select('*');
    }

    public function create($input){
        $userId = auth()->id();

        if ($input['status'] == MerchantStatus::ID_PENDING) {
            $input['created_by'] = $userId;
        } elseif ($input['status'] == MerchantStatus::ID_APPROVED) {
            $input['created_by'] = $userId;
            $input['approved_by'] = $userId;
            $input['approved_at'] = now();
        }
        return $this->model->create($input);
    }
}
