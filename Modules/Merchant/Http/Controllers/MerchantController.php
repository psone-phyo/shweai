<?php

namespace Modules\Merchant\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Merchant\Entities\Merchant;
use Modules\Merchant\Http\Requests\ManageMerchantRequest;
use Modules\Merchant\Http\Requests\CreateMerchantRequest;
use Modules\Merchant\Http\Requests\UpdateMerchantRequest;
use Modules\Merchant\Http\Requests\ShowMerchantRequest;
use Modules\Merchant\Repositories\MerchantRepository;

class MerchantController extends Controller
{
 /**
     * @var MerchantRepository
     * @var CategoryRepository
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageMerchantRequest $request)
    {
        return view('merchant::index');
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
        $this->merchant->create($request->except('_token','_method'));
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
        return view('merchant::show')->withMerchant($merchant);
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
}
