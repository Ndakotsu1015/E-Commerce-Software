@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Color</h1>
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
                                            <label for="name">Color Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $getRecord->name) }}" id="mame" required
                                                placeholder="Brand Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="code">Code</label>
                                            <input type="color" name="code" class="form-control"
                                                value="{{ old('code', $getRecord->code) }}" id="code" required
                                                placeholder="Code">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option {{ $getRecord->status == 'Active' ? 'selected' : '' }}
                                                    value="Active">Active</option>
                                                <option {{ $getRecord->status == 'Inactive' ? 'selected' : '' }}
                                                    value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="admin/brand/list">
                                            <button type="submit" class="btn btn-warning">Back</button>
                                        </a>
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
