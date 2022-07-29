@extends('admin.layout.index')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" action={{route('admin.news-list')}} method="post">
                @csrf
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news_cate as $ct)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $ct->id}} </td>
                        <td>{{ $ct->title}} </td>
                        <td>{{ $ct->content}} </td>
                        <td>{{ $ct->image}} </td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/news/delete/{{$ct->id}} "> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/news/edit/{{$ct->id}}">Edit</a></td>
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