# BlueLog

#### [ Super simple DB logger, that works! ]

BlueLog is a simple logging package for Laravel that allows you to log messages with context and extra information into both files and a database. It supports logging levels and channels, with precise timestamps down to milliseconds for better debugging and monitoring.

## Features

- Log messages with various levels (debug, info, warning, error etc.)
- Log to both files and a database
- Store context and extra information with logs
- Use millisecond precision for timestamps
- Configurable log levels
- Provide pre-defined Service and Facade
- Store logged in user information as created_by
- Supports custom channels
- Super simple plug and play to use

## Installation

1. **Require the package via Composer:**

   ```bash
   composer require ch17/blue-log
   ```

2. **Publish the configuration file and migration:**

   ```bash
   php artisan vendor:publish --tag=blue-log-migrations
   php artisan vendor:publish --tag=blue-log-config
   ```

3. **Run the migrations:**

   ```bash
   php artisan migrate
   ```

## Configuration

BlueLog's configuration file is located at `config/bluelog.php`. You can customize the default log level and other settings in this file.

```php
    // Setup default log Channel
    'default_log_channel' => 'Default',

    // Setup default log Level
    // info, debug, error, warning
    'default_log_level' => 'debug',

    // False if authenticated user information should not be stored
    'store_logged_by' => true,

    // add fields want to store for login user as created_by
    'logged_by_fields' => [
        'id',
        'email',
    ],
```

## Usage

To use BlueLog, you can either call the logging methods directly on the `BlueLog` facade or inject the `BlueLogger` class into your services.

### Logging Methods

BlueLog provides methods for each logging level:

```php
use Ch17\BlueLog\Facades\BlueLog as Log;

   Log::debug('default', 'This is a debug message', ['context' => 'value'], ['extra' => 'value']);
   Log::info('default', 'This is an info message', ['context' => 'value'], ['extra' => 'value']);
   Log::warning('default', 'This is a warning message', ['context' => 'value'], ['extra' => 'value']);
   Log::error('default', 'This is an error message', ['context' => 'value'], ['extra' => 'value']);
```

Or if its not enough of your style

```php
use Ch17\BlueLog\Facades\BlueLog as Log;

   Log::error([
    'message' => 'a new error message'
   ]);

    Log::warning([
      'channel' => 'user.create',
      'message' => 'a new warning message'
   ]);
```

With the service:

```php
use Ch17\BlueLog\Services\BlueLogger as logger;

   protected $logger;

    public function __construct(BlueLogger $logger)
    {
        $this->logger = $logger;
    }
```

Or

```php
use Ch17\BlueLog\Services\BlueLogger as logger;

   $logger = new BlueLogger();
```

```php
$this->logger->debug('default', 'This is a debug message', ['context' => 'value'], ['extra' => 'value']);
$this->logger->info('default', 'This is an info message', ['context' => 'value'], ['extra' => 'value']);
$this->logger->warning('default', 'This is a warning message', ['context' => 'value'], ['extra' => 'value']);
$logger->info('USER-DELETE', 'User deleted successfully!', ['deletedUser' => json_encode([])], ['extra' => 'value']);
```

Or

```php
    $logger->error([
    'message' => 'a new error message'
   ]);

    $logger->warning([
      'channel' => 'user.create',
      'message' => 'a new warning message',
      'context' => ['deletedUser' => json_encode($createdUser)]
   ]);
```

## License
