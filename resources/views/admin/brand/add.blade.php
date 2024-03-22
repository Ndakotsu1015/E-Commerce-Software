@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Brand</h1>
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
                                            <label for="name">Brand Name <span style="color:red">*</span></label>
                                            <input type="text" name="name" class="form-control" id="mame"
                                                value="{{ old('name') }}" required placeholder="Brand Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="slug">Slug <span style="color:red">*</span></label>
                                            <input type="text" name="slug" class="form-control" id="slug"
                                                value="{{ old('slug') }}" required placeholder="Slug Url">
                                            <div style="color:red">{{ $errors->first('slug') }}</div>
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

                                <div class="row p-3">
                                    <div class="form-group col-md-6">
                                        <label for="name">Meta Title <span style="color:red">*</span></label>
                                        <input type="text" name="meta_title" class="form-control" id="mame"
                                            value="{{ old('meta_title') }}" required placeholder="Meta Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_keyword">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"
                                            value="{{ old('meta_keyword') }}" placeholder="Meta Keywords">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" placeholder="Meta Description">
                                        {{ old('meta_description') }}</textarea>
                                    </div>


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
