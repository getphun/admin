# admin

Adalah modul yang menyediakan panel admin. Perlu tambahan `gates` pada konfigurasi
level aplikasi yang berisi `path` dan atau `host`.

```php
./etc/config.php

return [
    'name' => 'Phun',
    ...
    'gates' => [
        'admin' => [
            'path' => '/admin'
        ]
    ],
    
    // Jika menggunakan permission berdasarkan role, maka tambahkan daftar role
    // user sebagai berikut:
    'admin' => [
        'roles' => [
            // role name
            'operator' => [
                // perms role list
                'Admin' => true,
                'Management' => true
            ],
            'administrator' => [
                'Admin' => true,
                'Management' => true,
                'Administrator' => true
            ]
        ]
    ]
];
```

## TODO

1. More Home Widgets
    - Charts
1. Favicon/Logo
1. Fix Typahead. It's currently not selecting clicked item [see the issue](https://github.com/bassjobsen/Bootstrap-3-Typeahead/issues/248)