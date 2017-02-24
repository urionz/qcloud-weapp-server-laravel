<?php
namespace Urionz\Qcloud\Facades;

use Illuminate\Support\Facades\Facade;
use Urionz\Qcloud\Weapp\Weapp;

class WeappFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Weapp::class;
    }
}