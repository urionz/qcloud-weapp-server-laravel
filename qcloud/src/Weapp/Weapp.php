<?php
namespace Urionz\Qcloud\Weapp;

use QCloud_WeApp_SDK\Auth\LoginService;

class Weapp
{
    public function login()
    {
        return LoginService::login();
    }

    public function check()
    {
        return LoginService::check();
    }

    public function authLoginInstance()
    {
        return LoginService::class;
    }
}