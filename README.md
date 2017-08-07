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

1. More Home Widgets
    - Charts
1. Favicon/Logo
1. Fix Typahead. It's currently not selecting clicked item [see the issue](https://github.com/bassjobsen/Bootstrap-3-Typeahead/issues/248)