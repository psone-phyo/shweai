<?php

namespace Modules\Merchant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Merchant\Entities\Merchant;

use App\Domains\Auth\Services\UserService;
use Modules\Merchant\Repositories\MerchantRepository;
use Modules\Merchant\Http\Requests\ShowMerchantRequest;
use Modules\Merchant\Http\Requests\CreateMerchantRequest;
use Modules\Merchant\Http\Requests\ManageMerchantRequest;
use Modules\Merchant\Http\Requests\UpdateMerchantRequest;
use Modules\MerchantUser\Repositories\MerchantUserRepository;

class MerchantController extends Controller
{
 /**
     * @var MerchantRepository
     * @var CategoryRepository
     */
    protected $merchant;
    protected $merchant_user;
    protected $user;

    /**
     * @param MerchantRepository $merchant
     */
    public function __construct(MerchantRepository $merchant, UserService $user, MerchantUserRepository $merchant_user)
    {
        $this->merchant = $merchant;
        $this->user = $user;
        $this->merchant_user = $merchant_user;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageMerchantRequest $request)
    {
        $type = 'approved';
        return view('merchant::index', compact('type'));
    }

    public function suspendedList(ManageMerchantRequest $request)
    {
        $type = 'suspended';
        return view('merchant::index', compact('type'));
    }

    public function rejectedList(ManageMerchantRequest $request)
    {
        $type = 'rejected';
        return view('merchant::index', compact('type'));
    }

    public function pendingList(ManageMerchantRequest $request)
    {
        $type = 'pending';
        return view('merchant::index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ManageMerchantRequest $request)
    {
        return view('merchant::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateMerchantRequest $request)
    {
        $user = $this->user->store([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' =>'user',
        ]);
        $merchant = $this->merchant->create($request->except('_token','_method'));
        $this->merchant_user->create([
            'user_id' => $user->id,
            'merchant_id' => $merchant->id,
            'mobile' => $request->mobile,
            'nrc' => $request->nrc,
        ]);
        return redirect()->route('admin.merchant.index')->withFlashSuccess(trans('merchant::alerts.backend.merchant.created'));
    }

    /**
     * @param Merchant              $merchant
     * @param ManageMerchantRequest $request
     *
     * @return mixed
     */
    public function edit(Merchant $merchant, ManageMerchantRequest $request)
    {
        return view('merchant::edit')
            ->withMerchant($merchant);
    }

    /**
     * @param Merchant              $merchant
     * @param UpdateMerchantRequest $request
     *
     * @return mixed
     */
    public function update(Merchant $merchant, UpdateMerchantRequest $request)
    {
        $this->merchant->updateById($merchant->id,$request->except('_token','_method'));

        return redirect()->route('admin.merchant.index')->withFlashSuccess(trans('merchant::alerts.backend.merchant.updated'));
    }

    /**
     * @param Merchant              $merchant
     * @param ManageMerchantRequest $request
     *
     * @return mixed
     */
    public function show(Merchant $merchant, ShowMerchantRequest $request)
    {
        return view('merchant::show')->withMerchant($merchant)->with('updatedUser')->with("createdUser");
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Merchant $merchant)
    {
        $this->merchant->deleteById($merchant->id);
        return redirect()->route('admin.merchant.index')->withFlashSuccess(trans('merchant::alerts.backend.merchant.deleted'));
    }

    public function suspend(Merchant $merchant){
        $this->merchant->suspendById($merchant->id);
        return redirect()->route('admin.merchant.suspended_list')->withFlashSuccess(trans('merchant::alerts.backend.merchant.suspended'));
    }

    public function reject(Merchant $merchant){
        $this->merchant->rejectById($merchant->id);
        return redirect()->route('admin.merchant.rejected_list')->withFlashSuccess(trans('merchant::alerts.backend.merchant.rejected'));
    }


}
