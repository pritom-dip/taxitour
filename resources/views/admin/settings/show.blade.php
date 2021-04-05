@extends('admin.layouts.layout')
@section('title', 'Show settings')

@section('content')

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Settings View</h3>
            <div class="box-tools pull-right">
                <a href="{{route('settings.index')}}" class="btn btn-xs btn-success pull-left text-white router-link-active" title="Add New"><i class="fa fa-arrow-left"></i> <span>Back</span></a>
            </div>
        </div>
        <div class="box-body box-min-height">
            <table class="table table-bordered table-hover table-striped">
                <tbody>
                    
                    <tr>
                        <th class="text-capitalize">Heading</th>
                        <td><span>{{$setting->heading}}</span></td>
                    </tr>
                    <tr>
                        <th class="text-capitalize">Descrition</th>
                        <td><span>{{$setting->description}}</span></td>
                    </tr>

                    <tr>
                        <th class="text-capitalize">Image</th>
                        <td><img src="{{asset('/storage/images/settings/' . $setting->site_logo)}}" /></td>
                    </tr>

                    <tr>
                        <th class="text-capitalize">Background Image</th>
                        <td><img src="{{asset('/storage/images/settings/' . $setting->bg_image)}}" /></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!---->
</section>


@endsection