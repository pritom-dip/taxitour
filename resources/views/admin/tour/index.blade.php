@extends('admin.layouts.layout')
@section('title', 'List Dominion')

@push('page-css')
    <link rel="stylesheet" href="{{asset('admin_assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" />
@endpush

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">

                <div class="box-header with-border">

	                <div class="box-tools pull-right">
	                    <a href="{{route('tour.create')}}" class="btn btn-xs btn-success pull-left text-white" title="Add New"><i class="fa fa-plus"></i> <span class="text-capitalize">Add Taxi/Tour</span></a>
	                </div>
	            </div>

                <!-- /.box-header -->
                <div class="box-body box-min-height">

                    @if(Session::has('message'))
                        <p class="alert alert-success m-20">{{ Session::get('message') }}</p>
                    @endif
                        
                    <table class="table table-bordered table-hover table-striped list-data">
                        <thead class="bg-purple text-white">
                            <tr>
                                <th class="serial">#</th>
                                <th>Tour/Taxi Name</th>
                                <th>Price</th>
                                <th>Capacity</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $count = 0 @endphp
                        	@foreach($datas as $item)

                            <tr>
                                <td>{{ $count + $datas->firstItem() }}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->capacity}}</td>

                                <td>

                                	<a href="{{route('dominion.show', $item->id)}}" class="btn btn-xs btn-success action-view" title="View"><i class="fa fa-eye"></i></a>

                                	<a href="{{route('dominion.edit', $item->id)}}" class="btn btn-xs btn-primary action-pencil" title="Edit"><i class="fa fa-pencil"></i></a>

                                	<form action="{{route('dominion.destroy', $item->id)}}" method="POST">
									    @csrf
									    @method('DELETE')
									    <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">
									    	<i class="fa fa-trash"></i>
									    </button>
									</form>
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