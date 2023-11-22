<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Customer;
use App\Models\Sale;
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
            'customers' => Customer::query()
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address','like','%' .$search . '%');
            })->paginate(8)
            ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
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

        return redirect('/customers')->with('success','Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */

    // public function show(Customer $customer)
    // {
    //         $customer->load(['sales.salesItems'])->paginate(6);

    //         // Calculate the total weight for each sale
    //         $customer->sales->each(function ($sale) {
    //             $totalWeight = $sale->salesItems->sum('pig_weight');
    //             $sale->total = number_format($totalWeight);
    //             $totalPigs = $sale->salesItems->count(); // Count the number of salesItems
    //             $sale->totalPig = $totalPigs;
    //         });

    //         $customer->sales->each(function ($sale) {
    //             // Store the count in the 'totalPig' attribute
    //         });

        

    //         return inertia('Customer/show', [
    //             'customer' => $customer,
    //             // 'sales' => $sales,
    //             'filters' => request()->only(['search']),
    //         ]);

    //     }
    public function show(Customer $customer)
{
    // Paginate the sales relationship and load related items
    $customer->sales()->with('salesItems');
   

    // Calculate the total weight for each sale
    $customer->sales->each(function ($sale) {
        $totalWeight = $sale->salesItems->sum('pig_weight');
        $sale->total = number_format($totalWeight);
        $totalPigs = $sale->salesItems->count(); // Count the number of salesItems
        $sale->totalPig = $totalPigs;
    });
    return inertia('Customer/show', [
        'customer' => $customer,
        'filters' => request()->only(['search']),
    ]);
}






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

        return redirect('/customers')->with('success','Customer Updated Successfully');
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
