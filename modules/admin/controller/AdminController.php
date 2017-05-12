<?php
/**
 * Base admin controller
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

class AdminController extends \Controller
{
    public function show404Action(){
        return $this->show404();
    }
    
    public function show404(){
        $this->respond('error/404', [
            'page_title' => 'Page not found',
            'nav_title'  => 'Error'
        ]);
    }
    
    public function loginFirst(){
        $next = $this->req->uri;
        $page = $this->router->to('adminLogin') . '?next=' . urlencode($next);
        
        $this->redirect( $page );
    }
}