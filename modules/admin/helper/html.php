<?php
/**
 * Various HTML function
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

/**
 * Convert array to html attribute
 * @param array $attrs Name-value pair of array to convert
 * @return string html attribute that ready to print
 */
if(!function_exists('array_to_attr')){
    function array_to_attr($attrs){
        $html = [];
        foreach($attrs as $name => $value)
            $html[] = sprintf('%s="%s"', $name, hs($value));
        return implode(' ', $html);
    }
}