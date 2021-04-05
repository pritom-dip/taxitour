<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Type;

class TypeController extends Controller
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
        $query  = Type::latest();

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
        Type::create($request->all());

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'show');

        return view($this->path . '.show', compact("type", "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("type", "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $this->validation($request, $type->id);
        $type->update($request->all());
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.type";
        $this->model = "Type";
        $this->route = "type";
    }

    private function validation($request, $type = null)
    {
        $this->validate($request, [
            'name'  => "required|unique:types,name," . $type
        ]);
    }
}
