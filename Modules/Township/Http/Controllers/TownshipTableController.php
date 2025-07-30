<?php

namespace Modules\Township\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\Township\Repositories\TownshipRepository;
use Modules\Township\Http\Requests\ManageTownshipRequest;

class TownshipTableController extends Controller
{
    /**
     * @var TownshipRepository
     */
    protected $township;

    /**
     * @param TownshipRepository $township
     */
    public function __construct(TownshipRepository $township)
    {
        $this->township = $township;
    }

    /**
     * @param ManageTownshipRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTownshipRequest $request)
    {
        logger('ok');
        return DataTables::of($this->township->getForDataTable($request))
            ->addColumn('status', function ($township) {
                return $township->status;
            })
            ->editColumn('region', function ($township) {
                return $township->region->name;
            })
            ->editColumn('updated_at',function($township){
                return $township->updated_at;
            })
            ->editColumn('created_by', function ($township) {
                return $township->createdUser->name ?? '-';
            })
            ->editColumn('last_updated_by', function ($township) {
                return $township->updatedUser->name ?? '-';
            })
            ->addColumn('actions', function ($township) {
                return $township->action_buttons;
            })
            ->rawColumns(['status','actions','region'])
            ->make(true);
    }
}
