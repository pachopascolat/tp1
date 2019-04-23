

function validar(e){
    // e.preventDefault();
    if(validarNombre() && validarEdad() && validarRadio() ){
        var form = document.getElementById('form');
        form.submit();
    }

}

function validarNombre(){
    var input = document.getElementById('nombre');
    var nombre = input.value;
    if(nombre.length < 3){
        //var inputError = document.getElementById('error-nombre');
        //inputError.innerHTML = "ingrese un nombre de 3 o mas caracteres";
        alert("ingrese un nombre de 3 o mas caracteres")
        return false
    }
    return true;
    // nombre.length < 3? return false : return true
}

function validarEdad(){
    var input = document.getElementById('edad');
    var edad = input.value ;
    if(isInteger(edad)){
        return true;
    }
    alert("la edad debe ser un numero");
    return false;
}

function validarRadio(){
    // var input = $('input[name=sexo]:checked').val();

    var input = document.getElementsByName('sexo');
    for (var i = 0 ; i < input.length ; i++){
        if(input[i].checked){
            return true;
        }
    }
    alert ("debe ingresar una opcion de sexo");
    return false;
}


function isInteger(valor){
    if(valor % 1 == 0 && valor.length > 0){
        return true;
    }
    return false;
}