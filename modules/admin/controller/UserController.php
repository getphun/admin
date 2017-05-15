<?php
/**
 * User controller
 * @package admin
 * @version 0.0.1
 * @update true
 */

namespace Admin\Controller;
use User\Model\User;

class UserController extends \AdminController
{
    public function filterAction(){
        if(!$this->user->isLogin())
            return $this->ajax(['error' => 'Not authorized']);
        if(!$this->can_i->read_user)
            return $this->ajax(['error' => 'Not allowed']);
        
        $q = $this->req->getQuery('q');
        if(!$q)
            return $this->ajax(['data'=>[]]);
        
        $users = User::get(['q'=>$q], 20, false, 'LENGTH(fullname)');
        if(!$users)
            return $this->ajax(['data'=>[]]);
        
        $users = array_column($users, 'fullname', 'id');
        
        $this->ajax(['data' => $users]);
    }
}