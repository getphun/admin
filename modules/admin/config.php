<?php
/**
 * admin config file
 * @package admin
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'admin',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/admin',
    '__files' => [
        'modules/admin'                         => ['install', 'remove', 'update'],
        'theme/admin/error/404.phtml'           => ['install', 'remove', 'update'],
        
        'theme/admin/form/password.phtml'       => ['install', 'remove', 'update'],
        'theme/admin/form/text.phtml'           => ['install', 'remove', 'update'],
        
        'theme/admin/home/index.phtml'          => ['install', 'remove', 'update'],
        'theme/admin/me/login.phtml'            => ['install', 'remove', 'update'],
        
        'theme/admin/shared/navigation.phtml'   => ['install', 'remove', 'update'],
        'theme/admin/shared/header.phtml'       => ['install', 'remove', 'update'],
        'theme/admin/shared/footer.phtml'       => ['install', 'remove', 'update'],
        
        'theme/admin/static/css/style.css'      => ['install', 'remove', 'update'],
        'theme/admin/static/css/style.min.css'  => ['install', 'remove', 'update'],
        'theme/admin/static/fonts'              => ['install', 'remove', 'update'],
        'theme/admin/static/image'              => ['install', 'remove'],
        'theme/admin/static/js/jquery.min.js'   => ['install', 'remove', 'update'],
        'theme/admin/static/js/portal.js'       => ['install', 'remove', 'update'],
        'theme/admin/static/js/portal.min.js'   => ['install', 'remove', 'update'],
    ],
    '__dependencies' => [
        'user',
        'formatter',
        'form',
        'event'
    ],
    '_services' => [
        'admin' => 'Admin\\Service\\Admin'
    ],
    '_autoload' => [
        'classes' => [
            'Admin\\Service\\Admin'                 => 'modules/admin/service/Admin.php',
            'AdminController'                       => 'modules/admin/controller/AdminController.php',
            'Admin\\Controller\\HomeController'     => 'modules/admin/controller/HomeController.php',
            'Admin\\Controller\\MeController'       => 'modules/admin/controller/MeController.php'
        ],
        'files' => [
            'modules/admin/helper/html.php'
        ]
    ],
    
    '_gates' => [
        'admin' => [
            'path' => '/admin'
        ]
    ],
    
    '_routes' => [
        'admin' => [
            '404' => [
                'handler'   => 'Admin::show404'
            ],
            'adminHome' => [
                'rule'      => '/',
                'handler'   => 'Admin\\Controller\\Home::index'
            ],
            'adminLogin' => [
                'rule'      => '/login',
                'handler'   => 'Admin\\Controller\\Me::login'
            ],
            'adminMeLogout' => [
                'rule'      => '/logout',
                'handler'   => 'Admin\\Controller\\Me::logout'
            ]
        ]
    ],
    
    'form' => [
        'admin-login' => [
            'name'      => [
                'type'      => 'text',
                'label'     => 'Name',
                'rules'     => [
                    'required'  => true
                ]
            ],
            'password'  => [
                'type'      => 'password',
                'label'     => 'Password',
                'rules'     => [
                    'required'  => true
                ]
            ]
        ]
    ]
];