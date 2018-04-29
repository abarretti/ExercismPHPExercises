<?php

function from($date)
{
    return date_add($date,date_interval_create_from_date_string("1000000000 seconds"));
}

?>
