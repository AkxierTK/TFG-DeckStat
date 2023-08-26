//*********Carga de variables********************* */
//elementos contenedores o de diseño
let divLista = document.getElementsByClassName("divLista");
 let loading = document.getElementById("loading");
 loading.style.display = "block";
let portadaMazo= document.getElementById("eliminarPortada");
portadaMazo.style.display="none";
//formulario
let formato = document.getElementById("formato");
let total = document.getElementById("total");
let listado = document.getElementById("listado");
let nombreMazo= document.getElementById("nombreMazo");
let estado  = "publico";
let descripcion = document.getElementById("descripcion");
let editarB= document.getElementById("editarB");
let editarDiv = document.getElementById("editar");
let vista = document.getElementById("vista");
descripcion.style.display="none"
//arrays
let idCartas = [];
let unidadCartas = new array();
let colores = [];
let insultos = ["4r5e", "5h1t", "5hit", "a55", "anal", "anus", "ar5e", "arrse", "arse", "ass", "ass-fucker", "asses", "assfucker", "assfukka", "asshole", "assholes", "asswhole", "a_s_s", "b!tch", "b00bs", "b17ch", "b1tch", "ballbag", "balls", "ballsack", "bastard", "beastial", "beastiality", "bellend", "bestial", "bestiality", "bi+ch", "biatch", "bitch", "bitcher", "bitchers", "bitches", "bitchin", "bitching", "bloody", "blow job", "blowjob", "blowjobs", "boiolas", "bollock", "bollok", "boner", "boob", "boobs", "booobs", "boooobs", "booooobs", "booooooobs", "breasts", "buceta", "bugger", "bum", "bunny fucker", "butt", "butthole", "buttmuch", "buttplug", "c0ck", "c0cksucker", "carpet muncher", "cawk", "chink", "cipa", "cl1t", "clit", "clitoris", "clits", "cnut", "cock", "cock-sucker", "cockface", "cockhead", "cockmunch", "cockmuncher", "cocks", "cocksuck", "cocksucked", "cocksucker", "cocksucking", "cocksucks", "cocksuka", "cocksukka", "cok", "cokmuncher", "coksucka", "coon", "cox", "crap", "cum", "cummer", "cumming", "cums", "cumshot", "cunilingus", "cunillingus", "cunnilingus", "cunt", "cuntlick", "cuntlicker", "cuntlicking", "cunts", "cyalis", "cyberfuc", "cyberfuck", "cyberfucked", "cyberfucker", "cyberfuckers", "cyberfucking", "d1ck", "damn", "dick", "dickhead", "dildo", "dildos", "dink", "dinks", "dirsa", "dlck", "dog-fucker", "doggin", "dogging", "donkeyribber", "doosh", "duche", "dyke", "ejaculate", "ejaculated", "ejaculates", "ejaculating", "ejaculatings", "ejaculation", "ejakulate", "f u c k", "f u c k e r", "f4nny", "fag", "fagging", "faggitt", "faggot", "faggs", "fagot", "fagots", "fags", "fanny", "fannyflaps", "fannyfucker", "fanyy", "fatass", "fcuk", "fcuker", "fcuking", "feck", "fecker", "felching", "fellate", "fellatio", "fingerfuck", "fingerfucked", "fingerfucker", "fingerfuckers", "fingerfucking", "fingerfucks", "fistfuck", "fistfucked", "fistfucker", "fistfuckers", "fistfucking", "fistfuckings", "fistfucks", "flange", "fook", "fooker", "fuck", "fucka", "fucked", "fucker", "fuckers", "fuckhead", "fuckheads", "fuckin", "fucking", "fuckings", "fuckingshitmotherfucker", "fuckme", "fucks", "fuckwhit", "fuckwit", "fudge packer", "fudgepacker", "fuk", "fuker", "fukker", "fukkin", "fuks", "fukwhit", "fukwit", "fux", "fux0r", "f_u_c_k", "gangbang", "gangbanged", "gangbangs", "gaylord", "gaysex", "goatse", "God", "god-dam", "god-damned", "goddamn", "goddamned", "hardcoresex", "hell", "heshe", "hoar", "hoare", "hoer", "homo", "hore", "horniest", "horny", "hotsex", "jack-off", "jackoff", "jap", "jerk-off", "jism", "jiz", "jizm", "jizz", "kawk", "knob", "knobead", "knobed", "knobend", "knobhead", "knobjocky", "knobjokey", "kock", "kondum", "kondums", "kum", "kummer", "kumming", "kums", "kunilingus", "l3i+ch", "l3itch", "labia", "lust", "lusting", "m0f0", "m0fo", "m45terbate", "ma5terb8", "ma5terbate", "masochist", "master-bate", "masterb8", "masterbat*", "masterbat3", "masterbate", "masterbation", "masterbations", "masturbate", "mo-fo", "mof0", "mofo", "mothafuck", "mothafucka", "mothafuckas", "mothafuckaz", "mothafucked", "mothafucker", "mothafuckers", "mothafuckin", "mothafucking", "mothafuckings", "mothafucks", "mother fucker", "motherfuck", "motherfucked", "motherfucker", "motherfuckers", "motherfuckin", "motherfucking", "motherfuckings", "motherfuckka", "motherfucks", "muff", "mutha", "muthafecker", "muthafuckker", "muther", "mutherfucker", "n1gga", "n1gger", "nazi", "nigg3r", "nigg4h", "nigga", "niggah", "niggas", "niggaz", "nigger", "niggers", "nob", "nob jokey", "nobhead", "nobjocky", "nobjokey", "numbnuts", "nutsack", "orgasim", "orgasims", "orgasm", "orgasms", "p0rn", "pawn", "pecker", "penis", "penisfucker", "phonesex", "phuck", "phuk", "phuked", "phuking", "phukked", "phukking", "phuks", "phuq", "pigfucker", "pimpis", "piss", "pissed", "pisser", "pissers", "pisses", "pissflaps", "pissin", "pissing", "pissoff", "poop", "porn", "porno", "pornography", "pornos", "prick", "pricks", "pron", "pube", "pusse", "pussi", "pussies", "pussy", "pussys", "rectum", "retard", "rimjaw", "rimming", "s hit", "s.o.b.", "sadist", "schlong", "screwing", "scroat", "scrote", "scrotum", "semen", "sex", "sh!+", "sh!t", "sh1t", "shag", "shagger", "shaggin", "shagging", "shemale", "shi+", "shit", "shitdick", "shite", "shited", "shitey", "shitfuck", "shitfull", "shithead", "shiting", "shitings", "shits", "shitted", "shitter", "shitters", "shitting", "shittings", "shitty", "skank", "slut", "sluts", "smegma", "smut", "snatch", "son-of-a-bitch", "spac", "spunk", "s_h_i_t", "t1tt1e5", "t1tties", "teets", "teez", "testical", "testicle", "tit", "titfuck", "tits", "titt", "tittie5", "tittiefucker", "titties", "tittyfuck", "tittywank", "titwank", "tosser", "turd", "tw4t", "twat", "twathead", "twatty", "twunt", "twunter", "v14gra", "v1gra", "vagina", "viagra", "vulva", "w00se", "wang", "wank", "wanker", "wanky", "whoar", "whore", "willies", "willy", "xrated", "xxx","4r5e", "5h1t", "5hit", "a55", "anal", "anus", "ar5e", "arrse", "arse", "ass", "ass-fucker", "asses", "assfucker", "assfukka", "gilipollas", "gilipollas", "gilipollas", "a_s_s", "b!tch", "b00bs", "b17ch", "b1tch", "ballbag", "bolas", "ballsack", "bastard", "bestial", "bestiality", "bellend", "bestial", "bestiality", "bi+ch", "biatch", "bitch", "bitcher", "bitchers", "perras", "perra", "perra", "maldita sea", "mamada", "mamada", "mamadas", "boiolas", "bollock", "bollok", "erección", "teta", " boobs", "booobs", "boooobs", "booooobs", "booooooobs", "pechos", "buceta", "bugger", "bum", "bunny fucker", "butt", "butthole", "buttmuch ", "buttplug", "c0ck", "c0cksucker", "carpet muncher", "cawk", "chink", "cipa", "cl1t", "clit", "clitoris", "clits", "cnut" , "polla", "chupapollas", "carapolla", "cabezapolla", "masturbapollas", "mascarpollas", "pollas", "chupapollas", "chupapollas", "chupapollas", "chupapollas", "chupapollas" , "cocksuka", "cocksukka", "cok", "cokmuncher", "coksucka", "coon", "cox", "crap", "cum", "cum mer", "correrse", "corre", "corrida", "cunilingus", "cunillingus", "cunnilingus", "coño", "lamer coño", "lamer coño", "lamer coño", "coños", "cyalis" , "cyberfuc", "cyberfuck", "cyberfuck", "cyberfucker", "cyberfuckers", "cyberfucking", "d1ck", "maldita sea", "polla", "gilipollas", "dildo", "dildos", " dink", "dinks", "dirsa", "dlck", "fucker-dog", "doggin", "dogging", "donkeyribber", "doosh", "duche", "dyke", "eyaculate", " eyaculado", "eyaculado", "eyaculado", "eyaculado", "eyaculado", "eyaculado", "f u c k", "f u c k e r", "f4nny", "maricón", "maricón", "faggitt", "maricón" , "maricón", "maricón", "maricón", "maricón", "fanny", "fannyflaps", "fannyfucker", "fanyy", "fatass", "fcuk", "fcuker", "fcuking", " feck", "fecker", "felching", "fellate", "fellatio", "fingerfuck", "fingerfucked", "fingerfucker", "fingerfuckers", "fingerfucking", "fingerfucks", "fistfuck", "fistfucked" , "fistfucker", "fistfuckers", "fistfucking", "fistfuckings", "fistfucks", "flange", "fook", "fooker", "fuck", "fucka", "fucked", " hijo de puta", "hijos de puta", "cabeza de mierda", "cabezas de mierda", "jodido", "jodido", "jodidos", "mierda de mierda", "fóllame", "folla", "jodido", "jodido", "empacador ", "fudgepacker", "fuk", "fuker", "fukker", "fukkin", "fuks", "fukwhit", "fukwit", "fux", "fux0r", "f_u_c_k", "gangbang", "gangbanged", "gangbangs", "gaylord", "gaysex", "goatse", "Dios", "maldita sea", "maldita sea", "maldita sea", "maldita sea", "sexo duro", "infierno","heshe", "hoar", "hoare", "hoer", "homo", "hore", "cachonda", "cachonda", "hotsex", "jack-off", "jackoff", "jap ", "jerk-off", "jism", "jiz", "jizm", "jizz", "kawk", "knob", "knobead", "knobed", "knobend", "knobhead", "knobjocky ", "knobjokey", "kock", "kondum", "kondums", "kum", "kummer", "kumming", "kums", "kunilingus", "l3i+ch", "l3itch", "labios ", "lujuria", "lujuria", "m0f0", "m0fo", "m45terbate", "ma5terb8", "ma5terbate", "masoquista", "master-bate", "masterb8", "masterbat*", " masterbat3", "masterbate", "masterbation", "masterbations", "masturbarse", "mo-fo", "mof0", "mofo", "mot hafuck", "mothafucka", "mothafuckas", "mothafuckaz", "mothafucks", "mothafucker", "mothafuckers", "mothafuckin", "mothafucking", "mothafuckings", "mothafucks", "hijo de puta", "hijo de puta ", "hijo de puta", "hijo de puta", "hijos de puta", "hijo de puta", "hijo de puta", "hijo de puta", "hijo de puta", "hijo de puta", "muff", "mutha", "muthafecker", "muthafuckker", "muther", "hijo de puta", "n1gga", "n1gger", "nazi", "nigg3r", "nigg4h", "nigga", "niggah", "niggas", "niggaz", "nigger", "niggers" ,"nob", "nob jokey", "nobhead", "nobjocky", "nobjokey", "numbnuts", "nutsack", "orgasim", "orgasims", "orgasm", "orgasms", "p0rn" , "peón", "pecker", "pene", "penisfucker", "phonesex", "phuck", "phuk", "phuked", "phuking", "phukked", "phukking", "phuks", " phuq", "pigfucker", "pimpis", "piss", "pissed", "pisser", "pissers", "pisses", "pissflaps", "pissin", "pissing", "pissoff", "caca" , "porn", "porno", "pornografía", "pornos", "prick", "pricks", "pron", "pube", "pusse", "pussi", "pussies", "pu ssy", "pussys", "culo", "retardado", "rimjaw", "beso negro", "golpe", "s.o.b.", "sádico", "schlong", "joder", "scroat", "scrote ", "escroto", "semen", "sexo", "sh!+", "sh!t", "sh1t", "shag", "shagger", "shaggin", "shagging", "transexual", "shi +", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda", "mierda ", "mierda", "mierda", "cagando", "cagando", "mierda", "zorra", "zorra", "zorras", "esmegma", "obscenidad", "arrancada", "hijo de -a-bitch", "spac", "spunk", "s_h_i_t", "t1tt1e5", "t1tties", "teets", "teez", "testical", "testículo", "tit", "titfuck", "tetas","twatty", "twunt", "twunter", "v14gra", "v1gra", "vagina", "viagra", "vulva", "w00se", "wang", "wank", "wanker", "wanky", "whoar", "puta", "willies", "willy", "xrated", "xxx"];
//colores inputs
let coloresInputs = ["Rojo", "Azul", "Blanco", "Verde", "Negro"]
//cartas
let listaCartas = document.createElement("div");
let cartasPadre = document.getElementById("listaCartasPadre");
let flechaCerrar = document.getElementById("cerrar");
let flechaAbrir = document.getElementById("mostrar")
let divDeCartas = document.getElementById("cartas");


//****************Llamadas************* */
//Muestra las primeras cartas



//busca las cartas si el buscador no esta vacio o hay colores
$("#cartasBuscar").click(function () {
    let nombreBuscar = document.getElementById("search").value;
    let url = "http://153.92.211.87:8000/api/cartas/post"
    if (nombreBuscar.length > 0 || colores.length > 0) {
        if (document.getElementById("listaCartas")) {
            cartasPadre.removeChild(document.getElementById("listaCartas"));
        }
        loading.style.display = "block";
        $.ajax({
            headers: {
            },
            type: "post",
            data: {
                data: colores,
                name: nombreBuscar
            },
            url: url,// ó {{url(/admin/empresa)}} depende a tu peticion se dirigira a el index(get) o tu store(post) de tu controlador 
            dataType: 'json',
            success: function (cartas) {
                if (cartas.length > 0) {
                    generarCartas(cartas)
                } else {
                    loading.style.display = "none";
                    alert("No se han encontrado resultados");
                }
            }
        });
    }else{
        if (document.getElementById("listaCartas")) {
            cartasPadre.removeChild(document.getElementById("listaCartas"));
        }
        loading.style.display = "block";
        $.ajax({
            headers: {
            },
            type: "get",
            url: "http://153.92.211.87:8000/api/cartas",// ó {{url(/admin/empresa)}} depende a tu peticion se dirigira a el index(get) o tu store(post) de tu controlador 
            dataType: 'json',
            success: function (cartas) {
                if (cartas.length > 0) {
                    generarCartas(cartas)
                } else {
                    loading.style.display = "none";
                }
            }
        });
    }
});


//enviar el mazo
let contInsultos=0
$("#Enviar").click(function (e) {
    console.log(idCartas);
    console.log(unidadCartas);
    e.preventDefault();
    insultos.forEach(insulto => {
        if(nombreMazo.value.toUpperCase().search(insulto.toUpperCase())!=-1){
            contInsultos++;
        }
    });
    if ((formato.value == "Modern" && total.innerText >= 60 && contInsultos==0 && nombreMazo.value != "") || (formato.value == "Commander") && total.innerText == 100 && contInsultos==0 && nombreMazo.value != "") {
        var cartas = idCartas;
        //var cantidad = unidadCartas;
        var portadaB = $("#portMazo").attr('src');
        
        var nombre = nombreMazo.value;
        var formatoM = formato.value;
        var estadoM = estado;
        var descripcionM = descripcion.value;
        var array = {"idCartas" : cartas,
                    "unidadCartas" : unidadCartas,
                    "nombre" : nombre,
                    "portadaB" : portadaB,
                    "estadoM" : estadoM,
                    "formatoM" : formatoM,
                    "descripcionM" : descripcionM
                };
        var id=document.getElementById("MazoIdetificador").value
        var cantidad = [];

                for (let index = 0; index < unidadCartas.length; index++) {
                    console.log(unidadCartas[index]);
                    cantidad.push(unidadCartas[index]);
                    
                }

            for (let index = 0; index <cartas.length; index++) {
                for (const key in unidadCartas) {
                    if(key=="card_"+cartas[index]){
                    console.log(unidadCartas[key]);
                    cantidad.push(unidadCartas[key]);
                    }
                }
            }     
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://153.92.211.87:8000/mazo/editar",// ó {{url(/admin/empresa)}} depende a tu peticion se dirigira a el index(get) o tu store(post) de tu controlador 
            data: {
                "cartas" : cartas,
                "cantidad" : cantidad,
                "portadaB" : portadaB,
                "nombre" : nombre,
                "formatoM" : formatoM,
                "estadoM" : estadoM,
                "descripcionM" : descripcionM,
                "id":id
            },
            success: function (msg) {
                if(msg.url){
                    window.location=msg.url;
                }else{
                    alert("Ha ocurrido un error")
                }
            }
        });
    } else {
        alert("No se cumplen los requisitos. El mazo debe tener nombre, formato y unidade mínimas de 60 para Modern y 100 para Commander");
        if(contInsultos>0){
            alert("Insultos en nombre");
            contInsultos=0;
        }
    }
});

//************Eventos********************** */
//colores eventos
coloresInputs.forEach(element => {
    let color = document.getElementById(element);
    color.addEventListener('change', function () {
        if (this.checked) {
            colores.push(color.value);
        } else {
            removePosicionArray(colores, color.value)
        }
    });
});

portadaMazo.addEventListener("click",function(e){
    portMazo=document.getElementById("portMazo");
    portMazo.src="https://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=170752&type=card"
    var portadaB=document.querySelectorAll(".btPortada")
    console.log(portadaB.length);
    portadaB.forEach(element => {
        element.style.display="block";
    });
    this.style.display="none";
});

//*******Reiniciar las cartas si se cambia de formato****** */
let formatoSelectLast = "0";

formato.addEventListener("change", function (e) {
        if (!confirm("Cambiar de formato eliminará los cambios realizados. ¿Continuar?")) {
            formato.selectedIndex = formatoSelectLast;
        } else {
            idCartas = [];
            unidadCartas = new Array();;
            total.innerText = 0;
            let id;
            while (listado.childNodes.length >= 1) {
                id = listado.firstChild.id;
                listado.removeChild(listado.firstChild)
                if (document.getElementById(id)) {
                    document.getElementById(id).style.display = "block";
                }
            }
        }
    
    formatoSelectLast = formato.selectedIndex
});

editarB.addEventListener("click",function(e){
    let cartas=document.querySelectorAll(".liLista")
    let regex = /(\d+)/g;
    cartas.forEach(element => {
        let id=parseInt(element.id.match(regex))
        let img = document.getElementById("carta"+element.id.match(regex))
        let span=document.getElementById("span"+id)
        //console.log(element.innerText.substring(0, element.innerText.length - 4));
        //console.log(idCartas);
        //console.log(unidadCartas);
        editar(id,element.id,element.innerText.substring(0, element.innerText.length - 4),img.innerText,parseInt(span.innerText))
        idCartas.push(id);
        unidadCartas.push(parseInt(span.innerText));
    });
    console.log(idCartas);
    $.ajax({
        headers: {
        },
        type: "get",
        url: "http://153.92.211.87:8000/api/cartas",// ó {{url(/admin/empresa)}} depende a tu peticion se dirigira a el index(get) o tu store(post) de tu controlador 
        dataType: 'json',
        success: function (cartas) {
            if (cartas.length > 0) {
                generarCartas(cartas)
            } else {
                loading.style.display = "none";
            }
        }
    });
    vista.style.display="none";
    editarDiv.style.display="block";
    
});

flechaCerrar.addEventListener("click",function(e){
    flechaAbrir.style.display="block";
    $("#cartas").toggle("slide");
});

flechaAbrir.addEventListener("click",function(e){
    $("#cartas").toggle("slide");
    this.style.display="none";
});



//****************************Funciones****************************/

//Genera las cartas que se pasan por parámetro */
function generarCartas(cartas) {
    let listaCartas = document.createElement("div");
    listaCartas.className = "listaCartas"
    listaCartas.id = "listaCartas"
    cartas.forEach(element => {
        if (!document.getElementById(element["id"])) {
            let tipo = element["tipo"];
            let divCarta = document.createElement("div");
            divCarta.className = "carta";
            divCarta.id = element["id"]
            let imagenCarta = document.createElement("img");
            imagenCarta.className = "cartaImg";
            imagenCarta.src = element["foto"]
            let nombreCarta = document.createElement("p");
            nombreCarta.className = "nombre";
            nombreCarta.innerText = element["nombre"];
            divCarta.appendChild(imagenCarta);
            divCarta.appendChild(nombreCarta);
            añadirCarta(divCarta, tipo, imagenCarta);
            listaCartas.appendChild(divCarta);
        }
    });
    loading.style.display = "none";
    cartasPadre.appendChild(listaCartas);
    if (listaCartas.childNodes.length == 0) {
    }
}

//añade el evento de añadir carta
function añadirCarta(div, tipo, imagenCarta) {
    div.addEventListener("click", function () {
            total.innerText++;
            let nombre = document.createElement("p");
            nombre.id = div.id;
            nombre.className="cartaLista";
            unidadCartas["card_"+div.id] = 1;
            let cantidad = document.createElement("span");
            let x = document.createElement("span");
            x.innerText = "X"
            x.className="X"
            cantidad.innerText = 1;
            let sumar = document.createElement("button");
            let restar = document.createElement("button");
            let borrar = document.createElement("button");
            let portada = document.createElement("button");
            sumar.className="bt";
            restar.className="bt";
            borrar.className="bt";
            portada.className="btPortada";
            portada.innerText="Portada";
            sumar.innerHTML = "+";
            restar.innerHTML = "-";
            borrar.innerHTML = "🗑️";
            cantidad.id = "cantidad" + nombre.id;
            sumar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                console.log(tipo.indexOf("Land"));
                if (((hermano.innerText < 4 && formato.value == "Modern") || tipo.indexOf("Land") != -1) || (formato.value == "Commander" && tipo.indexOf("Land") != -1)) {
                    hermano.innerText++;
                    total.innerText++;
                    console.log(this.parentElement.id);
                    unidadCartas["card_"+this.parentElement.id] = hermano.innerText;
                    
                }
            });

            restar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                if ((hermano.innerText > 1 && formato.value == "Modern") || (formato.value == "Commander" && hermano.innerText > 1 && tipo.indexOf("Land") != -1)) {
                    hermano.innerText--;
                    total.innerText--;
                    unidadCartas["card_"+this.parentElement.id] = hermano.innerText;
               
                }
            });

            borrar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                total.innerText = total.innerText - hermano.innerText; 
                console.log(this.parentElement.id);
                let parentID = this.parentElement.id;
                for (let index = 0; index < idCartas.length; index++) {
                    if(idCartas[index]==parentID){
                        console.log("borrando "+parentID)
                        console.log(idCartas);
                        console.log(unidadCartas);
                        idCartas.splice(index,1);

                    }
                }
                for (let index = 0; index < unidadCartas.length; index++) {
                    console.log(unidadCartas[index]);
                }
                this.parentElement.remove();
                if (document.getElementById(parentID)) {
                    document.getElementById(parentID).style.display = "block";
                }
            });

            portada.addEventListener("click",function(){
               let portMazo=document.getElementById("portMazo");
                portMazo.src=imagenCarta.src;
                var portadaB=document.querySelectorAll(".btPortada")
                portadaB.forEach(element => {
                    element.style.display="none";
                });
                portadaMazo.style.display="block";
            })

            nombre.innerText = div.lastElementChild.innerHTML;
            nombre.appendChild(x);
            nombre.appendChild(cantidad);
            if ((formato.value == "Modern") || (formato.value == "Commander" && tipo.indexOf("Land") != -1)) {
                nombre.appendChild(sumar);
                nombre.appendChild(restar);
            }
            nombre.appendChild(borrar);
            nombre.appendChild(portada);
            listado.appendChild(nombre);
            div.style.display = "none";
            idCartas.push(div.id);
    });
};

function editar(id, tipo,nombreE,imagenCarta,cantidadE) {
            let nombre = document.createElement("p");
            nombre.id = id;
            nombre.className="cartaLista";
            let cantidad = document.createElement("span");
            let x = document.createElement("span");
            x.className="X"
            x.innerText="X"
            cantidad.innerText = cantidadE;
            let sumar = document.createElement("button");
            let restar = document.createElement("button");
            let borrar = document.createElement("button");
            let portada = document.createElement("button");
            sumar.className="bt";
            restar.className="bt";
            borrar.className="bt";
            portada.className="btPortada";
            portada.innerText="Portada";
            sumar.innerHTML = "+";
            restar.innerHTML = "-";
            borrar.innerHTML = "🗑️";
            cantidad.id = "cantidad" + nombre.id;
            sumar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                console.log(tipo.indexOf("Land"));
                if (((hermano.innerText < 4 && formato.value == "Modern") || tipo.indexOf("Land") != -1) || (formato.value == "Commander" && tipo.indexOf("Land") != -1)) {
                    hermano.innerText++;
                    total.innerText++;
                    unidadCartas["card_"+this.parentElement.id] = hermano.innerText;
                
                }
            });

            restar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                if ((hermano.innerText > 1 && formato.value == "Modern") || (formato.value == "Commander" && hermano.innerText > 1 && tipo.indexOf("Basic Land") != -1)) {
                    hermano.innerText--;
                    total.innerText--;
                    unidadCartas["card_"+this.parentElement.id] = hermano.innerText;
                }
            });

            borrar.addEventListener("click", function () {
                let id = "cantidad" + this.parentElement.id
                let hermano = document.getElementById(id);
                total.innerText = total.innerText - hermano.innerText;
                let parentID = this.parentElement.id;
                removePosicionArray(idCartas,parentID);
                removePosicionArray(unidadCartas,"card_"+this.parentElement.id);
                this.parentElement.remove();
                if (document.getElementById(parentID)) {
                    document.getElementById(parentID).style.display = "block";
                }
            });

            portada.addEventListener("click",function(){
               let portMazo=document.getElementById("portMazo");
                portMazo.src=imagenCarta;
                var portadaB=document.querySelectorAll(".btPortada")
                portadaB.forEach(element => {
                    element.style.display="none";
                });
                portadaMazo.style.display="block";
            })

            nombre.innerText = nombreE;
            nombre.appendChild(x);
            nombre.appendChild(cantidad);
            if ((formato.value == "Modern") || (formato.value == "Commander" && tipo.indexOf("Basic Land") != -1)) {
                nombre.appendChild(sumar);
                nombre.appendChild(restar);
            }
            nombre.appendChild(borrar);
            nombre.appendChild(portada);
            listado.appendChild(nombre);
       
};

//elimina posicion de los arrays
function removePosicionArray(arr, item) {
    let i = arr.indexOf(item);

    if (i !== -1) {
        arr.splice(i, 1);
    }
}
//cambia el togle y el estado del mazo
let on=0
$('#checkEs').on('click', function() {
    if (on==0) {
        estado="Privado";
        on++;
    } else {
        estado="Publico";
      on--;
    }
  });

$('#btDes').on('click',function(){
    if (this.innerText=='Descripción'){
        listado.style.display="none"
        descripcion.style.display="block";
        this.innerText='Lista'
    }else{
        listado.style.display="block";
        descripcion.style.display="none";
        this.innerText='Descripción'
    }
})