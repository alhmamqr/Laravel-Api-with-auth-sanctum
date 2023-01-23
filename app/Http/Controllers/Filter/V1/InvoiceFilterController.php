<?php

namespace App\Http\Controllers\Filter\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filter\FilterController;
use Illuminate\Http\Request;

class InvoiceFilterController extends FilterController
{
    //


    Protected $safeParams =[
    
        'customerId' => ['eq'],
        'amount' => ['eq','lt','gt','lte','gte'],
        'status' => ['eq','ne'],
        'billed_date' => ['eq','lt','gt','lte','gte'],
        'paid_date' => ['eq','lt','gt','lte','gte'],
        ];
        
        
        protected $columMap =[
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
        'customerId'=>'customer_id'

        
        ];
        
        
        
        protected $operatorMap = [
        
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
        
        ];
        
        
        
        public function transform(Request $request){
        
        $eloQuery =[];
        
        
        foreach($this->safeParams as $param => $opreators) {
        
        $query = $request->query($param);
        if(!isset($query)){
        continue;
        }
        
        $column = $this->columMap[$param] ?? $param;
        
        foreach($opreators as $operator){
        
        if(isset($query[$operator])){
            $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
        
        }}
        }
        return $eloQuery;
        }
}
