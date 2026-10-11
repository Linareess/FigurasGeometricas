<?php
session_start();

if (!isset($_SESSION['tipoFigura'])) {
    header('Location: index.php');
    exit;
}

$tipo = $_SESSION['tipoFigura'];

if (isset($_POST['lado1'])) {
    $_SESSION['lado1'] = $_POST['lado1'];

    if (isset($_POST['lado2'])) {
        $_SESSION['lado2'] = $_POST['lado2'];
    }
    if (isset($_POST['lado3'])) {
        $_SESSION['lado3'] = $_POST['lado3'];
    }

    header('Location: resultados.php');
    exit;
}

$lado1 = $_SESSION['lado1'] ?? '';
$lado2 = $_SESSION['lado2'] ?? '';
$lado3 = $_SESSION['lado3'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Introduce los lados</title>
    <script src="js/validaciones.js" defer></script>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <?php include 'header/header.php'; ?>

    <form method="post" action="lados.php" id="formLados">
    <?php
        if ($tipo == 'circulo') {
            echo 'Radio: <input type="text" name="lado1" id="lado1" value="' . $lado1 . '"><br>';
        } else {
            echo 'Lado 1: <input type="text" name="lado1" id="lado1" value="' . $lado1 . '"><br>';
        }
        echo '<span id="errorLado1"></span><br>';

        if ($tipo == 'rectangulo' || $tipo == 'triangulo') {
            echo 'Lado 2: <input type="text" name="lado2" id="lado2" value="' . $lado2 . '"><br>';
            echo '<span id="errorLado2"></span><br>';
        }

        if ($tipo == 'triangulo') {
            echo 'Lado 3: <input type="text" name="lado3" id="lado3" value="' . $lado3 . '"><br>';
            echo '<span id="errorLado3"></span><br>';
            echo '<span id="errorTriangulo"></span><br>';
        }
    ?>
        <br><button type="submit">Calcular</button>
    </form>
    <p><br><a href="index.php">Volver</a></p>
</body>
</html>