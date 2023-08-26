let mostrar= document.getElementById("password");
let checkbox=document.getElementById("checkbox");

checkbox.addEventListener("change",function(e){
    if (checkbox.checked){
        mostrar.type="text";
    }else{
        mostrar.type="password";
    }
});