function validarCampo(campo, spanError) {
    valor = campo.value.trim();

    spanError.style.color = 'red';

    if (valor === '') {
        spanError.textContent = 'Este campo es obligatorio';
        return false;
    }

    if (isNaN(valor)) {
        spanError.textContent = 'Debes escribir un número';
        return false;
    }

    if (Number(valor) <= 0) {
        spanError.textContent = 'El número debe ser mayor que 0';
        return false;
    }

    spanError.textContent = '';
    return true;
}

function validarTriangulo() {
    campo1 = document.getElementById('lado1');
    campo2 = document.getElementById('lado2');
    campo3 = document.getElementById('lado3');
    spanError = document.getElementById('errorTriangulo');


    if (spanError === null) {
        return true;
    }

    a = Number(campo1.value);
    b = Number(campo2.value);
    c = Number(campo3.value);

    if (isNaN(a) || isNaN(b) || isNaN(c) || a <= 0 || b <= 0 || c <= 0) {
        spanError.textContent = '';
        return true;
    }

    spanError.style.color = 'red';

    if (a >= b + c || b >= a + c || c >= a + b) {
        spanError.textContent = 'Estos lados no forman un triángulo (cada lado debe ser menor que la suma de los otros dos)';
        return false;
    }

    spanError.textContent = '';
    return true;
}
function prepararCampo(idCampo, idError) {
    campo = document.getElementById(idCampo);
    spanError = document.getElementById(idError);

    if (campo === null) {
        return;
    }

    campo.onblur = function () {
        validarCampo(campo, spanError);
        validarTriangulo();
    };
}

prepararCampo('lado1', 'errorLado1');
prepararCampo('lado2', 'errorLado2');
prepararCampo('lado3', 'errorLado3');


document.getElementById('Lados').onsubmit = function (evento) {
    todoCorrecto = true;
    ids = ['1', '2', '3'];

    for (i = 0; i < ids.length; i++) {
        campo = document.getElementById('lado' + ids[i]);
        spanError = document.getElementById('errorLado' + ids[i]);

        if (campo !== null) {
            if (validarCampo(campo, spanError) === false) {
                todoCorrecto = false;
            }
        }
    }

    if (validarTriangulo() === false) {
        todoCorrecto = false;
    }

    if (todoCorrecto === false) {
        evento.preventDefault();
    }
};