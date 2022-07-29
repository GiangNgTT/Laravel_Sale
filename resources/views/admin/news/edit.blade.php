@extends('admin.layout.index')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($error->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{ route('admin.postNewsEdit', $news_cate->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="title" placeholder="Please Enter title"
                                value={{ $news_cate->title }} />
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <input class="form-control" name="content" placeholder="Please Enter Category content"
                                value={{ $news_cate->content }} />
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <img src="/source/image/product/" class="img-fluid rounded-start" alt="..." />
                            <input type="file" name="image" class="form-control" value={{ $news_cate->image }}>
                        </div>
                        <button type="submit" class="btn btn-default">Category Edit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection
