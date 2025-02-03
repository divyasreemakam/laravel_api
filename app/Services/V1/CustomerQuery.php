<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery {

    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'city' => ['eq'],
        'address' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];


    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'gt' => '>',
        'lt' => '<',
        'eq' => '='
    ];

    function transform(Request $request){
        $elnQuery = [];

        foreach($this->safeParams as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator) {
                if(isset($query[$operator])) {
                    $elnQuery [] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }


        }

        //print_r($elnQuery);die;

        return $elnQuery;

    }
}

