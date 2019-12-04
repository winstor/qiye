<?php

if(!function_exists('root_path')){
    function root_path($path='')
    {
        return dirname(base_path()).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

