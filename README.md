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
    ]
];
```

## TODO

1. More Form Control
    - Date
    - DateTime
    - File
    - Multiple Parent
    - Multiple
    - WYSIWYG
    - Multiple File
    - Radio Parent
    
    - Select with Ajax
    - Select Multiple
    - Select Multiple With Ajax