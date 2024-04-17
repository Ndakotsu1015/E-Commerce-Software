@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Category</h1>
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
                                            <label for="name">Category Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $getRecord->name) }}" id="mame" required
                                                placeholder="Category Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ old('slug', $getRecord->slug) }}" id="slug" required
                                                placeholder="Category slug">
                                            <div style="color:red">{{ $errors->first('slug') }}</div>
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
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control"
                                                value="{{ old('name', $getRecord->meta_title) }}" id="meta_title" required
                                                placeholder="Meta Title">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="meta_keywords">Name</label>
                                            <input type="text" name="meta_keywords" class="form-control"
                                                value="{{ old('meta_keywords', $getRecord->slug) }}" id="meta_keywords"
                                                placeholder="Meta Keywords">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" placeholder="Meta Description">
                                            {{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                        </div>
                                    </div>


                                </div> <br>
                                <hr>

                                <div class="card-footer">
                                    <a href="{{ url('admin/category/list') }}" class="btn btn-outline-danger">Previous</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </a>
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
