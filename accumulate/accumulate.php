<?php

function accumulate(array $input, callable $accumulator)
{
    foreach($input as &$value)
    {
        $value=$accumulator($value);
    }

    return $input;
}