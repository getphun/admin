<?php
/**
 * Base admin controller
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

class AdminController extends \Controller
{
    
    private function adminMenu(&$params){
        $params['admin_menus'] = [];
        $params['admin_submenus'] = [];
        $active_menu    = isset($params['active_menu'])    ? $params['active_menu']    : null;
        $active_submenu = isset($params['active_submenu']) ? $params['active_submenu'] : null;
        
        if(!$this->user->isLogin())
            return;
        
        $menus = $this->config->admin['menu'];
        uasort($menus, function($a, $b){
            $a_order = isset($a->order) ? $a->order : 999999;
            $b_order = isset($b->order) ? $b->order : 999999;
            return $a_order - $b_order;
        });
        
        // parse menu
        $active_submenu_list = null;
        foreach($menus as $name => $menu){
            $this_menu = (object)[
                'label'     => $menu['label'],
                'active'    => $active_menu === $name,
                'icon'      => isset($menu['icon']) ? $menu['icon'] : 'chevron-right'
            ];
            
            $include_menu   = false;
            $submenu_exists = isset($menu['submenu']);
            
            if(isset($menu['perms'])){
                $can_i = false;
                if(is_string($menu['perms'])){
                    if($this->can_i->{$menu['perms']})
                        $can_i = true;
                }else{
                    foreach($menu['perms'] as $s_perm){
                        if($this->can_i->{$s_perm}){
                            $can_i = true;
                            break;
                        }
                    }
                }
                
                if($can_i){
                    $include_menu = true;
                    $this_menu->target = $this->router->to($menu['target']);
                }
            }
            
            if($submenu_exists && !$include_menu){
                $submenus = $menu['submenu'];
                uasort($submenus, function($a, $b){
                    $a_order = isset($a['order']) ? $a['order'] : 999999;
                    $b_order = isset($b['order']) ? $b['order'] : 999999;
                    return $a_order - $b_order;
                });
                
                foreach($submenus as $subname => $submenu){
                    if(!isset($submenu['perms']))
                        continue;
                    
                    if(is_string($submenu['perms'])){
                        if(!$this->can_i->{$submenu['perms']})
                            continue;
                    }else{
                        $i_can = false;
                        foreach($submenu['perms'] as $s_perm){
                            if($this->can_i->{$s_perm}){
                                $i_can = true;
                                break;
                            }
                        }
                        if(!$i_can)
                            continue;
                    }
                    
                    $include_menu = true;
                    $this_menu->target = $this->router->to($submenu['target']);
                    break;
                }
            }
            
            if($include_menu){
                if($this_menu->active)
                    $active_submenu_list = $submenu_exists ? $menu['submenu'] : null;
                $params['admin_menus'][]= $this_menu;
            }
        }
        
        if($active_submenu_list){
            uasort($active_submenu_list, function($a, $b){
                $a_order = isset($a['order']) ? $a['order'] : 999999;
                $b_order = isset($b['order']) ? $b['order'] : 999999;
                return $a_order - $b_order;
            });
            
            foreach($active_submenu_list as $subname => $menu){
                $this_menu = (object)[
                    'separator' => isset($menu['separator']) && $menu['separator'],
                    'label'     => $menu['label'],
                    'active'    => $active_submenu === $subname,
                    'icon'      => isset($menu['icon']) ? $menu['icon'] : 'chevron-right'
                ];
                
                if(!isset($menu['perms']))
                    continue;
                
                if(is_string($menu['perms'])){
                    if(!$this->can_i->{$menu['perms']})
                        continue;
                }else{
                    $can_i = false;
                    foreach($menu['perms'] as $s_perm){
                        if($this->can_i->{$s_perm}){
                            $can_i = true;
                            break;
                        }
                    }
                    if(!$can_i)
                        continue;
                }
                
                
                $this_menu->target = $this->router->to($menu['target']);
                $params['admin_submenus'][] = $this_menu;
            }
        }
    }
    
    public function fire(){
        if(!module_exists('event'))
            return;
        
        $args = func_get_args();
        call_user_func_array([$this->event, 'fire'], $args);
    }
    
    public function loginFirst(){
        $next = $this->req->uri;
        $page = $this->router->to('adminLogin') . '?next=' . urlencode($next);
        
        $this->redirect( $page );
    }
    
    public function respond($view, $params=[], $cache=null){
        $params['page_title'] = $params['title'] . ' - ' . $this->config->name;
        
        $this->adminMenu($params);
        
        parent::respond($view, $params, $cache);
    }
    
    public function show404Action(){
        return $this->show404();
    }
    
    public function show404(){
        $this->respond('error/404', [
            'page_title' => 'Page not found',
            'nav_title'  => 'Error',
            'side_menu_active' => null,
            'top_menu_active'  => null
        ]);
    }
}