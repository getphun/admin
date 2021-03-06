<?php
/**
 * admin config file
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'admin',
    '__version' => '0.1.0',
    '__git' => 'https://github.com/getphun/admin',
    '__files' => [
        'modules/admin' => [ 'install', 'remove', 'update' ],
        
        'theme/admin/error/404.phtml'   => [ 'install', 'remove', 'update' ],
        
        'theme/admin/form/checkbox.phtml'           => [ 'install', 'remove', 'update' ],
        'theme/admin/form/checkbox-multiple.phtml'  => [ 'install', 'remove', 'update' ],
        'theme/admin/form/checkbox-tree.phtml'      => [ 'install', 'remove', 'update' ],
        'theme/admin/form/color.phtml'              => [ 'install', 'remove', 'update' ],
        'theme/admin/form/date.phtml'               => [ 'install', 'remove', 'update' ],
        'theme/admin/form/datetime.phtml'           => [ 'install', 'remove', 'update' ],
        'theme/admin/form/email.phtml'              => [ 'install', 'remove', 'update' ],
        'theme/admin/form/file.phtml'               => [ 'install', 'remove', 'update' ],
        'theme/admin/form/hidden.phtml'             => [ 'install', 'remove', 'update' ],
        'theme/admin/form/location.phtml'           => [ 'install', 'remove', 'update' ],
        'theme/admin/form/multiple-ajax.phtml'      => [ 'install', 'remove', 'update' ],
        'theme/admin/form/multiple-file.phtml'      => [ 'install', 'remove', 'update' ],
        'theme/admin/form/month.phtml'              => [ 'install', 'remove', 'update' ],
        'theme/admin/form/number.phtml'             => [ 'install', 'remove', 'update' ],
        'theme/admin/form/password.phtml'           => [ 'install', 'remove', 'update' ],
        'theme/admin/form/radio.phtml'              => [ 'install', 'remove', 'update' ],
        'theme/admin/form/radio-tree.phtml'         => [ 'install', 'remove', 'update' ],
        'theme/admin/form/search.phtml'             => [ 'install', 'remove', 'update' ],
        'theme/admin/form/select.phtml'             => [ 'install', 'remove', 'update' ],
        'theme/admin/form/select-ajax.phtml'        => [ 'install', 'remove', 'update' ],
        'theme/admin/form/tel.phtml'                => [ 'install', 'remove', 'update' ],
        'theme/admin/form/text.phtml'               => [ 'install', 'remove', 'update' ],
        'theme/admin/form/textarea.phtml'           => [ 'install', 'remove', 'update' ],
        'theme/admin/form/time.phtml'               => [ 'install', 'remove', 'update' ],
        'theme/admin/form/url.phtml'                => [ 'install', 'remove', 'update' ],
        'theme/admin/form/wysiwyg.phtml'            => [ 'install', 'remove', 'update' ],
        
        'theme/admin/home/index.phtml'  => [ 'install', 'remove', 'update' ],
        'theme/admin/me/login.phtml'    => [ 'install', 'remove', 'update' ],
        
        'theme/admin/shared/navigation.phtml'   => [ 'install', 'remove', 'update' ],
        'theme/admin/shared/header.phtml'       => [ 'install', 'remove', 'update' ],
        'theme/admin/shared/footer.phtml'       => [ 'install', 'remove', 'update' ],
        'theme/admin/shared/pagination.phtml'   => [ 'install', 'remove', 'update' ],
        
        'theme/admin/static/css/tinymce.css'    => [ 'install', 'remove', 'update' ],
        'theme/admin/static/css/style.css'      => [ 'install', 'remove', 'update' ],
        'theme/admin/static/css/style.min.css'  => [ 'install', 'remove', 'update' ],
        
        'theme/admin/static/fonts' => [ 'install', 'remove', 'update' ],
        'theme/admin/static/image' => [ 'install', 'remove' ],
        
        'theme/admin/static/js/tinymce' => [ 'install', 'remove', 'update' ],
        'theme/admin/static/js/jquery.min.js' => [ 'install', 'remove', 'update' ],
        'theme/admin/static/js/portal.js' => [ 'install', 'remove', 'update' ],
        'theme/admin/static/js/portal.min.js' => [ 'install', 'remove', 'update' ]
    ],
    '__dependencies' => [
        'user',
        'formatter',
        'form',
        'site-param',
        '/event',
        '/upload',
        '/media'
    ],
    '_services' => [
        'admin' => 'Admin\\Service\\Admin',
        'can_i' => 'Admin\\Service\\Cani'
    ],
    '_autoload' => [
        'classes' => [
            'Admin\\Service\\Admin' => 'modules/admin/service/Admin.php',
            'Admin\\Service\\Cani' => 'modules/admin/service/Cani.php',
            'AdminController' => 'modules/admin/controller/AdminController.php',
            'AdminWidget' => 'modules/admin/library/AdminWidget.php',
            'Admin\\Controller\\HomeController' => 'modules/admin/controller/HomeController.php',
            'Admin\\Controller\\MeController' => 'modules/admin/controller/MeController.php',
            'Admin\\Model\\UserPerms' => 'modules/admin/model/UserPerms.php',
            'Admin\\Model\\UserPermsChain' => 'modules/admin/model/UserPermsChain.php'
        ],
        'files' => [
            'admin' => 'modules/admin/helper/html.php'
        ]
    ],
    '_gates' => [
        'admin' => [
            'path' => '/admin'
        ]
    ],
    '_routes' => [
        'admin' => [
            404 => [
                'handler' => 'Admin::show404'
            ],
            'adminHome' => [
                'rule' => '/',
                'handler' => 'Admin\\Controller\\Home::index'
            ],
            'adminLogin' => [
                'rule' => '/login',
                'handler' => 'Admin\\Controller\\Me::login'
            ],
            'adminMeLogout' => [
                'rule' => '/logout',
                'handler' => 'Admin\\Controller\\Me::logout'
            ],
            'adminFileUpload' => [
                'module' => 'upload',
                'rule' => '/comp/upload',
                'handler' => 'Upload\\Controller\\Main::upload'
            ],
            'adminMediaFilter' => [
                'module' => 'media',
                'rule' => '/comp/media/filter',
                'handler' => 'Media\\Controller\\Media::filter'
            ]
        ]
    ],
    'form' => [
        'admin-login' => [
            'name' => [
                'type' => 'text',
                'label' => 'Name',
                'rules' => [
                    'required' => TRUE
                ]
            ],
            'password' => [
                'type' => 'password',
                'label' => 'Password',
                'rules' => [
                    'required' => TRUE
                ]
            ]
        ]
    ],
    'admin' => [
        'menu' => [
            'home' => [
                'label' => 'Home',
                'target' => 'adminHome',
                'icon' => 'home',
                'perms' => 'read_admin',
                'order' => 1
            ]
        ],
        'roles' => [
        ]
    ]
];
