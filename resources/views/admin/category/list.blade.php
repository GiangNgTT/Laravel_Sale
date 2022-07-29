@extends('admin.layout.index');
@section('content');

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" action={{route('admin.cate-list')}} method="post">
                @csrf
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cate as $ct)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $ct->id}} </td>
                        <td>{{ $ct->name}} </td>
                        <td>{{ $ct->description}} </td>
                        <td>{{ $ct->image}} </td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/category/delete/{{$ct->id}} "> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/category/edit/{{$ct->id}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection