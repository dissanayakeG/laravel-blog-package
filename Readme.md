```
composer require dissanayakeg/pack

php artisan vendor:publish --provider="DissanayakeG\BlogPackage\BlogPackageServiceProvider" --tag="config"

php artisan vendor:publish --provider="DissanayakeG\BlogPackage\BlogPackageServiceProvider" --tag="migrations"

php artisan vendor:publish --provider="DissanayakeG\BlogPackage\BlogPackageServiceProvider" --tag="views"

php artisan vendor:publish --provider="DissanayakeG\BlogPackage\BlogPackageServiceProvider" --tag="view-components"

php artisan vendor:publish --provider="DissanayakeG\BlogPackage\BlogPackageServiceProvider" --tag="assets"
```
in laravel project
composer.json


add
```
"repositories": [
        {
          "type": "path",
          "url": "../pack"
        }
      ]
```

run
```
composer require dissanayakeg/laravel-blog-package
```
