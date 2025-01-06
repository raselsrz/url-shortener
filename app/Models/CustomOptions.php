<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOptions extends Model
{
    use HasFactory;
    protected $table = 'custom_options';
    protected static $custom_options = [];
    //get field value by field name , or get default
    public static function getOption($name, $default = '')
    {
        if (empty(self::$custom_options)) {
            self::$custom_options = CustomOptions::all();
            // find value
            foreach (self::$custom_options as $option) {
                if ($option->name == $name) {
                    return is_serialized($option->value) ? unserialize($option->value) : $option->value;
                }
            }
            return $default;
        }
        // find value
        foreach (self::$custom_options as $option) {
            if ($option->name == $name) {
                return is_serialized($option->value) ? unserialize($option->value) : $option->value;
            }
        }
        return $default;
    }

    //set field value by field name
    public static function setOption($name, $value)
    {
        $option = CustomOptions::where('name', $name)->first();
        if ($option) {
            $option->value = serializeIfNeeded($value);
            $option->save();
        } else {
            $option = new CustomOptions;
            $option->name = $name;
            $option->value = serializeIfNeeded($value);
            $option->save();
        }
    }

}