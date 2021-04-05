<?php

namespace App\Http\Controllers\Backend;

use App\Model\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
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
        $query  = Destination::latest()->where('status', 'a');

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
        Destination::create($request->all());

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'show');

        return view($this->path . '.show', compact("destination", "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("destination", "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        $this->validation($request, $destination->id);
        $destination->update($request->all());
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $destination->update(['status' => 'd']);
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.destination";
        $this->model = "Destination";
        $this->route = "destination";
    }

    private function validation($request, $destination = null)
    {
        $this->validate($request, [
            'name'  => "required|unique:destinations,name," . $destination
        ]);
    }
}
