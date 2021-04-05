@extends('admin.layouts.layout')
@section('title', 'Gallery Position')

@section('content')

<div class="box box-success">

    <div class="box-header with-border">
        <div class="box-header pull-left">
            <span class="box-title">Gallery Position</span>
        </div>

        @if(App\Model\Permission::roleHasSpecificPermission('gallery.index'))

        <div class="box-tools pull-right">
            <a href="{{route('gallery.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
        </div>

        @endif

    </div>

    <!-- /.box-header -->
    <div class="box-body box-min-height">
        <div class="row">



            <form method="post" action="{{route('gallery.savePosition')}}" enctype="multipart/form-data">
                @csrf
                <ul id="mySortable">
                    @php $count = 1; @endphp
                    @foreach($galleries as $gallery)
                    <li draggable="true" style="display: inline-block;verticle-align:top;">
                        <label  for="pro_pic"><img id="up_44" width="200px" height="200px" style="cursor: pointer; border: 2px solid #3C8DBC; padding: 4px;" src="{{ asset('/storage/images/sliders/'. $gallery -> image)}}"  alt=""></label>
                        <input type="hidden" name="position[{{$gallery->id}}]" value="{{$count++}}"></li>
                    @endforeach
                    
                </ul>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>

            </form>


        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
</div>

@endsection

@push('page-scripts')
<script defer src="{{asset('admin_assets/assets/js/jquery-ui.js')}}"></script>
@endpush