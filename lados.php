<?php
session_start();

if (!isset($_SESSION['tipoFigura'])) {
    header('Location: index.php');
    exit;
}

$tipofigura = $_SESSION['tipoFigura'];

function validarCampo($valor)
{
    if ($valor === '') {
        return 'Este campo es obligatorio';
    }
    if (!is_numeric($valor)) {
        return 'Debes escribir un número';
    }
    if ((float)$valor <= 0) {
        return 'El número debe ser mayor que 0';
    }
    return '';
}

function validarTriangulo($a, $b, $c)
{
    if ($a >= $b + $c || $b >= $a + $c || $c >= $a + $b) {
        return 'Estos lados no forman un triángulo (cada lado debe ser menor que la suma de los otros dos)';
    }
    return '';
}

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

    <form method="post" action="lados.php" id="Lados">
    <?php
        if ($tipofigura == 'circulo') {
            echo 'Radio: <input type="text" name="lado1" id="lado1" value="' . htmlspecialchars($lado1) . '"><br>';
        } else {
            echo 'Lado 1: <input type="text" name="lado1" id="lado1" value="' . htmlspecialchars($lado1) . '"><br>';
        }
        echo '<span id="errorLado1" style="color:red">' . $errorLado1 . '</span><br>';

        if ($tipofigura == 'rectangulo' || $tipofigura == 'triangulo') {
            echo 'Lado 2: <input type="text" name="lado2" id="lado2" value="' . htmlspecialchars($lado2) . '"><br>';
            echo '<span id="errorLado2" style="color:red">' . $errorLado2 . '</span><br>';
        }

        if ($tipofigura == 'triangulo') {
            echo 'Lado 3: <input type="text" name="lado3" id="lado3" value="' . htmlspecialchars($lado3) . '"><br>';
            echo '<span id="errorLado3" style="color:red">' . $errorLado3 . '</span><br>';
            echo '<span id="errorTriangulo" style="color:red">' . $errorTriangulo . '</span><br>';
        }
    ?>
        <br><button type="submit">Calcular</button>
    </form>
    <p><br><a href="index.php">Volver</a></p>
</body>
</html>