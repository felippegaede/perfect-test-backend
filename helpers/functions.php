<?php

function convertDate($date)
{
    $splitDate = explode('/', $date);

    return str_replace(" ","","{$splitDate[2]}-{$splitDate[1]}-{$splitDate[0]}");;
}

function formatDate($date)
{
    $splitDate = explode('-', $date);

    return str_replace(" ","","{$splitDate[2]}/{$splitDate[1]}/{$splitDate[0]}");;
}
