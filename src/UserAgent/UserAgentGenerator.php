<?php

namespace CaioFRAlmeida\DfXplScanner\UserAgent;

class UserAgentGenerator
{
    /**
     * @var array
     */
    protected static $list;

    /**
     * @return string
     */
    public static function getRandom()
    {
        self::$list = self::getList();
        return self::$list[array_rand(self::$list)];
    }

    /**
     * @return array
     */
    protected static function getList()
    {
        if (self::$list == null) {
            self::$list = require_once __DIR__ . '/../../app-config/user-agents.php';
        }

        return self::$list;
    }
}
