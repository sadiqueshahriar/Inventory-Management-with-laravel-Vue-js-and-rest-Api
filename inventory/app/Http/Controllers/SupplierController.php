<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Image;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required'
        ]);
        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(240, 300);
            $upload_path = 'backend/supplier/supplier';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->photo = $image_url;
            $supplier->save();
        } else {
            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;
        $data['phone'] = $request->phone;
        $image = $request->newPhoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($image)->resize(240, 300);
            $upload_path = 'backend/supplier/supplier';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('suppliers')->where('id', $id)->first();
                $image_path = $img->photo;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                // $done = unlink($image_path);
                $user = DB::table('suppliers')->where('id', $id)->update($data);
            }
        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('suppliers')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $image = $supplier->photo;
        if ($image) {
            unlink($image);
            Supplier::find($id)->delete();
        } else {
            Supplier::find($id)->delete();
        }
    }
}
