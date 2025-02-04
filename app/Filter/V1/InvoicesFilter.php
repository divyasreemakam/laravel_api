<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class InvoicesFilter extends ApiFilter {

    protected $safeParams = [
        'status' => ['eq','ne'],
        'customerId' => ['eq'],
        'amount' => ['eq','lt','gt'],
        'billedDate' => ['eq','lt','gt'],
        'paidDate' => ['eq','lt','gt'],
    ];


    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'gt' => '>',
        'lt' => '<',
        'eq' => '=',
        'ne' => '!='
    ];

}

