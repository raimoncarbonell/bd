<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd</title>
    </head>
    <body>
        <h1>Creación de una bd</h1>
        <?php
        /* Nos conectamos al SGBD */
        try{
            $conexion = new PDO("mysql:host=localhost", "root");
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }
        
        /* borrar base de datos */
        $sql = "drop database if exists entrega;";
        $res = $conexion->exec($sql);
        
        
        /* Crear la BD */
        $sql = "create database entrega;";
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la base de datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>base de datos creada.</p>";
        }
        
        /* Conectar a la base de datos */
        $sql = "use entrega;";
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido conectar a la base de datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Conectados!!!!</p>";
        }
        
        /* Crear tabla Contactos */
        $sql = <<<sql
create table Contactos(
    id int primary key auto_increment,
    nombre varchar(20) not null,
    mail varchar(20) not null
);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la tabla Contactos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Tabla Contactos  creada!!!</p>";
        }
        
        
        /* Insert datos tabla contactos */
       $sql ="insert into Contactos(id,nombre,mail) values ('','raimon','raimon12@yahoo.es'), ('','pere','pere12@gmail.com'),('','Pau','pau12@gmail.com');";
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>Error al añadir datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Se han añadido $res filas</p>";
        }
        
         try{
            $con = new PDO("mysql:host=localhost;dbname=entrega", "root");
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
         }
        ?>
        <table>
        <tr>
        <th>Id</th><th>nombre</th><th>mail</th>   
        </tr>   
        <?php
       
            // lista de contactos de la Bd 
        $sql = "select * from Contactos";
        $res = $con->query($sql);
        foreach($res as $fila){
        echo "<tr>";
            
        echo "<td>${fila['id']}</td><td>${fila['nombre']}</td><td>${fila['mail']}</td>";
            
           
        echo "</tr>";
            
        }
      
        ?>
            </table>
    </body>
</html>