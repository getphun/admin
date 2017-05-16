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
//     public function indexAction(){
//         $object = new \stdClass();
//         $object->featured = 1;
//         $object->religion = 'budha';
//         $object->regional = 'Jakarta Utara';
//         $object->website = 'http://google.com/';
//         $object->status = 2;
//         $object->about = 'Is this the site?';
//         $object->category = [1,2,3];
//         
//         $this->form->setForm('test');
//         $this->form->setObject($object);
//         
//         $params = [
//             'page_title'  => $this->config->name,
//             'nav_title'   => $this->config->name,
//             'active_menu' => 'home',
//             'widgets'     => [],
//             'csses'       => [],
//             'jses'        => [],
//             'parents'     => [],
//             'tags'        => []
//         ];
//         
//         for($i=1; $i<25; $i++){
//             $item = [
//                 'id' => $i,
//                 'name' => 'Item #' . $i,
//                 'parent' => $i < 5 ? 0 : $i < 10 ? rand(1,5) : rand(5,10)
//             ];
//             if($i<5)
//                 $item['parent'] = 0;
//             elseif($i<10)
//                 $item['parent'] = rand(1,5);
//             else 
//                 $item['parent'] = rand(5,10);
//             
//             $params['parents'][] = $item;
//         }
//         
//         for($i=1; $i<10; $i++)
//             $params['tags'][$i] = 'Item #' . $i;
//         
//         $form = $this->form->validate();
//         $this->respond('test', $params);
//     }
    
    public function indexAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst();
        if(!$this->can_i->read_admin)
            return $this->show404();
        
        $params = [
            'page_title'  => $this->config->name,
            'nav_title'   => $this->config->name,
            'active_menu' => 'home',
            'widgets'     => [],
            'csses'       => [],
            'jses'        => []
        ];
        
        $widgets = $this->config->admin['widget'] ?? [];
        foreach($widgets as $name => $widget){
            if(isset($widget['perms']) && !$this->can_i->{$widget['perms']})
                continue;
            
            $pos = $widget['position'];
            
            if(!isset($params['widgets'][$pos]))
                $params['widgets'][$pos] = [];
            
            $handler = explode('::', $widget['handler']);
            $ctrl = $handler[0];
            $method = $handler[1];
            
            $widget['name'] = $name;
            $widget['html'] = $ctrl::$method($widget);
            
            if(isset($widget['csses']))
                $params['csses'] = array_merge($params['csses'], $widget['csses']);
            if(isset($widget['jses']))
                $params['jses'] = array_merge($params['jses'], $widget['jses']);
            
            if($widget['html'])
                $params['widgets'][$pos][] = $widget;
        }
        
        $params['csses'] = array_unique($params['csses']);
        $params['jses']  = array_unique($params['jses']);
        
        $this->respond('home/index', $params);
    }
}