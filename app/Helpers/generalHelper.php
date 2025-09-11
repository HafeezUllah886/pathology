<?php

use App\Models\material_stock;
use App\Models\receipt;
use App\Models\stock;
use Carbon\Carbon;

function firstDayOfMonth()
{
    $startOfMonth = Carbon::now()->startOfMonth();

    return $startOfMonth->format('Y-m-d');
}
function lastDayOfMonth()
{

    $endOfMonth = Carbon::now()->endOfMonth();

    return $endOfMonth->format('Y-m-d');
}

function projectNameAuth()
{
    return "DAWOOD LAB";
}

function projectNameHeader()
{
    return "DAWOOD LAB";
}
function projectNameShort()
{
    return "DL";
}

function projectAddress()
{
    return "MA Jinnah Road, Opposite Civil Hospital Quetta";
}

function projectContact()
{
    return "081-2837006, 0317-845289";
}


