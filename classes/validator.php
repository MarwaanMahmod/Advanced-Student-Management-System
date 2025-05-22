<?php
class Validator
{
    public static function sanitize($data)
    {
        return htmlspecialchars(trim($data));
    }

    public static function required($value)
    {
        return !empty($value);
    }

    public static function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
