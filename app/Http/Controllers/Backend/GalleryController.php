<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Gallery;
use App\Model\Tour;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
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
        $query  = Tour::latest();

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
        $tours = Tour::all();
        return view($this->path . '.create', compact('breadcumbs', 'tours'));
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

        foreach ($request->file('photo') as $image) {
            $filename = md5(time()) . $image->getClientOriginalName();
            $image->storeAs('images/sliders', $filename, 'public');
            Gallery::create([
                'tour_id' => $request->tour_id,
                'image' => $filename
            ]);
        }

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $breadcumbs = $this->breadcumbs($this->model, 'show');

        $galleries = Gallery::where('tour_id', $id)->get();

        return view($this->path . '.show', compact('galleries', "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $galleries = Gallery::where('tour_id', $id)->get();
        // $tours = Tour::all();
        // $breadcumbs = $this->breadcumbs($this->model, 'edit');
        // return view(
        //     $this->path . '.edit',
        //     compact("galleries", 'tours', "breadcumbs")
        // );
        return redirect()->back();
    }

    public function forceEdit($id)
    {
        $galleries = Gallery::where('tour_id', $id)->orderby('serial', 'asc')->get();
        $tours = Tour::all();
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("galleries", 'id', 'tours', "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $this->validation($request, $gallery->id);
        $gallery->update($request->all());
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    public function forceUpdate(Request $request, $id)
    {
        $previousImages = $request->input('previous_image') ?? [];
        $deletedImages = Gallery::where('tour_id', $id)
            ->whereNotIn('id', $previousImages)->get();
        if (count($deletedImages) > 0) {
            foreach ($deletedImages as $deletedImage) {
                $deletedImage->delete();
            }
        }
        if ($request->file('photo')) {
            foreach ($request->file('photo') as $image) {
                $filename = md5(time()) . $image->getClientOriginalName();
                $image->storeAs('images/sliders', $filename, 'public');
                Gallery::create([
                    'tour_id' => $request->tour_id,
                    'image' => $filename
                ]);
            }
        }
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.gallery";
        $this->model = "Gallery";
        $this->route = "gallery";
    }

    private function validation($request, $gallery = null)
    {
        $this->validate($request, [
            'tour_id'  => "required"
        ], [
            'tour_id.required' => "Please select a taxi/tour name"
        ]);
    }

    public function deleteImage(Request $request)
    {
        $gallery = Gallery::where('id', $request->input('id'));
        $gallery->delete();
        return response()->json(['success' => 'Image Deleted.']);
    }

    public function position()
    {
        $galleries = Gallery::orderby('serial', 'ASC')->get();
        return view($this->path . '.position', compact("galleries"));
    }

    public function savePosition(Request $request)
    {
        if (!empty($request->position) && count($request->position) > 0) {
            foreach ($request->position as $id => $position) {

                $gallery = Gallery::where('id', $id)->first();

                $gallery->update([
                    'serial' => $position
                ]);
            }
            return redirect()->back()->with('success', "position updated");
        }
        return redirect()->back()->with('error', "something is wrong");
    }
}
