<?php

namespace Modules\MerchantUser\Http\Controllers;

use GMBF\MyanmarPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Domains\Auth\Services\UserService;
use Modules\MerchantUser\Entities\MerchantUser;
use Modules\Merchant\Repositories\MerchantRepository;
use Modules\MerchantUser\Repositories\MerchantUserRepository;
use Modules\MerchantUser\Http\Requests\ShowMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\CreateMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\ManageMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\UpdateMerchantUserRequest;

class MerchantUserController extends Controller
{
    /**
     * @var MerchantUserRepository
     * @var CategoryRepository
     */
    protected $merchantuser;
    protected $merchant;
    protected $user;

    /**
     * @param MerchantUserRepository $merchantuser
     */
    public function __construct(MerchantUserRepository $merchantuser, MerchantRepository $merchant, UserService $user)
    {
        $this->merchantuser = $merchantuser;
        $this->merchant = $merchant;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageMerchantUserRequest $request)
    {
        return view('merchantuser::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ManageMerchantUserRequest $request)
    {
        $merchants = $this->merchant->getAll();
        return view('merchantuser::create', compact('merchants'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateMerchantUserRequest $request)
    {
        $input = $request->except('_token', '_method');
        $phoneNumber = new MyanmarPhoneNumber();

        $input['mobile'] = $phoneNumber->add_prefix($input['mobile']);

        $user = $this->user->store([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'active' => $input['active'],
            'mobile' => $input['mobile'],
        ]);

        // Create merchant_user relationship
        $this->merchantuser->create([
            'user_id' => $user->id,
            'merchant_id' => $input['merchant_id'],
            'nrc' => $input['nrc'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.merchantuser.index')->withFlashSuccess(trans('merchantuser::alerts.backend.merchantuser.created'));
    }

    /**
     * @param MerchantUser              $merchantuser
     * @param ManageMerchantUserRequest $request
     *
     * @return mixed
     */
    public function edit(MerchantUser $merchantuser, ManageMerchantUserRequest $request)
    {
        $merchants = $this->merchant->getAll();
        return view('merchantuser::edit', compact('merchants'))
            ->withMerchantUser($merchantuser);
    }

    /**
     * @param MerchantUser              $merchantuser
     * @param UpdateMerchantUserRequest $request
     *
     * @return mixed
     */
    public function update(MerchantUser $merchantuser, UpdateMerchantUserRequest $request)
    {
        $input = $request->except('_token', '_method');
        $phoneNumber = new MyanmarPhoneNumber();

        $input['mobile'] = $phoneNumber->add_prefix($input['mobile']);

        $user = $this->user->update($merchantuser->user, [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
        ]);

        $this->merchantuser->updateById($merchantuser->id, [
            'user_id' => $user->id,
            'merchant_id' => $input['merchant_id'],
            'nrc' => $input['nrc'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.merchantuser.index')->withFlashSuccess(trans('merchantuser::alerts.backend.merchantuser.updated'));
    }

    /**
     * @param MerchantUser              $merchantuser
     * @param ManageMerchantUserRequest $request
     *
     * @return mixed
     */
    public function show(MerchantUser $merchantuser, ShowMerchantUserRequest $request)
    {
        return view('merchantuser::show')->withMerchantUser($merchantuser)->with('merchant')->with('user');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(MerchantUser $merchantuser)
    {
        $this->merchantuser->deleteById($merchantuser->id);

        return redirect()->route('admin.merchantuser.index')->withFlashSuccess(trans('merchantuser::alerts.backend.merchantuser.deleted'));
    }
}
