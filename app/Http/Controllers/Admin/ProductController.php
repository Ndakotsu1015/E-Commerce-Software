<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\Product;
use Str;
use Auth;


class ProductController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Product::getProduct();
        $data['header_title'] = 'Product';
        return view('admin.product.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Product';
        return view('admin.product.add', $data);
    }
    public function insert(Request $request)
    {
        $title = trim($request->title);

        $product = new Product;
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        ;
        $product->save();
        $slug = Str::slug($title, "_");

        $checkSlug = Product::checkSlug($slug);

        if (empty ($checkSlug)) {
            $product->slug = $slug;
            $product->save();
        } else {
            $new_slug = $slug . '_' . $product->id;
            $product->slug = $new_slug;
            $product->save();
        }
        return redirect('admin/product/edit/' . $product->id);

    }

    public function edit($product_id)
    {
        $product = Product::getSingle($product_id);

        if (!empty ($product)) {

            $data['getCategory'] = Category::getCategoryActive();
            $data['getBrand'] = Brand::getBrandActive();
            $data['getColor'] = Color::getColorActive();
            $data['product'] = $product;

            $data['getSubCategory'] = SubCategory::getSubCategoryRecord($product->category_id);

            $data['header_title'] = 'Edit Product';
            return view('admin.product.edit', $data);
        }
    }

    public function update($product_id, Request $request)
    {
        $product = Product::getSingle($product_id);

        if (!empty ($product)) {

            $product->title = trim($request->title);
            $product->sku = trim($request->sku);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->status = trim($request->status);
            $product->new_price = trim($request->new_price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->additional_information = trim($request->additional_information);
            $product->shipping_returns = trim($request->shipping_returns);
            $product->save();

            ProductColor::DeleteRecord($product->id);

            if (!empty ($request->color_id)) {

                foreach ($request->color_id as $color_id) {

                    $color = new ProductColor;

                    $color->color_id = $color_id;

                    $color->product_id = $product->id;

                    $color->save();


                }
            }

            ProductSize::DeleteRecord($product->id);
            if (!empty ($request->size)) {

                foreach ($request->size as $size) {

                    if (!empty ($size['name'])) {
                        $saveSize = new ProductSize;

                        $saveSize->name = $size['name'];

                        $saveSize->price = !empty ($size['price']) ? $size['price'] : 0;

                        $saveSize->product_id = $product->id;

                        $saveSize->save();

                    }
                }
            }

            if (!empty ($request->file('image'))) {

                foreach ($request->file('image') as $value) {

                    if ($value->isValid()) {
                        $ext = $value->getClientOriginalExtension();
                        $randomStr = $product->id . Str::random(20);
                        $filename = strtolower($randomStr) . '.' . $ext;
                        $value->move('uploads/products/', $filename);

                        $imageuplad = new ProductImage;
                        $imageuplad->image_name = $filename;
                        $imageuplad->image_extension = $ext;
                        $imageuplad->product_id = $product->id;
                        $imageuplad->save();

                    }
                }
            }

            return redirect()->back()->with('success', 'Product Successfully Updated!');

        } else {
            abort(404);
        }
    }
    public function delete($id)
    {
        $product = Product::getSingle($id);
        $product->is_delete = 'deleted';
        $product->save();

        return redirect()->back()->with('success', 'Product Successfully Deleted!');

    }


    public function imageDelete($id)
    {

        $image = ProductImage::getSingle($id);
        if (!empty ($image->getImages())) {
            unlink('uploads/products/' . $image->image_name);
        }
        $image->delete();

        return redirect()->back()->with('success', 'Product Image Successfully Deleted!');
    }
    public function ProductImageSortable(Request $request)
    {
        if (!empty ($request->photo_id)) {
            $i = 1;
            foreach ($request->photo_id as $photo_id) {
                $image = ProductImage::getSingle($photo_id);
                $image->order_by = $i;
                $image->save();

                $i++;
            }
        }

        $json['success'] = true;
        return response()->json($json);
    }
}