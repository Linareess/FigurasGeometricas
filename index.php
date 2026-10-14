<?php
session_start();

if (isset($_POST['tipoFigura'])) {
    if (isset($_SESSION['tipoFigura']) && $_SESSION['tipoFigura'] != $_POST['tipoFigura']) {
        unset($_SESSION['lado1'], $_SESSION['lado2'], $_SESSION['lado3']);
    }
    $_SESSION['tipoFigura'] = $_POST['tipoFigura'];
    header('Location: lados.php');
    exit;
}

$tipoActual = $_SESSION['tipoFigura'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Elige una figura</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <h1>Figuras geométricas</h1>

    <form method="post" action="index.php">
        <p>Elige el tipo de figura:</p>
    <?php
        $marcado = 'checked';

        echo '<input type="radio" name="tipoFigura" value="triangulo"' . ($tipoActual == 'triangulo' ? $marcado : '') . '> Triángulo<br>';
        echo '<input type="radio" name="tipoFigura" value="rectangulo"' . ($tipoActual == 'rectangulo' ? $marcado : '') . '> Rectángulo<br>';
        echo '<input type="radio" name="tipoFigura" value="cuadrado"' . ($tipoActual == 'cuadrado' ? $marcado : '') . '> Cuadrado<br>';
        echo '<input type="radio" name="tipoFigura" value="circulo"' . ($tipoActual == 'circulo' ? $marcado : '') . '> Círculo<br>';
    ?>
        <button type="submit">Continuar</button>
    </form>
</body>
</html>