<?php

namespace Modules\Merchant\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
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
        $input = $request->all();
        logger($input);
        return DataTables::of($this->merchant->getForDataTable($input))
            ->addColumn('actions', function ($merchant) {
                return $merchant->action_buttons;
            })
            ->editColumn('status', function ($merchant) {
                return $merchant->status_label;
            })
            ->editColumn('active', function ($merchant) {
                if ($merchant->active) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->editColumn('approved_at', function ($merchant) {
                return $merchant->approved_at ? Carbon::parse($merchant->approved_at)->format('Y-m-d H:i:s') : '-';
            })
            ->editColumn('approximate_sale', function ($merchant) {
                return $merchant->apprximate_sale ?? '-';
            })
            ->editColumn('website_url', function ($merchant) {
                return $merchant->website_url ?? '-';
            })
            ->editColumn('updated_at', function ($merchant) {
                return $merchant->updated_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['actions', 'status', 'active'])
            ->make(true);
    }
}
