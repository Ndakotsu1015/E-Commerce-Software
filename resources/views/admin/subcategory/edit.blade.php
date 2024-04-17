@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Sub Category</h1>
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
                                            <label for="categoryname">Category Name <span
                                                    style="color: red">*</span></label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($getCategory as $value)
                                                    <option {{ $value->id == $getRecord->category_id ? 'selected' : '' }}
                                                        value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Sub Category Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $getRecord->name) }}" id="mame" required
                                                placeholder="Sub Category Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ old('slug', $getRecord->slug) }}" id="slug" required
                                                placeholder="Category slug">
                                            <div style="color:red">{{ $errors->first('slug') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option {{ $getRecord->status == 'Active' ? 'selected' : '' }}
                                                    value="Active">Active</option>
                                                <option {{ $getRecord->status == 'Inactive' ? 'selected' : '' }}
                                                    value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row p-3">
                                    <div class="form-group col-md-6">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title', $getRecord->meta_title) }}" id="meta_title" required
                                            placeholder="Meta Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_keywords">Meta Keywords</label>
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
                                <hr>
                                <div class="card-footer">
                                    <a href="{{ url('admin/sub_category/list') }}"
                                        class="btn btn-outline-danger">Previous</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

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
