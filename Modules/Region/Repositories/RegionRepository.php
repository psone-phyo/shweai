<?php

namespace Modules\Region\Repositories;

use Modules\Region\Entities\Region;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Cache;

/**
 * Class RegionRepository.
 */
class RegionRepository extends BaseRepository
{
    private $cacheDuration = 60;
    /**
     * @return string
     */
    public function __construct(Region $model)
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
    public function getActiveAll($orderBy = 'created_at', $sort = 'desc')
    {
        return Cache::remember('regions', $this->cacheDuration, function () use ($orderBy, $sort) {
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
    public function getForDataTable()
    {
        return $this->model
            ->select('*')->with('createdUser','updatedUser');
    }
}
