@extends('admin.layouts.layout')
@section('title', 'Edit Gallery')

@section('content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="box-header pull-left">
                <span class="box-title">Edit Gallery</span>
            </div>

            <div class="box-tools pull-right">
                <a href="{{route('gallery.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                <form class="form-row" method="POST" action="{{route('gallery.forceUpdate', $id)}}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Taxi/Tour Name<span class="control-label"></span></label>
                            <select name="tour_id" class="form-control" required>
                                <option value="">Please select</option>
                                @foreach ($tours as $tour)
                                    <option @if($tour->id == $id) selected @endif value="{{$tour->id}}">{{$tour->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-12">

                        <style>
                            
                            .block{
                            background-color: rgba(255, 255, 255, 0.5);
                            margin:0 auto;
                            margin-bottom: 30px;
                            padding: 10px;
                            text-align: center;
                            -webkit-border-radius: 4px;
                            -moz-border-radius: 4px;
                            border-radius: 4px;
                            }

                            label.button{
                            -webkit-border-radius: 4px;
                            -moz-border-radius: 4px;
                            border-radius: 4px;
                            background-color: #FFFFFF;
                            border: 1px solid #6C6C6C;
                            color: #6C6C6C;
                            padding: 5px 10px;
                            margin: 5px 0;
                            display: inline-block;
                            -webkit-transition: all 200ms linear;
                            -moz-transition: all 200ms linear;
                            -ms-transition: all 200ms linear;
                            -o-transition: all 200ms linear;
                            transition: all 200ms linear;
                            }

                            label.button:hover{
                            background-color:#F0F0F0;
                            cursor: pointer;
                            -webkit-transition: all 200ms linear;
                            -moz-transition: all 200ms linear;
                            -ms-transition: all 200ms linear;
                            -o-transition: all 200ms linear;
                            transition: all 200ms linear;
                            }

                            input#images{display: none;}

                            #multiple-file-preview{border-top: 1px solid rgba(0, 0, 0, 0.11); margin-top: 10px; padding: 10px;}

                            #sortable {
                            list-style-type: none;
                            margin: 0;
                            padding: 0;
                            /* min-height: 300px; */
                            }

                            #sortable li {
                                margin: 3px 3px 3px 0;
                                float: left;
                                width: 100px;
                                text-align: center;
                                position: relative;
                                background-color: #FFFFFF;
                            }

                            #sortable li, #sortable li img
                            {
                                -webkit-border-radius: 4px;
                                -moz-border-radius: 4px;
                                border-radius: 4px;
                            }
                            
                        </style>


                        <div class="block">
                            <label class="button" for="images">Upload Images</label>
                            <input type="file" name="photo[]" id="images" multiple="multiple"/>
                            <div id="multiple-file-preview">
                                <ul id="sortable">
                                    
                                <div class="clear-both"></div>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mt-2">
                        <h3>Previously uploaded images with sorting </h3>
                        <ul>

                        {{-- @forelse ($galleries as $glry)
                            <li class="edit-single-gallery">
                                <input class="inputId" type="hidden" name="previous_image[{{$glry->id}}]" value="{{$glry->id}}" />
                                <img width="100%" height="200px" src="{{asset('/storage/images/sliders/' . $glry->image)}}" />
                                <div class="cross">X</div>
                            </li>
                        @empty                                        
                        @endforelse --}}
                        </ul>
                    </div>

                    <div class="col-md-12">
                        <div class="pull-right">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>

                <form method="post" action="{{route('gallery.savePosition')}}" enctype="multipart/form-data">
                    @csrf
                    <h3>Previously uploaded images with sorting </h3>
                    <ul id="mySortable">
                        @php $count = 1; @endphp
                        @foreach($galleries as $gallery)
                        <li class="edit-single-gallery" draggable="true" style="display: inline-block;verticle-align:top;">
                            <label  for="pro_pic">
                            <img id="up_44" width="200px" height="200px" style="cursor: pointer; border: 2px solid #3C8DBC; padding: 4px;" src="{{ asset('/storage/images/sliders/'. $gallery -> image)}}"  alt=""></label>
                            <input class="inputId" custom_val="{{$gallery->id}}" type="hidden" name="position[{{$gallery->id}}]" value="{{$count++}}">
                            <div class="cross">X</div>
                        </li>
                        @endforeach
                        
                    </ul>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger pull-right">Submit</button>
                    </div>

                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        
    </div>

</section>

@endsection

@push('page-scripts')
<script defer src="{{asset('admin_assets/assets/js/gallery.js')}}"></script>
<script defer src="{{asset('admin_assets/assets/js/ajax.js')}}"></script>
<script defer src="{{asset('admin_assets/assets/js/jquery-ui.js')}}"></script>

@endpush