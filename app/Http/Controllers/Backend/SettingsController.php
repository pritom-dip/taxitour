<?php

namespace App\Http\Controllers\Backend;

use App\Model\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
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
        $query  = Settings::latest();

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
        $data['site_logo'] = '';
        $data['bg_image'] = '';

        //Save logo image
        if (!empty($request->file('site_logo'))) {
            $image = $request->file('site_logo');
            $filename = md5(time()) . $image->getClientOriginalName();
            $image->storeAs('images/settings', $filename, 'public');
            $data['site_logo'] = $filename;
        }

        // Save bg image
        if (!empty($request->file('bg_image'))) {
            $bg_img = $request->file('bg_image');
            $bg_filename = md5(time()) . $bg_img->getClientOriginalName();
            $bg_img->storeAs('images/settings', $bg_filename, 'public');
            $data['bg_image'] = $bg_filename;
        }

        Settings::create([
            'heading' => $request->input('heading'),
            'description' => $request->input('description'),
            'site_logo' => $data['site_logo'] ? $data['site_logo'] : '',
            'bg_image' => $data['bg_image'] ? $data['bg_image'] : ''
        ]);

        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $setting)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'show');

        return view($this->path . '.show', compact("setting", "breadcumbs"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $setting)
    {
        $breadcumbs = $this->breadcumbs($this->model, 'edit');
        return view(
            $this->path . '.edit',
            compact("setting", "breadcumbs")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $setting)
    {
        $this->validation($request, $setting->id);

        //Save logo image
        if (!empty($request->file('site_logo'))) {
            $image = $request->file('site_logo');
            $filename = md5(time()) . $image->getClientOriginalName();
            $image->storeAs('images/settings', $filename, 'public');
            Storage::delete('/images/settings/' . $setting->site_logo);
            $data['site_logo'] = $filename;
        } else {
            $data['site_logo'] = $setting->site_logo;
        }

        // Save bg image
        if (!empty($request->file('bg_image'))) {
            $bg_img = $request->file('bg_image');
            $bg_filename = md5(time()) . $bg_img->getClientOriginalName();
            $bg_img->storeAs('images/settings', $bg_filename, 'public');
            $data['bg_image'] = $bg_filename;
        } else {
            $data['bg_image'] = $setting->bg_image;
        }

        $setting->update([
            'heading' => $request->input('heading'),
            'description' => $request->input('description'),
            'site_logo' => $data['site_logo'] ? $data['site_logo'] : '',
            'bg_image' => $data['bg_image'] ? $data['bg_image'] : ''
        ]);
        return redirect()->back()->with('success', $this->model . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $settings = Settings::find($id);
        $settings->delete();
        return redirect()->route($this->route . '.index')
            ->with('success', $this->model . ' deleted');
    }

    public function __construct()
    {
        $this->path  = "admin.settings";
        $this->model = "Settings";
        $this->route = "settings";
    }

    private function validation($request, $settings = null)
    {
        $this->validate($request, [
            'heading'  => "required",
            'description'  => "required",
        ]);
    }
}
