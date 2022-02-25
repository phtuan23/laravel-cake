<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CreateRequest;
use App\Http\Requests\Customer\UpdateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $customers = Customer::orderBy('id','DESC')->paginate(6);
        return view('admin.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if($request->has('image')){
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('upload'),$filename);
            $request->merge(['avatar'=> $filename]);
            $customer = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'avatar' => $request->avatar
            ];
            if(Customer::create($customer)){
                return redirect()->route('customer.index')->with('success','Created successfully');
            }else{
                return redirect()->back()->with('error','Can not create. Please try again!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        $avatar = $customer->avatar;
        if($request->has('image')){
            $file = $request->image;
            $avatar = $file->getClientOriginalName();
            $file->move(public_path('upload'),$avatar);
            $request->merge(['avatar' => $avatar]);
        }
        $cus = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'avatar' => $avatar
        ];
        if($customer->update($cus)){
            return redirect()->route('customer.index')->with('success','Updated successfully');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if($customer->delete()){
            return redirect()->route('customer.index')->with('success','Deleted Successfully');
        }
    }

    public function trash(Request $request)
    {
        if ($request->search_string) {
            $search_string = $request->search_string;
            $trashs = Customer::where('name', 'LIKE', '%' . $search_string . '%')->paginate(6);
            return view('admin.customer.trash', compact('trashs'));
        }
        $trashs = Customer::onlyTrashed()->orderBy('id','DESC')->paginate(6);
        return view('admin.customer.trash',compact('trashs'));
    }

    public function restoreTrash($id)
    {
        $trash = Customer::withTrashed()->find($id);
        if($trash->restore()){
            return redirect()->back()->with('success','Restored success!');
        };
    }

    public function forceDelete($id)
    {
        $customer = Customer::withTrashed()->find($id);
        if($customer->forceDelete()){
            return redirect()->back()->with('success','Deleted success!');
        }
    }
}
