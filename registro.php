<?php
require("conexion.php");
if (isset($_POST['registro_evento'])) {
    $doc = $_POST['doc'];
    $nom = $_POST['nom'];
    $ape = $_POST['ape'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $emp = $_POST['emp'];
    $car = $_POST['car'];
    $pro = $_POST['pro'];

    $sql = "INSERT INTO clientes (documento, nombres, apellidos, movil, correo, empresa, cargo, profesion) 
            VALUES ('$doc', '$nom', '$ape', '$tel', '$mail', '$emp', '$car', '$pro')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "success";
        $datos_qr = "Asistente: $nom $ape | ID: $doc";
    }
}
$res_count = $conn->query("SELECT COUNT(*) as total FROM clientes");
$total = ($res_count) ? $res_count->fetch_assoc()['total'] : 0;
?>
<head>
    <link rel="stylesheet" href="estilo/estilo2.css">
</head>
<?php if ($mensaje == "success"): ?>
    <div class="tarjeta-exito" style="text-align:center; background:white; padding:20px;">
        <h3>¡Registro Exitoso!</h3>
        
        <?php 
            
            include('phpqrcode/qrlib.php');
            
            $folder = 'temp/';
            if (!file_exists($folder)) mkdir($folder);
            
            
            $filename = $folder . 'qr_' . $doc . '.png';
            
            $datos_invitado = "---------------------------\n" .
                  "  REGISTRO CONFIRMADO      \n" .
                  "---------------------------\n" .
                  "ASISTENTE: " . strtoupper($nom) . "\n" .
                  "CEDULA:    " . $doc . "\n" .
                  "FECHA:     " . date("d-m-Y") . "\n" .
                  "---------------------------";

            QRcode::png($datos_invitado, $filename, QR_ECLEVEL_M, 8, 4);
        ?>
        
        <p>Tu pase de entrada:</p>
        <div class="contenedor-qr">
        <img class= "imagen-qr"src="<?php echo $filename; ?>?v=<?php echo time(); ?>">
        </div>
        
        <p class="id-asistente">ID: <?php echo $doc; ?></p>
        <button onclick="window.print()" class="btn-imprimir">Imprimir</button>
    </div>
<?php endif; ?>