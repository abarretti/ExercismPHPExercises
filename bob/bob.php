<?php

class Bob
{
    function respondTo($x)
    {
        if($x=='')
        {
            return 'Fine. Be that way!';
        }

        if (preg_match('/^[ ]+$/',$x))
        {
            return 'Fine. Be that way!';
        }

        if (preg_match('/[\t]/',$x))
        {
            return 'Fine. Be that way!';
        }

        if (preg_match('/^[0-9]/',$x) and $x[-1]=='?')
        {
            return 'Sure.';
        }

        if (preg_match('/^[^0-9a-zA-Z]+$/',$x) and $x[-1]=='?')
        {
            return 'Sure.';
        }

        if (preg_match('/^[^a-z]+$/',$x) and preg_match('/[0-9]/',$x) and $x[-1]!='!')
        {
            return 'Whatever.';
        }

        if (preg_match('/^[^a-z]+$/',$x) and ($x[-1]=='?' or $x[-1]=='!'))
        {
            return 'Whoa, chill out!';
        }

        if (preg_match('/^[^a-z]+$/',$x))
        {
            return 'Whoa, chill out!';
        }

        if ($x[-1]=='?')
        {
            return 'Sure.';
        }

        if (preg_match('/[?]/',$x) and preg_match('/[ ]+$/',$x))
        {
            return 'Sure.';
        }

        else
        {
            return 'Whatever.';
        }
    }
}

?>