<?php
/**
 * Admin widget library
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

class AdminWidget
{
    static function wNumber($number, $title=null){
        $tx = '<h2 class="text-right">' . $number . '</h2>';
        return self::wPanel($tx, $title);
    }
    
    static function wPanel($content, $title=null){
        $tx = '<div class="panel panel-default">';
        if($title):
        $tx.=   '<div class="panel-heading">';
        $tx.=       $title;
        $tx.=   '</div>';
        endif;
        $tx.=   '<div class="panel-body">';
        $tx.=       $content;
        $tx.=   '</div>';
        $tx.= '</div>';
        
        return $tx;
    }
}