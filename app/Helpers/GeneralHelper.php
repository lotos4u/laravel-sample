<?php
namespace App\Helpers;


use Illuminate\Support\Facades\Session;

class GeneralHelper
{
    public static function addInfo($message, $isTemporary = true)
    {
        $key = self::combineKeyName('info', $isTemporary);
        self::addSessionMessage($key, $message);
    }

    public static function addSuccess($message, $isTemporary = true)
    {
        $key = self::combineKeyName('success', $isTemporary);
        self::addSessionMessage($key, $message);
    }

    public static function addError($message, $isTemporary = true)
    {
        $key = self::combineKeyName('danger', $isTemporary);
        self::addSessionMessage($key, $message);
    }

    public static function addWarning($message, $isTemporary = true)
    {
        $key = self::combineKeyName('warning', $isTemporary);
        self::addSessionMessage($key, $message);
    }

    private static function combineKeyName($type = 'success', $isTemporary = true)
    {
        $prefix = $isTemporary ? 'flash_temporary' : 'flash_fixed';
        return $prefix . '.' . $type;
    }

    private static function addSessionMessage($key, $message)
    {
        Session::flash($key, $message);
    }
}