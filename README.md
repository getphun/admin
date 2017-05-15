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
    - Checkbox
    - Date
    - DateTime
    - File
    - Multiple Parent
    - Multiple
    - Radio
    - Select
    - Text
    - Textarea
    - WYSIWYG
    - Multiple File