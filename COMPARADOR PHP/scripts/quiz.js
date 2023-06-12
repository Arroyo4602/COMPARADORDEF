function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

let jugadores = Array();
let tamaño;
let i = 0;
let j = 0;

let jugador1 = document.getElementById("jugador1");
let jugador2 = document.getElementById("jugador2");
let igual = document.getElementById("igual");

let foto1 = document.getElementById("foto1");
let foto2 = document.getElementById("foto2");
let puntos;

if(getCookie('puntos')!=null){
    puntos = getCookie('puntos');
}else{
    puntos=0;
}


let puntos1 = document.getElementById('puntos1').innerHTML += puntos;
let pregunta = document.getElementById("pregunta");
let opcion = Math.floor(Math.random() * (6 - 1 + 1) + 1);
let correcta;
let elegida;
let record;




if(getCookie('record')!=null){
    record = getCookie('record');
    document.getElementById('record').innerHTML="Highscore: "+record;
}else{
    record=0;
}

if(record>=getCookie('puntos')){

    document.cookie="record="+puntos;
    
}

console.log(jugadores);

fetch('http://localhost/COMPARADOR%20PHP/apis/api.php')
    .then(response => response.json())
    .then(data => {
        for (let i = 0; i < data.length; i++) {
            jugadores.push(data[i]);
        }
        tamaño = jugadores.length;
        console.log(tamaño);
        if (i == 0) {
            i = Math.floor(Math.random() * tamaño);
        }

        if (j == 0) {
            j = Math.floor(Math.random() * tamaño);
        }

        while (i == j) {
            j = Math.floor(Math.random() * tamaño);
        }

        foto1.src = "img/" + jugadores[i].foto;
        foto2.src = "img/" + jugadores[j].foto;
        jugador1.innerHTML += jugadores[i].nombre;
        jugador2.innerHTML += jugadores[j].nombre;

        switch (opcion) {
            case 1:
                pregunta.innerHTML += "edad?";
                if (jugadores[i].edad > jugadores[j].edad) {
                    correcta = 1;
                } else if (jugadores[i].edad < jugadores[j].edad) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
        
                break;
            case 2:
                pregunta.innerHTML += "dorsal?";
                if (jugadores[i].dorsal > jugadores[j].dorsal) {
                    correcta = 1;
                } else if (jugadores[i].dorsal < jugadores[j].dorsal) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
                break;
            case 3:
                pregunta.innerHTML += "goles?";
                if (jugadores[i].goles > jugadores[j].goles) {
                    correcta = 1;
                } else if (jugadores[i].goles < jugadores[j].goles) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
                break;
            case 4:
                pregunta.innerHTML += "asistencias?";
                if (jugadores[i].asistencias > jugadores[j].asistencias) {
                    correcta = 1;
                } else if (jugadores[i].asistencias < jugadores[j].asistencias) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
                break;
            case 5:
                pregunta.innerHTML += "minutos?";
                if (jugadores[i].minutos > jugadores[j].minutos) {
                    correcta = 1;
                } else if (jugadores[i].minutos < jugadores[j].minutos) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
                break;
            case 6:
                pregunta.innerHTML += "valor?";
                if (jugadores[i].valor > jugadores[j].valor) {
                    correcta = 1;
                } else if (jugadores[i].valor < jugadores[j].valor) {
                    correcta = 2;
                } else {
                    correcta = 3;
                }
                break;
            default:
                break;
        }
    })




jugador1.addEventListener("click", function () {
    elegida = 1;
    if (elegida == correcta) {
        puntos++;
    } else {
        puntos = 0;
    }
    document.cookie="puntos="+puntos;
    location.reload();

})

jugador2.addEventListener("click", function () {
    elegida = 2;
    if (elegida == correcta) {
        puntos++;
    } else {
        puntos = 0;
    }
    document.cookie="puntos="+puntos;
    location.reload();
})



igual.addEventListener("click", function () {
    elegida = 3;
    if (elegida == correcta) {
        puntos++;
    } else {
        puntos = 0;
    }
    document.cookie="puntos="+puntos;
    location.reload();
})




