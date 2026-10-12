# MeshFactory Source Notes

## Runtime Guard Policy

- `MVPLOUNGE_MESHFACTORY_BASE_PATH` is defined only in `Constants.php`.
- MeshFactory PHP source files require the constant to exist and throw when it is missing:

```php
if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}
```

## Direct Access Policy

- Subdirectories under `src/MvpLounge` include `.htaccess` and `index.php` files to block direct web execution.
