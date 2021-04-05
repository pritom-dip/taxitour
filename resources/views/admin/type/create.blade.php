@extends('admin.layouts.layout')
@section('title', 'Create Price Type')

@section('content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="box-header pull-left">
                <span class="box-title">Create Price Type</span>
            </div>

            <div class="box-tools pull-right">
                <a href="{{route('type.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                <form class="form-row" method="POST" action="{{route('type.store')}}">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name<span class="control-label"></span></label>
                            <input type="text" name="name" placeholder="Name" class="form-control" required />
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
@endpush