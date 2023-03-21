<?php

function checkDateExists($eventsArray)
{
    echo array_key_exists('date', $eventsArray) ?
        $eventsArray['date'] :
        date('d/m/Y');
}