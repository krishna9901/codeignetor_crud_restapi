# codeignetor_crud_restapi
Demonstrating crud rest api in codeigniter3

/**step 1: Create Database and Table**/
```
create database rest_api;

CREATE TABLE tbl_sample (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    details VARCHAR(255) NOT NULL,
    datetime DATETIME
);

```
/**step2 :Make Database Connetion  in application/config/database.php**/
```
<?php

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
 'dsn' => '',
 'hostname' => 'localhost',
 'username' => 'root',
 'password' => '',
 'database' => 'rest_api',
 'dbdriver' => 'mysqli',
 'dbprefix' => '',
 'pconnect' => FALSE,
 'db_debug' => (ENVIRONMENT !== 'production'),
 'cache_on' => FALSE,
 'cachedir' => '',
 'char_set' => 'utf8',
 'dbcollat' => 'utf8_general_ci',
 'swap_pre' => '',
 'encrypt' => FALSE,
 'compress' => FALSE,
 'stricton' => FALSE,
 'failover' => array(),
 'save_queries' => TRUE
);

?>
```

/**step3: configure base url application/config/config.php**/
```
$config['base_url'] = 'http://localhost/coderestapi';


```
/**Crud Rest_api List**/

```
--http://localhost/coderestapi/api/insert
--http://localhost/coderestapi/api
--http://localhost/coderestapi/api/delete
--http://localhost/coderestapi/api/update
--http://localhost/coderestapi/api/fetch_single

```

/**output screenshot**/

![image](https://github.com/krishna9901/codeignetor_crud_restapi/assets/54264561/ea02a5df-d77f-45b5-bb5d-a58c057a826c)

![image](https://github.com/krishna9901/codeignetor_crud_restapi/assets/54264561/99452d50-9229-4bbe-8d3a-f444744d8c42)

![image](https://github.com/krishna9901/codeignetor_crud_restapi/assets/54264561/d929bd87-18c4-4c7f-9bef-61955e55af4c)

![image](https://github.com/krishna9901/codeignetor_crud_restapi/assets/54264561/cc6b33bf-36b1-486e-96a8-eb0a3f2d1e69)











