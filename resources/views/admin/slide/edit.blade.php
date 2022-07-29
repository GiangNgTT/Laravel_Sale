@extends('admin.layout.index')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
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
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" placeholder="Please Enter link"  value={{ $slide->link }}/>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" name="image" placeholder="Please Enter image"  value={{ $slide->image }}/>
                    </div>
                    <button type="submit" class="btn btn-default">Slide Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection