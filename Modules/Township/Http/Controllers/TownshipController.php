<?php

namespace Modules\Township\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Township\Entities\Township;
use Modules\Township\Http\Requests\ManageTownshipRequest;
use Modules\Township\Http\Requests\CreateTownshipRequest;
use Modules\Township\Http\Requests\UpdateTownshipRequest;
use Modules\Township\Http\Requests\ShowTownshipRequest;
use Modules\Township\Repositories\TownshipRepository;
use Modules\Region\Repositories\RegionRepository;
use Modules\Region\Entities\Region;

class TownshipController extends Controller
{
 /**
     * @var TownshipRepository
     * @var CategoryRepository
     */
    protected $township;
    protected $region;

    /**
     * @param TownshipRepository $township
     */
    public function __construct(TownshipRepository $township,RegionRepository $region)
    {
        $this->township = $township;
        $this->region   = $region;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageTownshipRequest $request)
    {
        $regions = Region::pluck('name','id');
        return view('township::index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(ManageTownshipRequest $request)
    {
        $regions = Region::all();
        return view('township::create')->with('regions',$regions);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateTownshipRequest $request)
    {
        $input = $request->except('_token','_method');
        $input['active']= isset($input['active']) ? 1 : 0 ;
        $input['created_by'] = Auth::user()->id;
        $this->township->create($input);
        return redirect()->route('admin.township.index')->withFlashSuccess(trans('township::alerts.backend.township.created'));
    }

    /**
     * @param Township              $township
     * @param ManageTownshipRequest $request
     *
     * @return mixed
     */
    public function edit(Township $township, ManageTownshipRequest $request)
    {
        $regions = Region::all();
        return view('township::edit')
            ->withTownship($township)->with('regions',$regions);
    }

    /**
     * @param Township              $township
     * @param UpdateTownshipRequest $request
     *
     * @return mixed
     */
    public function update(Township $township, UpdateTownshipRequest $request)
    {
        $request['active'] = $request->active ? 1 : 0;
        $request['last_updated_by'] = Auth::user()->id;
        $this->township->updateById($township->id,$request->except('_token','_method'));

        return redirect()->route('admin.township.index')->withFlashSuccess(trans('township::alerts.backend.township.updated'));
    }

    /**
     * @param Township              $township
     * @param ManageTownshipRequest $request
     *
     * @return mixed
     */
    public function show(Township $township, ShowTownshipRequest $request)
    {
        return view('township::show')->withTownship($township);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Township $township)
    {
        if(optional($township->customer)->count()){
            return redirect()->route('admin.township.index')->withFlashDanger(trans('township::alerts.backend.township.not_deleted'));
        }

        $this->township->deleteById($township->id);
        return redirect()->route('admin.township.index')->withFlashSuccess(trans('township::alerts.backend.township.deleted'));
    }
}
