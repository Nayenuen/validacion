<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "validacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Error de conexión: " . $conn->connect_error);
}
    if($_SERVER ["REQUEST_METHOD"]=="POST"){
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);

        $encrytion_key = "clave_secreta";

        $sql = "INSERT INTO usuarios (nombre, apellidos) VALUES(
        AES_ENCRYPT ('$nombre','$encrytion_key'),
        AES_ENCRYPT ('$apellidos','$encrytion_key'))";


    if($conn->query($sql)===TRUE){
        echo "Datos insertados correctamente";
    }else{
        echo "Error al insertar datos" . $conn->connect_error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    

<form action = "validacion.php" method = "POST">
    Nombre: <input type ="text" name="nombre" required><br>
    Apellidos: <input type ="text" name="apellidos" required><br>

    <input type= "submit" value="Enviar"/><br>
</form>
</body>
</html>