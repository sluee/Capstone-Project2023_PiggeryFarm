<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Customer/index',[
            'customers' => Customer::orderBy('id')->get(),

        ]);
    }


    public function search($searchKey){
        return inertia('Customer/index', [
            'customers' => Customer::where('name', 'like' , "%$searchKey%")->orWhere('address', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Customer/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|max:11',

        ]);

        Customer::create($fields);

        return redirect('/customers')->with('message','Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */


    public function show(Customer $customer)
    {
        $customer->load('sales') // Load all sale items for this customer
        ->when(HttpRequest::input('search'), function ($query, $search) {
            $query->where('created_at', 'like', '%' . $search . '%')
                ->orWhere('pen_no', 'like', '%' . $search . '%')
                ->orWhere('pig_weight', 'like', '%' . $search . '%')
                ->orWhere('rate', 'like', '%' . $search . '%');
        })
        ->paginate(8)
        ->withQueryString();
        // Access the 'total' attribute on the 'customer' object
       
        // $totalAmount = $total->sum('total');

        return inertia('Customer/show', [
            'customer' => $customer,
             // Pass the total to the view if needed
            // 'totalAmount'=> $totalAmount,
            'filters' => HttpRequest::only(['search']),
        ]);
    }

//      public function show(Customer $customer)
// {
//     $query = $customer->salesItems();

//     if (request()->input('search')) {
//         $search = request()->input('search');
//         $query->where('created_at', 'like', '%' . $search . '%')
//             ->orWhere('pen_no', 'like', '%' . $search . '%')
//             ->orWhere('pig_weight', 'like', '%' . $search . '%')
//             ->orWhere('rate', 'like', '%' . $search . '%');
//     }

//     $salesItems = $query->paginate(8)
//         ->withQueryString();

//     // Calculate the total amount of salesItems
//     $totalAmount = $salesItems->sum('total');

//     // Calculate the total for each sale item
//     foreach ($salesItems as $saleItem) {
//         $saleItem->individualTotal = $saleItem->getTotalAttribute();
//     }

//     return inertia('Customer/show', [
//         'customer' => $customer,
//         'salesItems' => $salesItems,
//         'totalAmount' => $totalAmount,
//         'filters' => request()->only(['search']),
//     ]);
// }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return inertia('Customer/edit',[
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $fields=$request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
           
        ]);

        $customer->update($fields);

        return redirect('/customers')->with('message','Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
       
        $customer->delete();

        return back();

    }
}
