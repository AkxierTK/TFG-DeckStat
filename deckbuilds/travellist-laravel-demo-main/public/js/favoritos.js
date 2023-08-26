
let corazon=document.getElementById("heart");
let mazoIndex=document.getElementById("favoritoMazo");
let mazoEnviar;

mazoEnviar=parseInt(mazoIndex.value);
corazon.addEventListener("change",function(e){
    e.preventDefault();
    var mazoID=mazoEnviar;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "http://localhost:8000/mazo/favorito",// ó {{url(/admin/empresa)}} depende a tu peticion se dirigira a el index(get) o tu store(post) de tu controlador 
        data: {
            mazoID: mazoID
        },
        success: function (msg) {
        }
    });
});

