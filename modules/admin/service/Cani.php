<?php
/**
 * User permission checker service
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

namespace Admin\Service;
use Admin\Model\UserPerms as UPerms;
use Admin\Model\UserPermsChain as UPChain;

class Cani
{
    private $_perms = [];
    
    public function __construct(){
        $dis = &\Phun::$dispatcher;
        
        if(!$dis->user->isLogin())
            return;
        
        $perms = UPChain::get(['user'=>$dis->user->id]);
        if(!$perms)
            return;
        
        $perms = array_column($perms, 'user_perms');
        $perms = UPerms::get(['id' => $perms]);
        if($perms)
            $this->_perms = array_column($perms, 'name');
    }
    
    public function __get($name){
        if(\Phun::$dispatcher->user->id == 1)
            return true;
        return in_array($name, $this->_perms);
    }
}