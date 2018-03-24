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
        
        // permission based filter
        if(!$dis->user->role){
            $perms = UPChain::get(['user'=>$dis->user->id]);
            if(!$perms)
                return;
        
            $perms = array_column($perms, 'user_perms');
            $perms = UPerms::get(['id' => $perms]);
            if($perms)
                $this->_perms = array_column($perms, 'name');
            return;
        }
        
        // role based filters
        $my_role = $dis->user->role;
        $roles_groups = $dis->config->admin['roles'];
        if(!isset($roles_groups[$my_role]))
            return;
        
        $role_groups = $roles_groups[$my_role];
        $used_role_groups = [];
        
        foreach($role_groups as $role_group => $use){
            if($use)
                $used_role_groups[] = $role_group;
        }
        
        $exists_perms = UPerms::get([]);
        if(!$exists_perms)
            return;
        
        foreach($exists_perms as $exists_perm){
            $exists_perm_roles = explode(' ', $exists_perm->role);
            foreach($exists_perm_roles as $exists_perm_role){
                if(in_array($exists_perm_role, $used_role_groups)){
                    $this->_perms[] = $exists_perm->name;
                    break;
                }
            }
        }
    }
    
    public function __get($name){
        if(\Phun::$dispatcher->user->id == 1)
            return true;
        return in_array($name, $this->_perms);
    }
}