## Laravel Core Web Vitals

This is Laravel 8.x package wrapper library for monitoring Web Vitals Records to check website performance.

## Documentation

### Installing
To install the package, in terminal:
```
composer require shreesthapit1/corewebvitals
```
### Configure
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php
```
Shreesthapit\Corewebvitals\CoreWebVitalServiceProvider::class,
```

#### Copy the package config to your local config with the publish command:

```bash
php artisan vendor:publish --provider="Shreesthapit\Corewebvitals\CoreWebVitalServiceProvider"
```

#### Migrate the tables required to store the core web vitals records.

```bash
php artisan migrate
```

### Collecting Data
You need to add a tag below in your blade layouts or on those pages of which you want to monitor the vitals.
```
<x-core-web-vital-core-web-component/>
```

### Insight of Collected Data
You can see the insight of the collected data in the URI below:
```
/core-web-vital-insight
```

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
