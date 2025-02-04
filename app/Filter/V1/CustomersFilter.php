<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class CustomersFilter extends ApiFilter {

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

}

