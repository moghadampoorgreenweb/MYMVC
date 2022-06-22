<?php
//in tavabe dar helper laravel mojood ast

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('envh')){
    function envh($key , $defult=null){
        $value=getenv($key);
        if ($value === false){
            return value($defult);
        }
        switch (strtolower($value)){
            case 'true':
            case'(true)':
                return true;
            case 'false':
            case'(false)':
                return false;
            case 'empty':
            case'(empty)':
                return '';
            case 'null':
            case'(null)':
                return;
        }
      return $value;
    }
}




