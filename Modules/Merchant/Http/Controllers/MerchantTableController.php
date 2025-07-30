<?php

namespace Modules\Merchant\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\Merchant\Repositories\MerchantRepository;
use Modules\Merchant\Http\Requests\ManageMerchantRequest;

class MerchantTableController extends Controller
{
    /**
     * @var MerchantRepository
     */
    protected $merchant;

    /**
     * @param MerchantRepository $merchant
     */
    public function __construct(MerchantRepository $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @param ManageMerchantRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMerchantRequest $request)
    {
        return DataTables::of($this->merchant->getForDataTable())
            ->addColumn('actions', function ($merchant) {
                return $merchant->action_buttons;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
