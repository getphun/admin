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
    - File
    - WYSIWYG
    - Multiple File
    - Multiple Ajax
    
    - range