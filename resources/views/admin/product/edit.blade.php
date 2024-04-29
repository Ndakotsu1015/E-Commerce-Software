@extends('admin.layout.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper p-3">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">

                        <h1>Edit Product</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        @include('admin.layout._message')

                        <div class="card card-primary">
                            <form action="" method="post" enctype="multipart/form-data">
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
                                            <select name="category_id" id="ChangeCategory" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($getCategory as $category)
                                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="categoryname">Sub category <span style="color: red">*</span></label>
                                            <select name="sub_category_id" class="form-control" id="getSubCategory"
                                                required>
                                                <option value="">Select Sub Category</option>
                                                @foreach ($getSubCategory as $SubCategory)
                                                    <option
                                                        {{ $product->sub_category_id == $SubCategory->id ? 'selected' : '' }}
                                                        value="{{ $SubCategory->id }}">{{ $SubCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="categoryname">Brand <span style="color: red">*</span></label>
                                            <select name="brand_id" class="form-control" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($getBrand as $brand)
                                                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value=""> Select Status</option>
                                                <option {{ $product->status == 'Active' ? 'selected' : '' }}
                                                    value="Active">
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
                                                        @php
                                                            $checked = '';
                                                        @endphp
                                                        @foreach ($product->getColor as $pcolor)
                                                            @if ($pcolor->color_id == $color->id)
                                                                @php
                                                                    $checked = 'checked';
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        <label><input {{ $checked }} type="checkbox" name="color_id[]"
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
                                                value="{{ old('new_price', !empty($product->new_price) ? $product->new_price : '') }}"
                                                required placeholder="Price">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="old_price">Old Price (₦)<span style="color:red">*</span></label>
                                            <input type="number" name="old_price" class="form-control" id="old_price"
                                                value="{{ old('old_price', !empty($product->old_price) ? $product->old_price : '') }}"
                                                required placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Size <span style="color:red">*</span></label>
                                            <div>
                                                <table class="table table-striped">
                                                    <caption>Add Product Size(s)</caption>
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price(₦)</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="AppendSize">

                                                        {{-- @if (count($product->getSize) == 0)
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="size[0][name]"
                                                                        placeholder="Name" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="size[0][price]"
                                                                        placeholder="Price" class="form-control">
                                                                </td>
                                                                <td style="width: 200px;">
                                                                    <button type="button" id="0"
                                                                        class="btn btn-danger DeletSize"> Delete


                                                                </td>
                                                            </tr>
                                                        @endif --}}
                                                        @php
                                                            $i_s = 1;
                                                        @endphp
                                                        @foreach ($product->getSize as $size)
                                                            <tr id="DeleteSize{{ $i_s }}">
                                                                <td>
                                                                    <input type="text"
                                                                        name="size[{{ $i_s }}][name]"
                                                                        value="{{ $size->name }}" placeholder="Name"
                                                                        class="form-control"> {{ $size->name }}
                                                                </td>
                                                                <td>
                                                                    <input type="text" value="{{ $size->price }}"
                                                                        name="size[{{ $i_s }}}][price]"
                                                                        placeholder="Price" class="form-control">
                                                                </td>
                                                                <td style="width: 200px;">
                                                                    <button type="button" id="{{ $i_s }}"
                                                                        class="btn btn-danger DeletSize"> Delete
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $i_s++;
                                                            @endphp
                                                        @endforeach



                                                    </tbody>
                                                </table>

                                                <table class="table table">
                                                    <tr>
                                                        <td>
                                                            {{-- <input type="text" name="size[0][name]"
                                                                placeholder="Name" class="form-control"> --}}
                                                        </td>
                                                        <td>
                                                            {{-- <input type="text" name="size[0][price]"
                                                                placeholder="Price" class="form-control"> --}}
                                                        </td>
                                                        <td style="width: 200px;">
                                                            <button type="button" id=""
                                                                class="btn btn-primary AddSize"> Add


                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Image Upload<span style="color: red">*</span></label>
                                            <input type="file" multiple accept="image/*" name="image[]"
                                                class="form-control" style="padding: 5px;">
                                        </div>
                                    </div>
                                    @if (!empty($product->getImage->count()))
                                        <div class="row p-3" id="sortable">
                                            @foreach ($product->getImage as $image)
                                                @if (!@empty($image->getImages()))
                                                    <div class="col-md-1 sortable_image" style="text-align: center"
                                                        id="{{ $image->id }}">
                                                        <img src="{{ $image->getImages() }}" alt=""
                                                            style="width: 100%; height:100px;">
                                                        <a onclick="return confirm('Are you sure you want to delete?');"
                                                            href="{{ url('admin/product/image_delete/' . $image->id) }}"
                                                            class="btn btn-danger btn-sm"
                                                            style="text-align: center; margin-top:10px;">Remove</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    <hr />
                                    <div class="row p-3">
                                        <div class="form-group col-md-6">
                                            <label for="name">Short Description <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-controle editor" name="short_description" placeholder="Short Description">
                                                {{ $product->short_description }}
                                            </textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Description<span style="color: red">*</span></label>
                                            <textarea class="form-control editor" name="description" placeholder="Description">
                                                {{ $product->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="form-group col-md-6">
                                        <label for="name">Additional Information <span
                                                style="color: red">*</span></label>
                                        <textarea class="form-controle editor" name="additional_information" placeholder="Additional Information">
                                                {{ $product->additional_information }}
                                            </textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Shipping & Returns <span style="color: red">*</span></label>
                                        <textarea class="form-control editor" name="shipping_returns" placeholder="Shipping & Returns">
                                                {{ $product->shipping_returns }}
                                            </textarea>
                                    </div>
                                </div>

                                <hr>
                                <div class="card-footer">
                                    <a href="{{ url('admin/product/list') }}" class="btn btn-outline-danger">Previous</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
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
    <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('sortable/jquery-ui.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);

                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/product_image_sortable') }}",
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {


                        },
                        error: function(data) {

                        }
                    });
                }
            });
        });
        $('.editor').summernote({
            height: 200

        });

        var i = {{ $i_s ?? 1 }};
        $('body').on('click', '.AddSize', function() {
            var html = '<tr id="DeleteSize' + i + '">' +
                '<td>' +
                '<input type="text" name="size[' + i + '][name]" placeholder="Name" class="form-control">' +
                '</td>' +
                '<td>' +
                '<input type="text" name="size[' + i + '][price]" placeholder="Price" class="form-control">' +
                '</td>' +
                '<td>' +
                '<button type="button" id="' + i + '" class="btn btn-danger DeleteSize">Delete</button>' +
                '</td>' +
                '</tr>';
            i++;
            $('#AppendSize').append(html);
        });

        $('body').on('click', '.DeleteSize', function() {
            var id = $(this).attr('id');
            $('#DeleteSize' + id).remove();
        });


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
