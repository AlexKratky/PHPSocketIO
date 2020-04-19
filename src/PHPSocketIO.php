<?php

/**
 * @name Cache.php
 * @link https://alexkratky.cz                          Author website
 * @link https://panx.eu/docs/                          Documentation
 * @link https://github.com/AlexKratky/panx-framework/  Github Repository
 * @author Alex Kratky <alex@panx.dev>
 * @copyright Copyright (c) 2020 Alex Kratky
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @description PHP class to with Socket.io. Part of panx-framework.
 */

declare(strict_types=1);

namespace AlexKratky;

class PHPSocketIO
{

    private static $ip = "localhost";
    private static $port = 8000;
    private static $password = "";
    private static $secured = false;

    public static function setIp($ip) {self::$ip = $ip;}
    public static function setPort($port) {self::$port = $port;}
    public static function setPassword($password) {self::$password = $password;}
    public static function setSecured($secured) {self::$secured = $secured;}

    public function __construct($ip, $port, $password, $secured) {
        self::$ip = $ip;
        self::$port = $port;
        self::$password = $password;
        self::$secured = $secured;
    }

    public function sendData($channel, $data) {

        $url = (self::$secured ? 'https://' : 'http://') . self::$ip . ":" . self::$port;

        $ch = curl_init();

        $POST = ["channel" => $channel, "password" => self::$password, "data" => json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT)];

        $POST_string = null;

        foreach ($POST as $key => $value) {
            $POST_string .= $key . '=' . $value . '&';
        }
        rtrim($POST_string, '&');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($POST));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POST_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response == "true";
    }

}
