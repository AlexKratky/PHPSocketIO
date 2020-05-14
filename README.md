# PHPSocketIO

Class to work with realtime socket (Socket.io).

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

### NodeJS implementation
You can get inspired by NodeJS implementation by [here](https://github.com/AlexKratky/realtime-logger/blob/master/realtime-logger.js).
In general, you need to handle HTTP POST requests.

```js
var fs = require('fs');
var http = require('http');
var bodyParser = require("body-parser");
var express = require('express');
var app = express();
var port = 8000;

var urlencodedParser = bodyParser.urlencoded({ extended: false });
var webServer = http.createServer(app);
var io = require('socket.io').listen(webServer, { log: false });

app.post('/', urlencodedParser, function (req, res) {
    if (!req.body) return res.sendStatus(400);
    var post = req.body;
    if (post.password == config.password) {
        io.emit(post.channel, JSON.parse(post.data));
        res.send('true');
    } else {
        res.sendStatus(400);
    }
});
```