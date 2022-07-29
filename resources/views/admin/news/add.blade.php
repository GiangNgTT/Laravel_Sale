@extends('admin.layout.index')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                {{ $err }}<br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <form action="{{route('admin.postNewsAdd')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="title" placeholder="Please Enter title" />
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <input class="form-control" name="content" placeholder="Please Enter Category content" />
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <img src="/source/image/product/" class="img-fluid rounded-start" alt="..." />
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-default">News Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection
