<?php

namespace App\Http\Controllers\Backend;

use App\Model\Taxibooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxibookingController extends Controller
{
    private $path;
    private $model;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = Taxibooking::latest();

        if (!empty($request->field_name) && !empty($request->value)) {
            $query->where($request->field_name, 'like', '%' . $request->value . '%');
        }

        $breadcumbs = $this->breadcumbs($this->model, 'index');
        $datas      = $query->paginate(10);

        return view($this->path . '.index', compact('datas', 'breadcumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcumbs = $this->breadcumbs($this->model, 'create');
        return view($this->path . '.create', compact('breadcumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        Taxibooking::create($request->all());

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxibooking  $taxibooking
     * @return \Illuminate\Http\Response
     */
    public function show(Taxibooking $taxibooking)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'show');

        return view($this->path . '.show', compact("taxibooking", "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxibooking  $taxibooking
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxibooking $taxibooking)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("taxibooking", "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxibooking  $taxibooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxibooking $taxibooking)
    {
        $this->validation($request, $taxibooking->id);
        $taxibooking->update($request->all());
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxibooking  $taxibooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxibooking $taxibooking)
    {
        $taxibooking->delete();
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.";
        $this->model = "Taxibooking";
        $this->route = "Taxibooking";
    }

    private function validation($request, $taxibooking = null)
    {
        $this->validate($request, [
            'name'  => "required|unique:taxibookings,name," . $taxibooking
        ]);
    }
}
