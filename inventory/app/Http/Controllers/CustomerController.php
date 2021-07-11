<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Image;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Customer = Customer::all();
        return response()->json($Customer);
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
            'phone' => 'required'
        ]);
        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(240, 300);
            $upload_path = 'backend/customer/customer';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $Customer = new Customer;
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->address = $request->address;
            $Customer->phone = $request->phone;
            $Customer->photo = $image_url;
            $Customer->save();
        } else {

            $Customer = new Customer;
            $Customer->name = $request->name;
            $Customer->email = $request->email;
            $Customer->address = $request->address;
            $Customer->phone = $request->phone;
            $Customer->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Customer = Customer::find($id);
        return response()->json($Customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $image = $request->newPhoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . '.' . $ext;
            $img = Image::make($image)->resize(240, 300);
            $upload_path = 'backend/customer/customer';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = DB::table('customers')->where('id', $id)->first();
                $image_path = $img->photo;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $user = DB::table('customers')->where('id', $id)->update($data);
            }
        } else {
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('customers')->where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Customer = Customer::find($id);
        $image = $Customer->photo;
        if ($image) {
            unlink($image);
            Customer::find($id)->delete();
        } else {
            Customer::find($id)->delete();
        }
    }
}
