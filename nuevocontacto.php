<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link href="estilos.css" rel="stylesheet">
        <title>crear bd</title>
    </head>
    <body>
        <h1>Nuevo Contacto</h1>
        <?php
        
                
if((!isset($_GET['nombre'])) and (!isset($_GET['mail']))  )
{
    
      CargarForm () ;
        
}
else
{
        $nombre=$_GET['nombre'];
        $mail=$_GET['mail'];
    
         $sql = "select * from Contactos where nombre='$nombre' && mail='$mail' ";
        try{
            $con = new PDO('mysql:host=localhost;dbname=entrega', "root");
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>";
            die();
        }
       
        $res = $con->query($sql);
        if($res===FALSE)
        {
            echo "<div class='error'>Error al consultar la BD</div>";
           
        }
        else
        {

                $num=$res->rowCount();

                if($num!=0)
                {
                        echo "<div class='error'>Este usuario ja esta en la Bdd</div>";
                        CargarForm () ;
                }
                else
                {

                     $sql =" insert into Contactos (nombre,mail) values ('$nombre','$mail');";
                    $res = $con->exec($sql);
                    if($res===FALSE){
                        echo "<div class='error'> Error al añadir los datos del contacto</div>";
                        CargarForm () ;
                    }else{


                       echo "<div class='valido'>se ha añadido del contado correctament</div>";
                        CargarForm () ;
                    }
                }
        }
    
           
            
}
        function CargarForm () 
        {
        ?>
         <form method="get" action="nuevocontacto.php">
            <label>nombre</label>
            <input type="text" name="nombre">
            <label>mail</label>
            <input type="text" name="mail">
            <input type="submit" value="añadir nuevo contacto">
            </form>
        
        <?php
        
        }
        
        

        ?>
        
        
    
        <a href="index.php">Volver al index</a>
    </body>
</html>
