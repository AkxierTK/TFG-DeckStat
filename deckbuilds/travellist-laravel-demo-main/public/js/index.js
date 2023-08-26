
let inputFiltroColores=document.querySelectorAll('.colorIP');
let inputFiltroFormato=document.querySelectorAll('.comanderIP');
inputFiltroColores.forEach(element => {
    element.addEventListener('change', function(e) {
        let color=document.getElementById("input"+element.id)
        let color2=document.getElementById("input"+element.id+"2")
        if(element.checked){
            color.checked=true;
            color2.checked=true;
        }else{
            color.checked=false;
            color2.checked=false;
        }
        
    });
});

inputFiltroFormato.forEach(element => {
    element.addEventListener('change', function(e) {
        formato=document.getElementById("input"+element.id);
        formato2=document.getElementById("input"+element.id+"2");
        if(element.checked){
            formato.checked=true;
            formato2.checked=true;
        }else{
            formato.checked=false;
            formato2.checked=false;
        }
    });
});

