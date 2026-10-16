<?php
session_start();
include 'funciones/funciones.php';

if (!isset($_SESSION['tipoFigura'])) {
    header('Location: index.php');
    exit;
}

$tipofigura = $_SESSION['tipoFigura'];


$lado1 = $_SESSION['lado1'] ?? '';
$lado2 = $_SESSION['lado2'] ?? '';
$lado3 = $_SESSION['lado3'] ?? '';

$errorLado1 = '';
$errorLado2 = '';
$errorLado3 = '';
$errorTriangulo = '';

if (isset($_POST['lado1'])) {
    $lado1 = trim($_POST['lado1']);
    $errorLado1 = validarCampo($lado1);

    if ($tipofigura == 'rectangulo' || $tipofigura == 'triangulo') {
        $lado2 = trim($_POST['lado2'] ?? '');
        $errorLado2 = validarCampo($lado2);
    }

    if ($tipofigura == 'triangulo') {
        $lado3 = trim($_POST['lado3'] ?? '');
        $errorLado3 = validarCampo($lado3);

        if ($errorLado1 == '' && $errorLado2 == '' && $errorLado3 == '') {
            $errorTriangulo = validarTriangulo((float)$lado1, (float)$lado2, (float)$lado3);
        }
    }

    if ($errorLado1 == '' && $errorLado2 == '' && $errorLado3 == '' && $errorTriangulo == '') {
        $_SESSION['lado1'] = $lado1;

        if ($tipofigura == 'rectangulo' || $tipofigura == 'triangulo') {
            $_SESSION['lado2'] = $lado2;
        }
        if ($tipofigura == 'triangulo') {
            $_SESSION['lado3'] = $lado3;
        }

        header('Location: resultados.php');
        exit;
    }
}
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

    <form method="post" action="lados.php" id="Lados" class="tarjeta">
    <?php
        $etiqueta1 = ($tipofigura == 'circulo') ? 'Radio' : 'Lado 1';
        echo '<div class="campo"><label for="lado1">' . $etiqueta1 . '</label>';
        echo '<input type="text" name="lado1" id="lado1" value="' . htmlspecialchars($lado1) . '">';
        echo '<span class="error" id="errorLado1">' . $errorLado1 . '</span></div>';

        if ($tipofigura == 'rectangulo' || $tipofigura == 'triangulo') {
            echo '<div class="campo"><label for="lado2">Lado 2</label>';
            echo '<input type="text" name="lado2" id="lado2" value="' . htmlspecialchars($lado2) . '">';
            echo '<span class="error" id="errorLado2">' . $errorLado2 . '</span></div>';
        }

        if ($tipofigura == 'triangulo') {
            echo '<div class="campo"><label for="lado3">Lado 3</label>';
            echo '<input type="text" name="lado3" id="lado3" value="' . htmlspecialchars($lado3) . '">';
            echo '<span class="error" id="errorLado3">' . $errorLado3 . '</span>';
            echo '<span class="error" id="errorTriangulo">' . $errorTriangulo . '</span></div>';
        }
    ?>
        <div class="acciones">
            <button type="submit" class="btn btn-primary">Calcular</button>
            <a href="index.php" class="btn btn-ghost">← Volver</a>
        </div>
    </form>
</body>
</html>