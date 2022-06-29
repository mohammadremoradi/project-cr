<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y H:i:s')
{

    return Jalalian::forge($date)->format($format); // دی 02، 1391

}



function convertNum($num)
{

    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    // $inputs['phone'] = str_replace($persian, $english, $client->phone);
    $convertedPersianNums = str_replace($persian, $english, $num);
    $total = str_replace($arabic, $english, $convertedPersianNums);

    return $total;
}


function priceFormat($price)
{
    $price = number_format($price, 0, "/", ",");
    return $price;
}
