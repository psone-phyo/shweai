<?php

namespace Modules\Merchant\Http\Controllers;

use GMBF\MyanmarPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\DB;
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
        $input = $request->except('_token','_method');
        $phoneNumber = new MyanmarPhoneNumber();

        $input['business_mobile'] = $phoneNumber->add_prefix($input['business_mobile']);
        $input['mobile'] = $phoneNumber->add_prefix($input['mobile']);

        DB::beginTransaction();

        try {
            // Create user
            $user = $this->user->store([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'active' => $input['active'],
                'mobile' => $input['mobile'],
            ]);

            // Create merchant
            $merchant = $this->merchant->create([
                'company_name'       => $request->input('company_name'),
                'mm_company_name'    => $request->input('mm_company_name'),
                'business_name'      => $request->input('business_name'),
                'mm_business_name'   => $request->input('mm_business_name'),
                'business_email'     => $request->input('business_email'),
                'business_mobile'    => $request->input('business_mobile'),
                'address'            => $request->input('address'),
                'registration_number'=> $request->input('registration_number'),
                'latitude'           => $request->input('latitude'),
                'longitude'          => $request->input('longitude'),
                'website_url'        => $request->input('website_url'),
                'approximate_sale'   => $request->input('approximate_sale'),
                'status'             => $request->input('status'),
                'active'             => $request->input('merchant_active'),
            ]);

            // Create merchant_user relationship
            $this->merchant_user->create([
                'user_id' => $user->id,
                'merchant_id' => $merchant->id,
                'nrc' => $input['nrc'],
                'created_by' => auth()->id(),
            ]);

            DB::commit();

            return redirect()
                ->route('admin.merchant.index')
                ->withFlashSuccess(trans('merchant::alerts.backend.merchant.created'));

        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->withFlashDanger('Something went wrong while creating merchant: ' . $e->getMessage());
        }
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
