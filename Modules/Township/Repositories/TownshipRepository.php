<?php

namespace Modules\Township\Repositories;

use Modules\Township\Entities\Township;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Cache;

/**
 * Class TownshipRepository.
 */
class TownshipRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function __construct(Township $model)
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

    public function getActiveAll($orderBy = 'created_at', $sort = 'desc')
    {
        $cacheDuration = 60;
        return Cache::remember('townships', $cacheDuration, function () use ($orderBy, $sort) {
                return $this->model
                    ->where('active', 1)
                    ->orderBy($orderBy, $sort)
                    ->get();
            });
    }

    /**
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        $query = $this->model->with(['region','createdUser','updatedUser']);

        if($request['region_id']){
            $query->where('region_id',$request['region_id']);
        }

        return $query->select('townships.*');
    }

    public function getTownshipById($regionId)
    {
        return $this->model
            ->where('region_id',$regionId)
            ->where('active',1)
            ->select('*')
            ->orderBy('name', 'asc')
            ->get();
    }
}
