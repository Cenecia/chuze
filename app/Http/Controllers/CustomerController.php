<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
  
    public function __construct() {
        $this->middleware('auth');
    }
    //
    public function index() {
        $customers = Customer::all();
        return view('customer/index', ['customers' => $customers]);
    }
  
    public function view($id) {
        $customer = Customer::find($id);
        return view('customer/view', ['customer' => $customer]);
    }
  
    public function update(Request $request, $id) {
        $method = $request->method();

        if ($request->isMethod('post')) {
            //
            $name = $request->input('name');
            Customer::where('id', $id)
            ->update(['name' => $name]);
        }
        return redirect('customer/');
    }
  
    public function add(Request $request) {
        if ($request->isMethod('post')) {
              $name = $request->input('name');
              $now = Date('Y-m-d h:m:s');
              //var_dump($now);die;
              Customer::insert(
                ['name' => $name, 'created_at' => $now, 'updated_at' => $now]
              );
        }
        return redirect('customer/');
    }
}
