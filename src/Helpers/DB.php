<?php

namespace DarkTec\Helpers;

use Aura\SqlQuery\QueryFactory;
use PDO;

class DB
{

    private static $queryFactory = null;

    public static function init() {
        self::$queryFactory = new QueryFactory('mysql');
    }

    public static function execute($query)
    {
        $config = Container::getInstance()->get('config')['database'];


        $dsn = "mysql:dbname=$config[database];host=$config[host]:$config[port]";
        $user = $config['username'];
        $password = $config['password'];

        $connection = new PDO($dsn, $user, $password);

        $queryPrep = $connection->prepare($query->getStatement());
        $queryPrep->execute($query->getBindValues());

        $result = $queryPrep->fetch(PDO::FETCH_ASSOC);
        
        $connection = null;

        return $result;
    }

    public static function select()
    {
        return self::$queryFactory->newSelect();
    }

    public static function insert() {
        return self::$queryFactory->newInsert();
    }

    public static function update() {
        return self::$queryFactory->newUpdate();
    }

    public static function delete() {
        return self::$queryFactory->newDelete();
    }
}
