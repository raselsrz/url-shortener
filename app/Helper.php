<?php

use App\Models\ShortUrl;
use App\Models\CustomFields;
use App\Models\CustomOptions;


function rasel()
{
    return 'Rasel';
}


//short url random string
function short_url($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function is_serialized($data)
{
    // If it's not a string, it's not serialized
    if (!is_string($data)) {
        return false;
    }

    // Trim whitespaces
    $data = trim($data);

    // If it starts with 'a:', 's:', 'i:', or 'O:', it might be serialized
    if (in_array(substr($data, 0, 2), ['a:', 's:', 'i:', 'O:'], true)) {
        return true;
    }

    // If it starts with 'N;' or 'b:', it might be serialized
    if (in_array(substr($data, 0, 2), ['N;', 'b:'], true) && unserialize($data) !== false) {
        return true;
    }

    return false;
}


function serializeIfNeeded($variable) {
    // Check if the variable is an array or an object
    if (is_array($variable) || is_object($variable)) {
        // Serialize arrays and objects
        return serialize($variable);
    } else {
        // Return the variable as it is
        return $variable;
    }
}
// get field data
function get_field($name, $type, $obj_id, $default = '')
{
    return CustomFields::getField($name, $type, $obj_id, $default);
}

// add new field
function update_field($name, $value, $type, $obj_id)
{
    CustomFields::addField($name, $value, $type, $obj_id);
}

// get option
function get_option($name, $default = '')
{
    return CustomOptions::getOption($name, $default);
}

//update option
function update_option($name, $value)
{
    CustomOptions::setOption($name, $value);
}


//total links count
function total_links()
{
    return ShortUrl::where('user_id', auth()->user()->id)->count();
}
