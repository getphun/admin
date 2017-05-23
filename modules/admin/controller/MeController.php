<?php
/**
 * Current user controller
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

namespace Admin\Controller;
use Admin\Model\UserPerms as UPerms;
use Admin\Model\UserPermsChain as UPChain;

class MeController extends \AdminController
{
    private function _onLoggedIn(){
        $next = $this->req->getQuery('next');
        if(!$next){
            $admin_perms = UPerms::get(['name'=>'read_admin'],1);
            
            if($admin_perms){
                $allowed = UPChain::get(['user'=>$this->user->id, 'user_perms'=>$admin_perms->id],1);
                if($allowed)
                    $next = $this->router->to('adminHome');
            }
            
            if(!$next)
                $next = $this->router->to('siteHome');
        }
        
        $this->res->redirect($next);
    }
    
    private function _onLoggedOut(){
        $next = $this->req->getQuery('next');
        if(!$next)
            $next = $this->router->to('siteHome');
        
        $this->res->redirect($next);
    }
    
    public function loginAction(){
        if($this->user->isLogin())
            return $this->_onLoggedIn();
        
        $params = [
            'title' => 'Login',
            'nav_title'  => 'Login',
            'error' => false
        ];
        
        if(false === ($form = $this->form->validate('admin-login'))){
            if($this->form->errorExists())
                $params['error'] = true;
            return $this->respond('me/login', $params);
        }
        
        if(!$this->user->loginByCred($form->name, $form->password)){
            $params['error'] = true;
            return $this->respond('me/login', $params);
        }
        
        $this->fire('user:login', $this->user);
        $this->_onLoggedIn();
    }
    
    public function logoutAction(){
        if($this->user->isLogin()){
            $this->fire('user:logout', $this->user);
            $this->user->logout();
        }
        
        $this->_onLoggedOut();
    }
}