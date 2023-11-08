<?php

namespace App\Functions;

class Message
{
    public static function success($message)
    {
        return "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>x</button>{$message}</div>";
    }

    public static function error($message)
    {
        return "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>x</button>{$message}</div>";
    }

    public static function warning($message)
    {
        return "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert'>x</button>{$message}</div>";
    }

    public static function info($message)
    {
        return "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>x</button>{$message}</div>";
    }

}