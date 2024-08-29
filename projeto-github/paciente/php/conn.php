<?php 
    define("host" ,"localhost");
    define("user","root");
    define("password","");
    define("Database","producao");
    try {   
        $conn=new PDO("mysql:host=".host.";dbname=".Database.";charset=utf8",user,password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        } catch (PDOException $e) {    
            error_log("Erro na conexão com o BD" .$e->getMessage());
           print_r($e);
        }catch (Exception $e) { 
            print_r($e);  
        }


