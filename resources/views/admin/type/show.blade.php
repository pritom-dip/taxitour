@extends('admin.layouts.layout')
@section('title', 'Show Price Type')

@section('content')

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Price Type View</h3>
            <div class="box-tools pull-right">
                <a href="{{route('type.index')}}" class="btn btn-xs btn-success pull-left text-white router-link-active" title="Add New"><i class="fa fa-arrow-left"></i> <span>Back</span></a>
            </div>
        </div>
        <div class="box-body box-min-height">
            <table class="table table-bordered table-hover table-striped">
                <tbody>
                    
                    <tr>
                        <th class="text-capitalize">Name</th>
                        <td><span>{{$type->name}}</span></td>
                    </tr>
                                        
                </tbody>
            </table>
        </div>
    </div>
    <!---->
</section>


@endsection