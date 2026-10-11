<?php
session_start();

if (!isset($_SESSION['tipoFigura']) || !isset($_SESSION['lado1'])) {
    header('Location: index.php');
    exit;
}

require_once 'clases/Triangulo.php';
require_once 'clases/Rectangulo.php';
require_once 'clases/Cuadrado.php';
require_once 'clases/Circulo.php';

$tipo = $_SESSION['tipoFigura'];
$lado1 = $_SESSION['lado1'];
$lado2 = $_SESSION['lado2'] ?? 0;
$lado3 = $_SESSION['lado3'] ?? 0;

if ($tipo == 'triangulo') {
    $figura = new Triangulo($tipo, $lado1, $lado2, $lado3);
} elseif ($tipo == 'rectangulo') {
    $figura = new Rectangulo($tipo, $lado1, $lado2);
} elseif ($tipo == 'cuadrado') {
    $figura = new Cuadrado($tipo, $lado1);
} else {
    $figura = new Circulo($tipo, $lado1);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <?php include 'header/header.php'; ?>

    <h1>Resultados</h1>

    <?php
        echo '<p>Tipo de figura: ' . ucfirst($figura->getTipoFigura()) . '</p>';
        echo '<p>Descripción: ' . $figura . '</p>';
        echo '<p>Área: ' . round($figura->calcularArea(), 2) . '</p>';
        echo '<p>Perímetro: ' . round($figura->calcularPerimetro(), 2) . '</p>';
    ?>

    <p><a href="lados.php">Modificar los datos</a></p>
    <p><a href="index.php">Elegir otra figura</a></p>
</body>
</html>