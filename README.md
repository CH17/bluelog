# BlueLog

BlueLog is a logging package for Laravel that allows you to log messages with context and extra information into both files and a database. It supports logging levels and channels, with precise timestamps down to milliseconds for better debugging and monitoring.

## Features

- Log messages with various levels (debug, info, warning, error etc.)
- Log to both files and a database
- Store context and extra information with logs
- Use millisecond precision for timestamps
- Configurable log levels
- Supports custom channels

## Installation

1. **Require the package via Composer:**

   ```bash
   composer require ch17/blue-log
   ```

2. **Publish the configuration file and migration:**

   ```bash
   php artisan vendor:publish --tag=blue-log-migrations
   ```

3. **Run the migrations:**

   ```bash
   php artisan migrate
   ```

## Configuration [upcoming]

BlueLog's configuration file is located at `config/bluelog.php`. You can customize the default log level and other settings in this file.

```php
return [
    'log_level' => env('BLUELOG_LOG_LEVEL', 'debug'),
    'log_channel' => env('BLUELOG_LOG_CHANNEL', 'default'),
];
```

## Usage

To use BlueLog, you can either call the logging methods directly on the `BlueLog` facade or inject the `BlueLogger` class into your services.

### Logging Methods

BlueLog provides methods for each logging level:

```php
use BlueLog;

BlueLog::debug('default', 'This is a debug message', ['context' => 'value'], ['extra' => 'value']);
BlueLog::info('default', 'This is an info message', ['context' => 'value'], ['extra' => 'value']);
BlueLog::warning('default', 'This is a warning message', ['context' => 'value'], ['extra' => 'value']);
BlueLog::error('default', 'This is an error message', ['context' => 'value'], ['extra' => 'value']);
```

### Custom Logging

## Configuration Environment Variables

## Database Migration

## Custom Channels

## License
