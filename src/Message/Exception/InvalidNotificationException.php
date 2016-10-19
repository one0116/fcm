<?php
namespace Kerox\Fcm\Message\Exception;

/**
 * Class InvalidNotificationException
 * @package Kerox\Fcm\Message\Exception
 */
class InvalidNotificationException extends AbstractException
{

    public static function invalidColor()
    {
        return new static("The color must be expressed in #rrggbb format.");
    }

    public static function invalidArray()
    {
        return new static("Notification array must contain at least a key 'title'");
    }
}
