<?php

namespace Modules\MerchantUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\MerchantUser\Entities\MerchantUser;
use Modules\MerchantUser\Http\Requests\ManageMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\CreateMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\UpdateMerchantUserRequest;
use Modules\MerchantUser\Http\Requests\ShowMerchantUserRequest;
use Modules\MerchantUser\Repositories\MerchantUserRepository;

class MerchantUserController extends Controller
{
 /**
     * @var MerchantUserRepository
     * @var CategoryRepository
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
        return view('merchantuser::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateMerchantUserRequest $request)
    {
        $this->merchantuser->create($request->except('_token','_method'));
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
        return view('merchantuser::edit')
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
        $this->merchantuser->updateById($merchantuser->id,$request->except('_token','_method'));

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
        return view('merchantuser::show')->withMerchantUser($merchantuser);
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
