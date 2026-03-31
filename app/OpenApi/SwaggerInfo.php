Windows PowerShell
Copyright (C) Microsoft Corporation. All rights reserved.

Install the latest PowerShell for new features and improvements! https://aka.ms/PSWindows

PS C:\Users\serda> cd C:\Users\serda\notes-api
PS C:\Users\serda\notes-api> composer require darkaonline/l5-swagger
./composer.json has been updated
Running composer update darkaonline/l5-swagger
Loading composer repositories with package information
Updating dependencies
Lock file operations: 7 installs, 0 updates, 0 removals
  - Locking darkaonline/l5-swagger (11.0.0)
  - Locking phpstan/phpdoc-parser (2.3.2)
  - Locking radebatz/type-info-extras (1.0.7)
  - Locking swagger-api/swagger-ui (v5.32.1)
  - Locking symfony/type-info (v8.0.7)
  - Locking symfony/yaml (v7.4.6)
  - Locking zircote/swagger-php (6.0.6)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 7 installs, 0 updates, 0 removals
  - Downloading symfony/yaml (v7.4.6)
  - Downloading symfony/type-info (v8.0.7)
  - Downloading phpstan/phpdoc-parser (2.3.2)
  - Downloading radebatz/type-info-extras (1.0.7)
  - Downloading zircote/swagger-php (6.0.6)
  - Downloading swagger-api/swagger-ui (v5.32.1)
  - Downloading darkaonline/l5-swagger (11.0.0)
  - Installing symfony/yaml (v7.4.6): Extracting archive
  - Installing symfony/type-info (v8.0.7): Extracting archive
  - Installing phpstan/phpdoc-parser (2.3.2): Extracting archive
  - Installing radebatz/type-info-extras (1.0.7): Extracting archive
  - Installing zircote/swagger-php (6.0.6): Extracting archive
  - Installing swagger-api/swagger-ui (v5.32.1): Extracting archive
  - Installing darkaonline/l5-swagger (11.0.0): Extracting archive
Generating optimized autoload files
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
> @php artisan package:discover --ansi

   INFO  Discovering packages.

  darkaonline/l5-swagger ........................................................................................ DONE
  laravel/pail .................................................................................................. DONE
  laravel/sanctum ............................................................................................... DONE
  laravel/tinker ................................................................................................ DONE
  nesbot/carbon ................................................................................................. DONE
  nunomaduro/collision .......................................................................................... DONE
  nunomaduro/termwind ........................................................................................... DONE

81 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
> @php artisan vendor:publish --tag=laravel-assets --ansi --force

   INFO  No publishable resources for tag [laravel-assets].

No security vulnerability advisories found.
Using version ^11.0 for darkaonline/l5-swagger
PS C:\Users\serda\notes-api> php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"

   INFO  Publishing assets.

  Copying file [C:\Users\serda\notes-api\vendor\darkaonline\l5-swagger\config\l5-swagger.php] to [C:\Users\serda\notes-api\config\l5-swagger.php]  DONE
  Copying directory [C:\Users\serda\notes-api\vendor\darkaonline\l5-swagger\resources\views] to [C:\Users\serda\notes-api\resources\views\vendor\l5-swagger]  DONE

PS C:\Users\serda\notes-api>