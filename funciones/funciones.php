<?php

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

?>