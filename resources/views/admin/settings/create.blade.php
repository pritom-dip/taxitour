@extends('admin.layouts.layout')
@section('title', 'Create settings')

@section('content')
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="box-header pull-left">
                <span class="box-title">Create Settings</span>
            </div>

            <div class="box-tools pull-right">
                <a href="{{route('settings.index')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-arrow-left"></i> <span class="text-capitalize">back</span></a>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">

                <form class="form-row" method="POST" action="{{route('settings.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" name="heading" placeholder="Name" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" placeholder="Description" class="form-control" required />
                        </div>  
                    </div>

                    <div class="col-md-6 mb-5">
                        <label>Logo : </label>
                        <label  for="pro_pic">
                            <img id="up_44" width="150px" height="150px" style="cursor: pointer; border: 2px solid #3C8DBC; padding: 4px;" src="{{ URL::to('/')}}/admin_assets/defult_image/gallery.png" width="150px" alt="">
                        </label>
                        <input name="site_logo" id="pro_pic" class="upload_image" code="up_44"  type="file" >
                    </div>

                    <div class="col-md-6 mb-5">
                        <label>Background : </label>
                        <label for="bg_pic">
                            <img id="up_45" width="150px" height="150px" style="cursor: pointer; border: 2px solid #3C8DBC; padding: 4px;" src="{{ URL::to('/')}}/admin_assets/defult_image/gallery.png" width="150px" alt="">
                        </label>
                        <input name="bg_image" id="bg_image" class="upload_image" code="up_45"  type="file" >
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