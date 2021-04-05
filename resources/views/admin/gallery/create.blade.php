@extends('admin.layouts.layout')
@section('title', 'Create Gallery')

@section('content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="box-header pull-left">
                <span class="box-title">Create Gallery</span>
            </div>

            <div class="box-tools pull-right">
                <a href="{{route('gallery.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                <form class="form-row" method="POST" action="{{route('gallery.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Taxi/Tour Name<span class="control-label"></span></label>
                            <select name="tour_id" class="form-control" required>
                                <option value="">Please select</option>
                                @foreach ($tours as $tour)
                                    <option value="{{$tour->id}}">{{$tour->name}}</option>
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
                            min-height: 300px;
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

                    <div class="col-md-12">
                        <div class="pull-right">
                            <button class="btn btn-success">Submit</button>
                        </div>
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
<script defer src="{{asset('admin_assets/assets/js/jquery.repeater.min.js')}}"></script>
<script defer src="{{asset('admin_assets/assets/js/bootstrap-datepicker.min.js')}}"></script>
<script defer src="{{asset('admin_assets/assets/js/gallery.js')}}"></script>
@endpush