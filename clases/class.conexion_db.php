<?php
/* Project: SIELDI
 * File: conexion_db.php
 * Created on Sep 9, 2009
 * Author: Norman E. Acosta Fonseca e-mai: norman41@gmail.com
 * Description: Clase para instanciar el objeto de coneccion de ADOdb
 * 
 */
 
 require_once(dirname(__FILE__).'/../config.php');
 include(dirname(__FILE__).'/../lib/adodb5/adodb-exceptions.inc.php' ); //include exceptions for php5
 include(dirname(__FILE__).'/../lib/adodb5/adodb.inc.php' );
 define('ADODB_ASSOC_CASE', 2);

class conexion_db extends ADOConnection
{
	/*
	 * Objeto a instanciar.
	 */
	static $db;
	/*
	 * Constructor
	 */
	static public function getInstance(){
        if(!isset(self::$db)){
            try {
                self::$db = NewADOConnection(db_type);
                self::$db -> PConnect(db_server, db_user,db_password,db_name);
                //self::$db -> Connect(db_server,db_user,db_password,db_name);
            } catch (exception $e) {
                var_dump($e);
                adodb_backtrace($e->gettrace());
            }
        }
        return self::$db;
    }
}
 
?>
