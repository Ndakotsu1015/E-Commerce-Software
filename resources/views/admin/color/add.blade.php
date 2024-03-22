@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Color</h1>
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
                                        <div class="form-group col-md-6">
                                            <label for="name">Color Name <span style="color:red">*</span></label>
                                            <input type="text" name="name" class="form-control" id="mame"
                                                value="{{ old('name') }}" required placeholder="Color Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="code">Color Code <span style="color:red">*</span></label>
                                            <input type="color" name="code" class="form-control" id="code"
                                                value="{{ old('code') }}" required placeholder="Color Code">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="">Select Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
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
