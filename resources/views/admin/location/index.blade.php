@extends('admin.layouts.layout')
@section('title', 'List locations')

@push('page-css')
<link rel="stylesheet" href="{{asset('admin_assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" />
@endpush

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">

                <div class="box-header with-border">

                    <div class="box-header pull-left">
                        <!-- <span class="box-title">All Roles</span> -->
                    </div>

                    @if(App\Model\Permission::roleHasSpecificPermission('location.create'))

                    <div class="box-tools pull-right">
                        <a href="{{route('location.create')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-plus"></i> <span class="text-capitalize">Add Location</span></a>
                    </div>
                    @endif
                </div>

                <!-- /.box-header -->
                <div class="box-body box-min-height">

                    <table class="table table-bordered table-hover table-striped list-data">
                        <thead class="bg-purple text-white">
                            <tr>
                                <th class="serial">#</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $count = 0 @endphp
                            @foreach($datas as $data)

                            <tr>
                                <td>{{ $count + $datas->firstItem() }}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->created_at}}</td>

                                <td>

                                    @if(App\Model\Permission::roleHasSpecificPermission('location.show'))

                                    <a href="{{route('location.show', $data->id)}}" class="btn btn-xs btn-success action-view" title="View"><i class="fa fa-eye"></i></a>

                                    @endif

                                    @if(App\Model\Permission::roleHasSpecificPermission('location.edit'))

                                    <a href="{{route('location.edit', $data->id)}}" class="btn btn-xs btn-primary action-pencil" title="Edit"><i class="fa fa-pencil"></i></a>

                                    @endif

                                    @if(App\Model\Permission::roleHasSpecificPermission('location.destroy'))

                                    <form action="{{route('location.destroy', $data->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    @endif
                                </td>
                            </tr>

                            @php $count++ @endphp

                            @endforeach

                        </tbody>

                    </table>
                    <div class="col-md-12">
                        <div class="pull-right">
                            {{$datas->links()}}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection

@push('page-scripts')
<script src="{{asset('admin_assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endpush