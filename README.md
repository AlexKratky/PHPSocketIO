# PHPSocketIO

Class to work with cache.

### Installation

`composer require alexkratky/php-socketio`

### Usage

```php
require 'vendor/autoload.php';

use AlexKratky\PHPSocketIO;
$ip = "localhost";
$port = 8000;
$password = "password";
$secured = true; //https?
$channel = "room1";
$data = array(
    "ID" => 1,
    "name" => "Alex"
);

$socket = new PHPSocketIO($ip, $port, $password, $secured);
$socket->sendData($channel, $data);
```
