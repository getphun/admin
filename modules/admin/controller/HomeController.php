<?php
/**
 * Default admin controller
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

namespace Admin\Controller;

class HomeController extends \AdminController
{
    public function indexAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst();
        
        $this->respond('home/index', [
            'page_title' => $this->config->name,
            'nav_title'  => $this->config->name
        ]);
    }
}