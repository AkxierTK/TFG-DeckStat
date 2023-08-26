let mostrar= document.getElementById("password");
let mostrar2= document.getElementById("password-confirm");
let checkbox=document.getElementById("checkbox");

checkbox.addEventListener("change",function(e){
    if (checkbox.checked){
        mostrar.type="text";
        mostrar2.type="text";
    }else{
        mostrar.type="password";
        mostrar2.type="password";
    }
});