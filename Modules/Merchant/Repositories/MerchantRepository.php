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
    public function getForDataTable(array $input)
    {
        $type = $input['type'] ?? 'approved';

        $merchants = $this->model->with('createdUser')->with('updatedUser');

        switch ($type) {
            case 'pending':
                $merchants = $merchants->where('status', MerchantStatus::ID_PENDING);
                break;
            case 'rejected':
                $merchants = $merchants->where('status', MerchantStatus::ID_REJECTED);
                break;
            case 'suspended':
                $merchants = $merchants->where('status', MerchantStatus::ID_SUSPENDED);
                break;
            case 'approved':
            default:
                $merchants = $merchants->where('status', MerchantStatus::ID_APPROVED);
                break;
        }

        $is_active = $input['active'] ?? 1;
        $merchants = $merchants->where('active', $is_active);

        return $merchants->select('*');
    }


    public function create($input){
        $userId = auth()->id();

        if ($input['status'] == MerchantStatus::ID_PENDING) {
            $input['created_by'] = $userId;
        } elseif ($input['status'] == MerchantStatus::ID_APPROVED) {
            $input['created_by'] = $userId;
            $input['approved_at'] = now();
        }
        return $this->model->create($input);
    }

    public function updateById($id, array $input, array $options = [])
    {
        $userId = auth()->id();
        $merchant = $this->model->findOrFail($id);

        if (isset($input['status'])) {
            if ($input['status'] == MerchantStatus::ID_PENDING) {
                $input['created_by'] = $userId;
            } elseif ($input['status'] == MerchantStatus::ID_APPROVED) {
                $input['approved_at'] = now();
            }
        }
        $input['last_updated_by'] = $userId;
        $merchant->update($input, $options);
        return $merchant;
    }




    public function suspendById($merchant_id){
        $merchant = $this->model->find($merchant_id);
        if ($merchant->status == MerchantStatus::ID_APPROVED){
            $merchant->update([
                'status' => MerchantStatus::ID_SUSPENDED,
                'last_updated_by' => auth()->id(),
            ]);
        }elseif ($merchant->status == MerchantStatus::ID_SUSPENDED){
            $merchant->update([
                'status' => MerchantStatus::ID_APPROVED,
                'last_updated_by' => auth()->id(),
            ]);
        } else {
            throw new GeneralException(__('merchant::exceptions.merchant.suspend_not_allowed'));
        }
    }

    public function rejectById($merchant_id){
        $this->model->find($merchant_id)->update([
            'status' => MerchantStatus::ID_REJECTED,
            'last_updated_by' => auth()->id(),
        ]);
    }
}
