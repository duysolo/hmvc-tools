# HMVC Tools
Some available tools for HMVC Laravel projects.

### Installation
```$xslt
composer require duyphan2502/hmvc-tools
```
Update your `composer.json`
```$xslt
{
    ...,
    "repositories": [
        {
            "type": "path",
            "url": "./platform/core/*"
        },
        {
            "type": "path",
            "url": "./platform/plugins/*"
        },
        {
            "type": "path",
            "url": "./platform/themes/*"
        }
    ]
}
```

## Create new module
```$xslt
php artisan module:create <module-name>
```
For example
```$xslt
php artisan module:create test-module
```
After you create your module, open the `composer.json` file inside your module folder, you can see something like this
```$xslt
{
    "name": "plugins/test-module",
    "require": {},
    "require-dev": {},
    "autoload": {
        "psr-4": {
            "TestModule\\": "src/"
        }
    },
    "extra": [],
    "minimum-stability": "dev",
    "description": "Test HMVC module"
}
```
Run this command from terminal
```$xslt
composer require plugins/test-module:*@dev
```
You might need to register your module provider to `config/app.php`
If you want Laravel auto register your module, you need to update the module `composer.json`
```$xslt
{
    "name": "plugins/test-module",
    "require": {},
    "require-dev": {},
    "autoload": {
        "psr-4": {
            "TestModule\\": "src/"
        }
    },
    "extra": [],
    "minimum-stability": "dev",
    "extra": {
        "laravel": {
            "providers": [
                "TestModule\\Providers\\ModuleServiceProvider"
            ]
        }
    },
    "description": "Test HMVC module"
}
```
Don't forget to run `composer update`.

Or you can skip these actions easier by adding option `--autoload` when you try `module:create`
```$xslt
php artisan module:create <module-name> --autoload
```

### Generate Model
```$xslt
php artisan module:make:model <module-name> <YourModelName> <your_table_name>
```

### Generate Controller
```$xslt
php artisan module:make:controller <module-name> <YourControllerName> --resource
```

### Generate Migration
```$xslt
php artisan module:make:migration <module-name> <your_migration_name> {--create=table} {--table=table}
```
For example
```$xslt
php artisan module:make:migration test-module create_test_table --create=test
```

### Generate Command
```$xslt
php artisan module:make:command <module-name> <YourCommandName>
```

### Generate Facade
```$xslt
php artisan module:make:facade <module-name> <YourFacadeName>
```

### Generate Middleware
```$xslt
php artisan module:make:middleware <module-name> <YourMiddlwareName>
```

### Generate Provider
```Provider
php artisan module:make:provider <module-name> <YourProviderName>
```

### Generate Form Request
```Provider
php artisan module:make:request <module-name> <YourRequestName>
```

### Generate Support
```Provider
php artisan module:make:support <module-name> <YourSupportName>
```

### Generate View Composer
```Provider
php artisan module:make:composer <module-name> <YourViewComposerName>
```

### Generate View
```Provider
php artisan module:make:provider <module-name> <your-view-name>
```
