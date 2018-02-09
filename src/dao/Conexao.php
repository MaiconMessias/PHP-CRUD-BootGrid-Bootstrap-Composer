<?php

namespace dao;

/**
 * Conection Factory
 *
 * @author Maicon Messias
 */
class Conexao {
    private static $conPostgre;
    private static $hostPostgre = "localhost";
    private static $dbNamePostgre = "DBCRUDJsfPrimefacesHibernate";
    private static $userPostgre = "postgres";
    private static $passwordPostgre = "rootnnnn";
    
    
    public function __construct() {}
    
    public static function openConPostgre() {
        self::$conPostgre = pg_connect("host=".self::$hostPostgre." dbname=".self::$dbNamePostgre.
                                " user=".self::$userPostgre." password=".self::$passwordPostgre);    
        return self::$conPostgre;
    }

    public static function closeConPostgre() {
        pg_close(self::$conPostgre);
    }
}
