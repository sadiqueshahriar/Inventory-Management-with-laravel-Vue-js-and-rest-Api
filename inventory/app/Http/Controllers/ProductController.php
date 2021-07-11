<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('suppliers', 'products.supplier_id', 'suppliers.id')
            ->select('categories.category_name', 'suppliers.name', 'products.*')
            ->orderBy('suppliers.id', 'DESC')
            ->get();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'selling_price' => 'required',
            'product_quantity' => 'required',
            'buying_price' => 'required',

        ]);
        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($request->image)->resize(240, 300);
            $upload_path = 'backend/product/product';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $Product = new Product;
            $Product->product_name = $request->product_name;
            $Product->product_code = $request->product_code;
            $Product->category_id = $request->category_id;
            $Product->supplier_id = $request->supplier_id;
            $Product->buying_date = $request->buying_date;
            $Product->selling_price = $request->selling_price;
            $Product->product_quantity = $request->product_quantity;
            $Product->buying_price = $request->buying_price;
            $Product->root = $request->root;
            $Product->image = $image_url;
            $Product->save();
        } else {
            $Product = new Product;
            $Product->product_name = $request->product_name;
            $Product->product_code = $request->product_code;
            $Product->category_id = $request->category_id;
            $Product->supplier_id = $request->supplier_id;
            $Product->buying_date = $request->buying_date;
            $Product->selling_price = $request->selling_price;
            $Product->product_quantity = $request->product_quantity;
            $Product->buying_price = $request->buying_price;
            $Product->root = $request->root;
            $Product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;
        $image = $request->newPhoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($image)->resize(240, 300);
            $upload_path = 'backend/product/product';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                $user = DB::table('products')->where('id', $id)->update($data);
            }
        } else {
            $oldphoto = $request->image;
            $data['image'] = $oldphoto;
            $user = DB::table('products')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
        $image = $Product->image;
        if ($image) {
            unlink($image);
            Product::find($id)->delete();
        } else {
            Product::find($id)->delete();
        }
    }
}
