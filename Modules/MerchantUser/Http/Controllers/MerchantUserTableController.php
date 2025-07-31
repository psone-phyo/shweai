<?php

namespace Modules\MerchantUser\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Modules\MerchantUser\Repositories\MerchantUserRepository;
use Modules\MerchantUser\Http\Requests\ManageMerchantUserRequest;

class MerchantUserTableController extends Controller
{
    /**
     * @var MerchantUserRepository
     */
    protected $merchantuser;

    /**
     * @param MerchantUserRepository $merchantuser
     */
    public function __construct(MerchantUserRepository $merchantuser)
    {
        $this->merchantuser = $merchantuser;
    }

    /**
     * @param ManageMerchantUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMerchantUserRequest $request)
    {
        return DataTables::of($this->merchantuser->getForDataTable())
            ->addColumn('actions', function ($merchantuser) {
                return $merchantuser->action_buttons;
            })
            ->addColumn('active', function ($merchantuser) {
                return $merchantuser->status;
            })
            ->editColumn('updated_at', function ($merchantuser){
                return $merchantuser->updated_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['actions', 'active'])
            ->make(true);
    }
}
