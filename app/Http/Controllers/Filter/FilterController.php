<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    
    Protected $safeParams =[];
        
        
        protected $columMap =[];
        
        
        
        protected $operatorMap = [];
        
        
        
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
