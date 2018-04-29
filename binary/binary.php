<?php

// Implementation note:
// --------------------
// If the argument to parse_binary isn't a valid binary value the
// function should raise an \InvalidArgumentException
// with a meaningful error message.

function parse_binary($binary)
{
    if(!preg_match("/^[01]+$/",$binary))
    {
        throw new InvalidArgumentException('Not a binary string.');
    }

    $reverseBinary=strrev($binary);
    $number=0;
    for($x=0;$x<strlen($binary);$x++)
    {
        if($reverseBinary[$x]==1)
        {
            $number=$number+(2**$x);
        }
    }

    return $number;
}
