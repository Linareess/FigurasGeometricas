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

    <form method="post" action="index.php" class="tarjeta">
        <p><strong>Elige el tipo de figura:</strong></p>
    <?php
        $marcado = 'checked';
        $figuras = ['triangulo' => 'Triángulo', 'rectangulo' => 'Rectángulo',
                    'cuadrado' => 'Cuadrado', 'circulo' => 'Círculo'];

        foreach ($figuras as $valor => $nombre) {
            echo '<label class="opcion"><input type="radio" name="tipoFigura" value="' . $valor . '" '
                . ($tipoActual == $valor ? $marcado : '') . '> ' . $nombre . '</label>';
        }
    ?>
        <div class="acciones">
            <button type="submit" class="btn btn-primary btn-block">Continuar →</button>
        </div>
    </form>
</body>
</html>