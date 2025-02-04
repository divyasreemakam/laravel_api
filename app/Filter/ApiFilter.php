<?php

namespace App\Filter;

use Illuminate\Http\Request;

class ApiFilter {

    protected $safeParams = [];


    protected $columnMap = [];

    protected $operatorMap = [];

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

        return $elnQuery;

    }
}

