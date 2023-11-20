# SiteBrew

All the core functionality for the shop+blogging sites.

## Icons

To sync icons run:

```bash
php artisan sitebrew:sync-icons
```

To ensure new items are synced run this command after every deployment or in ``post-autoload-dump`` script.


## Development
To add assets from this package to the main project during development you need to symlink the asset directory:
```bash
ln -s ../../vendor/felixbeer/sitebrew/public/vendor/sitebrew ./public/vendor/sitebrew
```

## Production
To add assets from this package to the main project in production you need to publish the assets:
```bash
php artisan vendor:publish --tag=sitebrew-assets --force
```