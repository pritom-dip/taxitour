@extends('admin.layouts.layout')
@section('title', 'Show Image')

@section('content')

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Gallery View</h3>
            <div class="box-tools pull-right">
                <a href="{{route('gallery.index')}}" class="btn btn-xs btn-success pull-left text-white router-link-active" title="Add New"><i class="fa fa-arrow-left"></i> <span>Back</span></a>
            </div>
        </div>
        <div class="box-body box-min-height">
            <ul>
            @forelse ($galleries as $glry)
                <li style="display: inline-block; width: 20%; margin:10px;">
                    <img width="100%" height="200px" src="{{asset('/storage/images/sliders/' . $glry->image)}}" />
                </li>
            @empty

            <li>No pic available</li>
                
            @endforelse
            </ul>
            
        </div>
    </div>
    <!---->
</section>


@endsection