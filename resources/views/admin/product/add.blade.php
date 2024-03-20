@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Product</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-primary">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Product Title <span style="color:red">*</span></label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                value="{{ old('title') }}" required placeholder="Title">
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@section('script')
@endsection
