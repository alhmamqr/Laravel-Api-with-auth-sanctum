<?php

namespace App\Http\Controllers;

use App\Filtering\V2\CustomerQuery;
use App\Http\Controllers\Filter\FilterController;
use App\Http\Controllers\Filter\V1\CustomerFilterController;
use App\Http\Requests\BluckInvoiceRequest;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

        public function index(Request $request)
    {
        $fitler =new CustomerFilterController;
        $queryItems =$fitler->transform($request);
        $includeInvoices = $request->query('invoices');
        $customers =Customer::where($queryItems);

        if($includeInvoices){
            $customers =$customers->with('invoices');
        }
        return new CustomerCollection($customers->paginate()->appends($request->query()));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
 
    public function store(StoreCustomerRequest $request)
    {
        //
        return new CustomerResource(Customer::create($request->all()));
    }
 
    public function show(Customer $customer)
    {
        //
        $includeInvoices = request()->query('invoices');
        if($includeInvoices){ 
            return new CustomerResource($customer->loadMissing('invoices'));
        }else{
            return new CustomerResource($customer);
        }
    }

  


    public function edit(Customer $customer)
    {
        //
    }

    



    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        return $customer->update($request->all());
    }
 



    public function destroy(Customer $customer)
    {
        //
    }
}









// class CustomerQeury

// {


//     Protected $safeParams =[
    
//     'name' => ['eq'],
//     'type' => ['eq'],
//     'email' => ['eq'],
//     'address' => ['eq'],
//     'city' => ['eq'],
//     'state' => ['eq'],
//     'postalCode' => ['eq','gt','lt'],
//     ];
    
    
//     protected $columMap =[
//     'postalCode' => 'postal_code'
    
//     ];
    
    
    
//     protected $operatorMap = [
    
//     'eq' => '=',
//     'lt' => '<',
//     'lte' => '<=',
//     'gt' => '>',
//     'gte' => '>=',
    
//     ];
    
    
    
//     public function transform(Request $request){
    
//     $eloQuery =[];
    
    
//     foreach($this->safeParams as $param => $opreators) {
    
//     $query = $request->query($param);
//     if(!isset($query)){
//     continue;
//     }
    
//     $column = $this->columMap[$param] ?? $param;
    
//     foreach($opreators as $operator){
    
//     if(isset($query[$operator])){
//         $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
    
//     }}
//     }
//     return $eloQuery;
//     }
//     }
    
    