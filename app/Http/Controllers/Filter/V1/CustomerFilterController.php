<?php

namespace App\Http\Controllers\Filter\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Filter\FilterController;
use Illuminate\Http\Request;

class CustomerFilterController extends FilterController
{
    //
    
    Protected $safeParams =[
    
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq','gt','lt'],
        ];
        
        
        protected $columMap =[
        'postalCode' => 'postal_code'
        
        ];
        
        
        
        protected $operatorMap = [
        
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        
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
