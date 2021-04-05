@extends('admin.layouts.layout')
@section('title', 'Create Taxi/Tour')

@section('content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="box-header pull-left">
                <span class="box-title">Create Taxi/Tour</span>
            </div>

            <div class="box-tools pull-right">
                <a href="{{route('tour.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                <form class="form-row" method="POST" action="{{route('tour.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type<span class="control-label"></span></label>
                            <select id="tourType" id="tour_type" required name="tour[tour_type]" class="form-control">
                                <option value="">Please Select...</option>
                                <option value="taxi">Taxi</option>
                                <option value="tour">Tour</option>
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name<span class="control-label"></span></label>
                            <input type="text" name="tour[name]" placeholder="Name" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Short Description</label>
                            <input type="text" name="tour[short_desc]" placeholder="Short Description" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price Type</label>
                            <select name="tour[type_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="ck-editor" class="form-control" name="tour[description]"></textarea>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Destinations</label>
                            <select name="tour[destination_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($destinations as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Locations</label>
                            <select name="tour[location_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($locations as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categories</label>
                            <select name="tour[category_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($categories as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4 tourNaming">
                        <div class="form-group">
                            <label>Activities</label>
                            <select name="tour[activity_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($activities as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Durations</label>
                            <select name="tour[duration_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($durations as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4 tourNaming">
                        <div class="form-group">
                            <label>Services</label>
                            <select name="tour[service_id]" class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($services as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Destination A<span class="control-label"></span></label>
                            <input type="text" name="tour[destination_a]" placeholder="Destination A" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Destination B<span class="control-label"></span></label>
                            <input type="text" name="tour[destination_b]" placeholder="Destination B" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Minimum Capacity<span class="control-label"></span></label>
                            <input type="text" name="tour[min_capacity]" placeholder="Minimum capacity" required class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4 tourNaming">
                        <div class="form-group">
                            <label>Max Capacity<span class="control-label"></span></label>
                            <input type="text" name="tour[max_capacity]" placeholder="Maximum capacity" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="tour[location]" placeholder="Location" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Price<span class="control-label"></span></label>
                            <input type="text" name="tour[price]" placeholder="Price" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="text" name="tour[rating]" placeholder="Rating" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" name="tour[duration]" placeholder="Duration" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tour Start Date</label>
                            <input type="text" name="tour[start_date]" placeholder="Pick Up Date" class="datepicker form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tour End Date</label>
                            <input type="text" name="tour[end_date]" placeholder="End Date" class="datepicker form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Departure Time</label>
                            <input type="text" name="tour[departure_time]" placeholder="Departure Time" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Num Of Persons</label>
                            <input type="text" name="tour[num_of_persons]" placeholder="Num Of Persons" class="form-control" />
                        </div>  
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Featured Image<span class="control-label"></span></label>
                            <input type="file" name="tour[featured_img]" class="form-control" required />
                        </div>  
                    </div>
                    
                    <div class="clearfix"></div>

                    {{-- Rents --}}
                    <div class="repeater pl-3">
                        <div data-repeater-list="rent_section">
                            <div data-repeater-item>
                                <div class="inner-repeater">
                                    <div class="rent-wrapper" data-repeater-list="rent_section">
                                        <div data-repeater-item>
                                            <div class="row mt-3">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputRole">Rent Name</label>
                                                        <input type="text" name="rent" placeholder="Rent" class="form-control form-control-sm" id="inputRole" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputRole">Person</label>
                                                        <input type="text" name="person" placeholder="Person" class="form-control form-control-sm" id="inputRole" />
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="inputRole">Price Type</label>
                                                        <select name="type_id" class="form-control">
                                                            <option value="">Please Select</option>
                                                            @foreach ($types as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="inputRole">Price</label>
                                                        <input type="number" name="price" placeholder="Price" class="form-control form-control-sm" id="inputRole" />
                                                    </div>
                                                </div>

                                                <div class="col-md-1 pt-5 pl-0" style="padding-top: 26px;">
                                                    <div data-repeater-delete class="btn btn-sm btn-success btn-danger">Delete</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-repeater-create type="button" style="margin-top:26px;" class="btn btn-success btn-sm float-right my-3">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Facilities --}}
                    <div class="repeater pl-3">
                        <div data-repeater-list="facilities_section">
                            <div data-repeater-item>
                                <div class="inner-repeater">
                                    <div style="width: 40%; float:left" data-repeater-list="facilities_section">
                                        <div data-repeater-item>
                                            <div class="row mt-3">
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <label for="inputRole">Facilities Name</label>
                                                        <input type="text" name="facility" placeholder="Facility Name" class="form-control form-control-sm" id="inputRole" />
                                                    </div>
                                                </div>

                                                <div class="col-md-1 pt-5 pl-0" style="padding-top: 26px;">
                                                    <div data-repeater-delete class="btn btn-sm btn-success btn-danger">Delete</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button style="float: left;margin-left:56px; margin-top:26px;" data-repeater-create type="button" class="btn btn-success btn-sm float-right my-3">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>

                    {{-- Conditions --}}
                    <div class="repeater pl-3">
                        <div data-repeater-list="conditions_section">
                            <div data-repeater-item>
                                <div class="inner-repeater">
                                    <div style="width: 40%; float:left" data-repeater-list="conditions_section">
                                        <div data-repeater-item>
                                            <div class="row mt-3">
                                                <div class="col-md-11">
                                                    <div class="form-group">
                                                        <label for="inputRole">Conditions Name</label>
                                                        <input type="text" name="condition" placeholder="Condition name" class="form-control form-control-sm" id="inputRole" />
                                                    </div>
                                                </div>

                                                <div class="col-md-1 pt-5 pl-0" style="padding-top: 26px;">
                                                    <div data-repeater-delete class="btn btn-sm btn-success btn-danger">Delete</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button style="float: left;margin-left:56px; margin-top:26px;" data-repeater-create type="button" style="margin-top:26px;" class="btn btn-success btn-sm float-right my-3">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    

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
<script defer src="{{asset('admin_assets/assets/js/custom.js')}}"></script>
@endpush