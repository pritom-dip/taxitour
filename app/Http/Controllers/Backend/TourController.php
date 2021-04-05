<?php

namespace App\Http\Controllers\Backend;

use App\Model\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\Type;
use App\Model\Destination;
use App\Model\Location;
use App\Model\Category;
use App\Model\Activity;
use App\Model\Duration;
use App\Model\Service;

class TourController extends Controller
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
        $types = Type::all();
        $destinations = Destination::where('status', 'a')->get();
        $locations = Location::where('status', 'a')->get();
        $categories = Category::where('status', 'a')->get();
        $activities = Activity::where('status', 'a')->get();
        $durations = Duration::where('status', 'a')->get();
        $services = Service::where('status', 'a')->get();
        return view($this->path . '.create', compact('breadcumbs', 'types', 'destinations', 'locations', 'categories', 'activities', 'durations', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validation($request);

        $tourData = $request->input('tour');
        // dd($tourData);
        $rentData = $request->rent_section[0]['rent_section'];
        $facilityData = $request->facilities_section[0]['facilities_section'];
        $conditionData = $request->conditions_section[0]['conditions_section'];

        //Save feature image for tours if exists
        if (!empty($request->file('tour.featured_img'))) {
            $image = $request->file('tour.featured_img');
            $filename = md5(time()) . $image->getClientOriginalName();
            $image->storeAs('images/tours', $filename, 'public');
            $tourData['featured_img'] = $filename;
        }

        $tour = Tour::create($tourData);

        if ($tour) {
            $tour->rents()->createMany($rentData);
            $tour->facilities()->createMany($facilityData);
            $tour->conditions()->createMany($conditionData);
        }

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'show');

        return view($this->path . '.show', compact("tour", "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("tour", "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $this->validation($request, $tour->id);
        $tour->update($request->all());
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.tour.";
        $this->model = "Tour";
        $this->route = "tour";
    }

    private function validation($request, $tour = null)
    {
        $this->validate($request, [
            'tour.name'  => "required|unique:tours,name," . $tour
        ]);
    }
}
