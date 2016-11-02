<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
         <link href="estilos.css" rel="stylesheet">
        <title>Alumnos</title>
    </head>
    <body>
        <h1>Datos contactos</h1>
       
        <table>
            <tr>
        <th>Id</th><th>nombre</th><th>mail</th><th>Eliminar Contacto</th>    
        </tr>
        <?php
            // conexion a la BD
            try{
            $con = new PDO("mysql:host=localhost;dbname=entrega", "root");
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
                 }
            
            if(isset ($_GET['id']))
            { 
              // quando pulsamos a eliminar pasamos una URL por get i se elimina de la Bdd  
                 
       
            $id=$_GET['id'];
              $sql = "DELETE FROM contactos WHERE id =$id;";   // sql para eliminar usuario segun su id 
            $res=$con->exec($sql);
            if($res==0){
                echo "<div class='error'>error en la eliminacion </div>";

            }else{
                 echo "<div class='valido'>se ha eliminado correctamente</div>";
            }
                 }
   
         if(isset ($_GET['busqueda']))
        {
            // busqueda de usuario segun cadena 
        $txt=$_GET['busqueda'];
          $sql = "select * from contactos where mail like '%$txt%' or nombre like '%$txt%' ";
        
         } 
        else
        {
         // SQL para lista de contactos de la BD
        $sql = "select * from Contactos";
     
        }
        
         $res = $con->query($sql);  // ejecuta la setencia SQL 
        // muestra los datos en la tabla    
        foreach($res as $fila){
        echo "<tr>";
            
        echo "<td>${fila['id']}</td><td>${fila['nombre']}</td><td>${fila['mail']}</td>";
            
            echo "<td><a href='index.php?id=${fila['id']}'>Eliminar</a></td>";
        echo "</tr>";
            
        }
        

        ?>
            
            <form method="get" action="index.php">
            <label>texto a buscar :</label>
            <input type="text" name="busqueda">
            <input type="submit" value="busqueda">
            </form>
        </table>
        <a href="nuevocontacto.php">nuevo contacto </a>
    </body>
</html>