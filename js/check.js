function validar_campos() {             
    if (form1.pass1.value == ""){
        alert("Complete la Contraseña");
        form1.pass1.focus();
        return (false);
    }
    if (form1.pass1.value.length < 4){
        alert("La contraseña debe ser mayor de 4 digitos")
        form1.pass1.focus();
        return (false);
    }

    if (form1.pass2.value == ""){
        alert("Debe confirmar la contraseña");
        form1.pass2.focus();
        return (false);
    } 

    if (form1.pass1.value != form1.pass2.value){
        alert("La contraseña confirmada no concuerda con la contraseña escrita");
        form1.pass2.focus();
        return (false);
    }
}