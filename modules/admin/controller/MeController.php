<?php
/**
 * Current user controller
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

namespace Admin\Controller;

class MeController extends \AdminController
{
    private function _onLoggedIn(){
        $next = $this->req->getQuery('next');
        if(!$next){
            // TODO
            // check user permission if they can see admin home 
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
            'page_title' => 'Login',
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