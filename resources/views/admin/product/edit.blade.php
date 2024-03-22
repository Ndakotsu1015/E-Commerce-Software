@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>EditProduct</h1>
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
                                        <div class="form-group col-md-4">
                                            <label for="title">Product Title <span style="color:red">*</span></label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                value="{{ old('title', $product->title) }}" required placeholder="Title">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="sku">Stock Keeping Unit <span
                                                    style="color:red">*</span></label>
                                            <input type="text" name="sku" class="form-control" id="sku"
                                                value="{{ old('sku', $product->sku) }}" required
                                                placeholder="Stock Keeping Unit">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="categoryname">Category<span style="color: red">*</span></label>
                                            <select name="category_id" id="ChangeCategory" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($getCategory as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="categoryname">Sub category <span style="color: red">*</span></label>
                                            <select name="subcategory_id" class="form-control" id="getSubCategory">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="categoryname">Brand <span style="color: red">*</span></label>
                                            <select name="brand_id" class="form-control">
                                                <option value="">Select Brand</option>
                                                @foreach ($getBrand as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value=""> Select Status</option>
                                                <option {{ $product->status == 'Active' ? 'selected' : '' }} value="Active">
                                                    Active</option>
                                                <option {{ $product->status == 'Inactive' ? 'selected' : '' }}
                                                    value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">


                                            <div class="form-group">
                                                <label>Color <span style="color:red">*</span></label>
                                                <div>
                                                    @foreach ($getColor as $color)
                                                        <label><input type="checkbox" name="color_id[]"
                                                                value="{{ $color->id }}"> {{ $color->name }}</label>
                                                    @endforeach
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="price">Price (₦)<span style="color:red">*</span></label>
                                            <input type="number" name="new_price" class="form-control" id="title"
                                                value="{{ old('new_price', $product->new_price) }}" required
                                                placeholder="Price">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="old_price">Old Price (₦)<span style="color:red">*</span></label>
                                            <input type="number" name="old_price" class="form-control" id="old_price"
                                                value="{{ old('old_price', $product->old_price) }}" required
                                                placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Size <span style="color:red">*</span></label>
                                            <div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price(₦)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary">Add</button>
                                                                <button type="button"
                                                                    class="btn btn-danger">Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>

                                                                <button type="button"
                                                                    class="btn btn-danger">Delete</button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <input type="text" name=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>

                                                                <button type="button"
                                                                    class="btn btn-danger">Delete</button>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>

                                    {{-- <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Short Description</label>
                                            <textarea class="form-control" name="short_description" placeholder="Short Description">
                                            {{ old('short_description', $getRecord->short_description) }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="row p-3">
                                        <div class="form-group col-md-3">
                                            <label for="name">Short Description <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" name="short_description" placeholder="Short Description">
                                            </textarea>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="name">Description <span style="color: red">*</span></label>
                                            <textarea class="form-control" name="description" placeholder="Description">
                                            </textarea>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="name">Additional Information <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" name="additional_information" placeholder="Additional Information">
                                            </textarea>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="name">Shipping & Returns <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" name="additional_information" placeholder="Shipping & Returns">
                                            </textarea>
                                        </div>
                                    </div>




                                    <hr>
                                    <div class="card-footer">
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
    <script type="text/javascript">
        $('body').delegate('#ChangeCategory', 'change', function(e) {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/get_sub_category') }}",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#getSubCategory').html(data.html);

                },
                error: function(data) {

                }
            });
        });
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('change', '#Changecategory', function(e) {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/get_sub_category') }}",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        // Assuming the response contains HTML in 'html' property
                        $('#getSubCategory').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if needed
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
@endsection
