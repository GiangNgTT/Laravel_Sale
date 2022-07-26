@extends('admin.layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Category
            <small>List</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example" action={{ route('admin.cate-list')}} method='post'>
        @csrf
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Name</th>
                <th>Category Parent</th>
                <th>Status</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr class="odd gradeX" align="center">
                <td>1</td>
                <td>Tin Tức</td>
                <td>None</td>
                <td>Hiện</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection 