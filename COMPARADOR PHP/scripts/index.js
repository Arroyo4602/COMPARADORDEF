

let Equipos = [];
let Ligas = [];
let Jugadores = [];
let Selecciones = [];
let EquiposLiga = [];
let JugadoresEquipo = [];
let JugadoresSeleccion = [];

fetch('http://localhost/COMPARADOR%20PHP/apis/api.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            Jugadores.push(element);
        });
    });

fetch('http://localhost/COMPARADOR%20PHP/apis/apiEquipoHasLiga.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            EquiposLiga.push(element);
        });


    });
fetch('http://localhost/COMPARADOR%20PHP/apis/apiEquipos.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            Equipos.push(element);
        });

    });
fetch('http://localhost/COMPARADOR%20PHP/apis/apiJugadorHasEquipo.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            JugadoresEquipo.push(element);
        });

    }
    );
fetch('http://localhost/COMPARADOR%20PHP/apis/apiJugadorHasSeleccion.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            JugadoresSeleccion.push(element);
        });

    });
fetch('http://localhost/COMPARADOR%20PHP/apis/apiLigas.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            Ligas.push(element);
        });

    }
    );
fetch('http://localhost/COMPARADOR%20PHP/apis/apiSelecciones.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(element => {
            Selecciones.push(element);
        });

    }
    );


let urlParams = new URLSearchParams(window.location.search);
let idLIGAURL=null;
let nombreEQUIPOURL=null;
let seleccionURL=null;
let posicion=null;
if (urlParams.has("liga")) {
    idLIGAURL = urlParams.get("liga");
}
if (urlParams.has("equipo")) {
    nombreEQUIPOURL = urlParams.get("equipo");
}
if (urlParams.has("seleccion")) {
    seleccionURL = urlParams.get("seleccion");
}
if (urlParams.has("posicion")) {
    posicion = urlParams.get("posicion");
}


console.log(idLIGAURL, nombreEQUIPOURL, seleccionURL, posicion);

function ordenaridLiga(propiedad) {
    document.getElementById("general").innerHTML = "";
    let idJugadoresdef = [];
    let idEquiposDef = [];
    EquiposLiga.forEach(element => {
        if (idLIGAURL == element.id_liga) {
            idEquiposDef.push(element.id_equipo);
        }
    });
    JugadoresEquipo.forEach(element => {

        for (let i = 0; i < idEquiposDef.length; i++) {
            if (element.id_equipo == idEquiposDef[i]) {
                idJugadoresdef.push(element.id_jugador);
            }
        }
    });
    let JugadoresDef = [];
    idJugadoresdef.forEach(element => {
        {
            for (let i = 0; i < Jugadores.length; i++) {
                if (element == Jugadores[i].id_jugador) {
                    JugadoresDef.push(Jugadores[i]);
                }
            }
        };
    });
    console.log(JugadoresDef);
    //ordenar el array de jugadores por la propiedad goles
    JugadoresDef.sort(function (a, b) {
        if (propiedad == "goles") {
            return b.goles - a.goles;
        }
        if (propiedad == "asistencias") {
            return b.asistencias - a.asistencias;
        }
        if (propiedad == "minutos") {
            return b.minutos - a.minutos;
        }
        if (propiedad == "valor") {
            return b.valor - a.valor;
        }
    }
    );
    console.log(JugadoresDef);
    JugadoresDef.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("id", "estadisticas");
        let div1 = document.createElement("div");
        div1.setAttribute("id", "uno");
        let div2 = document.createElement("div");
        div2.setAttribute("id", "uno");
        let div3 = document.createElement("div");
        div3.setAttribute("id", "uno");
        let div4 = document.createElement("div");
        div4.setAttribute("id", "uno");
        let div5 = document.createElement("div");
        div5.setAttribute("id", "uno");
        let div6 = document.createElement("div");
        div6.setAttribute("id", "uno");
        let div7 = document.createElement("div");
        div7.setAttribute("id", "uno");
        let div8 = document.createElement("div");
        div8.setAttribute("id", "uno");
        let div9 = document.createElement("div");
        div9.setAttribute("id", "uno");
        let div10 = document.createElement("div");
        div10.setAttribute("id", "uno");
        let div11 = document.createElement("div");
        div11.setAttribute("id", "uno");

        div1.innerHTML = "Foto";
        div2.innerHTML = "Nombre";
        div3.innerHTML = "Equipo";
        div4.innerHTML = "Nacionalidad";
        div5.innerHTML = "Liga";
        div6.innerHTML = "Edad";
        div7.innerHTML = "Posicion";
        div8.innerHTML = "Goles";
        div9.innerHTML = "Asistencias";
        div10.innerHTML = "Minutos";
        div11.innerHTML = "Valor";

        let div12 = document.createElement("div");
        div12.setAttribute("id", "perfil");
        div12.innerHTML = "<img src='img/" + element.foto + "'>";

        let div13 = document.createElement("div");
        div13.setAttribute("id", "dos");
        div13.innerHTML = element.nombre;

        let id_equipo;
        JugadoresEquipo.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                id_equipo = element2.id_equipo;
            }
        });
        let fotoEquipo;
        Equipos.forEach(element => {
            if (id_equipo == element.id_equipo) {
                fotoEquipo = element.foto;
            }
        });

        let div14 = document.createElement("div");
        div14.setAttribute("id", "equipo");
        div14.innerHTML = "<img src='img/" + fotoEquipo + "'>";


        let idSeleccion;
        JugadoresSeleccion.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                idSeleccion = element2.id_seleccion;
            }
        });
        let fotoSeleccion;
        Selecciones.forEach(element2 => {
            if (idSeleccion == element2.id_seleccion) {
                fotoSeleccion = element2.foto;
            }
        });

        let div15 = document.createElement("div");
        div15.setAttribute("id", "seleccion");
        div15.innerHTML = "<img src='img/" + fotoSeleccion + "'>";

        let idLiga;
        EquiposLiga.forEach(element2 => {
            if (id_equipo == element2.id_equipo) {
                idLiga = element2.id_liga;
            }
        });
        let fotoLiga;
        Ligas.forEach(element2 => {
            if (idLiga == element2.id_liga) {
                fotoLiga = element2.foto;
            }
        });

        let div16 = document.createElement("div");
        div16.setAttribute("id", "liga");
        div16.innerHTML = "<img src='img/" + fotoLiga + "'>";

        let div17 = document.createElement("div");
        div17.setAttribute("id", "dos");
        div17.innerHTML = element.edad;

        let div18 = document.createElement("div");
        div18.setAttribute("id", "dos");
        div18.innerHTML = element.posicion;

        let div19 = document.createElement("div");
        div19.setAttribute("id", "dos");
        div19.innerHTML = element.goles;

        let div20 = document.createElement("div");
        div20.setAttribute("id", "dos");
        div20.innerHTML = element.asistencias;

        let div21 = document.createElement("div");
        div21.setAttribute("id", "dos");
        div21.innerHTML = element.minutos;

        let div22 = document.createElement("div");
        div22.setAttribute("id", "dos");
        div22.innerHTML = element.valor;
        div22.innerHTML += " Millones";

        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);
        div.appendChild(div6);
        div.appendChild(div7);
        div.appendChild(div8);
        div.appendChild(div9);
        div.appendChild(div10);
        div.appendChild(div11);
        div.appendChild(div12);
        div.appendChild(div13);
        div.appendChild(div14);
        div.appendChild(div15);
        div.appendChild(div16);
        div.appendChild(div17);
        div.appendChild(div18);
        div.appendChild(div19);
        div.appendChild(div20);
        div.appendChild(div21);
        div.appendChild(div22);

        document.getElementById('general').appendChild(div);
    });
}

function ordenarNombreEquipo(propiedad) {
    document.getElementById('general').innerHTML = "";
    let idEquiposDef = [];
    let idlLigaDef = [];

    Equipos.forEach(element => {
        if (element.nombre == nombreEQUIPOURL) {
            idEquiposDef.push(element.id_equipo);
        }
    });

    let idJugadoresDef = [];
    JugadoresEquipo.forEach(element => {
        idEquiposDef.forEach(element2 => {
            if (element.id_equipo == element2) {
                idJugadoresDef.push(element.id_jugador);
            }
        });
    });

    let JugadoresDef = [];
    Jugadores.forEach(element => {
        idJugadoresDef.forEach(element2 => {
            if (element.id_jugador == element2) {
                JugadoresDef.push(element);
            }
        });
    });

    JugadoresDef.sort(function (a, b) {
        if (propiedad == "goles") {
            return b.goles - a.goles;
        }
        if (propiedad == "asistencias") {
            return b.asistencias - a.asistencias;
        }
        if (propiedad == "minutos") {
            return b.minutos - a.minutos;
        }
        if (propiedad == "valor") {
            return b.valor - a.valor;
        }
    });

    JugadoresDef.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("id", "estadisticas");
        let div1 = document.createElement("div");
        div1.setAttribute("id", "uno");
        let div2 = document.createElement("div");
        div2.setAttribute("id", "uno");
        let div3 = document.createElement("div");
        div3.setAttribute("id", "uno");
        let div4 = document.createElement("div");
        div4.setAttribute("id", "uno");
        let div5 = document.createElement("div");
        div5.setAttribute("id", "uno");
        let div6 = document.createElement("div");
        div6.setAttribute("id", "uno");
        let div7 = document.createElement("div");
        div7.setAttribute("id", "uno");
        let div8 = document.createElement("div");
        div8.setAttribute("id", "uno");
        let div9 = document.createElement("div");
        div9.setAttribute("id", "uno");
        let div10 = document.createElement("div");
        div10.setAttribute("id", "uno");
        let div11 = document.createElement("div");
        div11.setAttribute("id", "uno");

        div1.innerHTML = "Foto";
        div2.innerHTML = "Nombre";
        div3.innerHTML = "Equipo";
        div4.innerHTML = "Nacionalidad";
        div5.innerHTML = "Liga";
        div6.innerHTML = "Edad";
        div7.innerHTML = "Posicion";
        div8.innerHTML = "Goles";
        div9.innerHTML = "Asistencias";
        div10.innerHTML = "Minutos";
        div11.innerHTML = "Valor";

        let div12 = document.createElement("div");
        div12.setAttribute("id", "perfil");
        div12.innerHTML = "<img src='img/" + element.foto + "'>";

        let div13 = document.createElement("div");
        div13.setAttribute("id", "dos");
        div13.innerHTML = element.nombre;

        let id_equipo;
        JugadoresEquipo.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                id_equipo = element2.id_equipo;
            }
        });
        let fotoEquipo;
        Equipos.forEach(element => {
            if (id_equipo == element.id_equipo) {
                fotoEquipo = element.foto;
            }
        });

        let div14 = document.createElement("div");
        div14.setAttribute("id", "equipo");
        div14.innerHTML = "<img src='img/" + fotoEquipo + "'>";


        let idSeleccion;
        JugadoresSeleccion.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                idSeleccion = element2.id_seleccion;
            }
        });
        let fotoSeleccion;
        Selecciones.forEach(element2 => {
            if (idSeleccion == element2.id_seleccion) {
                fotoSeleccion = element2.foto;
            }
        });

        let div15 = document.createElement("div");
        div15.setAttribute("id", "seleccion");
        div15.innerHTML = "<img src='img/" + fotoSeleccion + "'>";

        let idLiga;
        EquiposLiga.forEach(element2 => {
            if (id_equipo == element2.id_equipo) {
                idLiga = element2.id_liga;
            }
        });
        let fotoLiga;
        Ligas.forEach(element2 => {
            if (idLiga == element2.id_liga) {
                fotoLiga = element2.foto;
            }
        });

        let div16 = document.createElement("div");
        div16.setAttribute("id", "liga");
        div16.innerHTML = "<img src='img/" + fotoLiga + "'>";

        let div17 = document.createElement("div");
        div17.setAttribute("id", "dos");
        div17.innerHTML = element.edad;

        let div18 = document.createElement("div");
        div18.setAttribute("id", "dos");
        div18.innerHTML = element.posicion;

        let div19 = document.createElement("div");
        div19.setAttribute("id", "dos");
        div19.innerHTML = element.goles;

        let div20 = document.createElement("div");
        div20.setAttribute("id", "dos");
        div20.innerHTML = element.asistencias;

        let div21 = document.createElement("div");
        div21.setAttribute("id", "dos");
        div21.innerHTML = element.minutos;

        let div22 = document.createElement("div");
        div22.setAttribute("id", "dos");
        div22.innerHTML = element.valor;
        div22.innerHTML += " Millones";

        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);
        div.appendChild(div6);
        div.appendChild(div7);
        div.appendChild(div8);
        div.appendChild(div9);
        div.appendChild(div10);
        div.appendChild(div11);
        div.appendChild(div12);
        div.appendChild(div13);
        div.appendChild(div14);
        div.appendChild(div15);
        div.appendChild(div16);
        div.appendChild(div17);
        div.appendChild(div18);
        div.appendChild(div19);
        div.appendChild(div20);
        div.appendChild(div21);
        div.appendChild(div22);

        document.getElementById('general').appendChild(div);
    });


}

function ordenarNombreSeleccion(propiedad) {
    document.getElementById('general').innerHTML = "";

    //seleccion url
    let idSeleccion;
    let IdJugadoresDef = [];

    Selecciones.forEach(element => {
        if (seleccionURL == element.nombre) {
            idSeleccion = element.id_seleccion;
        }
    });

    JugadoresSeleccion.forEach(element => {
        if (idSeleccion == element.id_seleccion) {
            IdJugadoresDef.push(element.id_jugador);
        }
    });

    let JugadoresDef = [];

    Jugadores.forEach(element => {
        IdJugadoresDef.forEach(element2 => {
            if (element2 == element.id_jugador) {
                JugadoresDef.push(element);
            }
        });
    });

    JugadoresDef.sort(function (a, b) {
        if (propiedad == "goles") {
            return b.goles - a.goles;
        }
        if (propiedad == "asistencias") {
            return b.asistencias - a.asistencias;
        }
        if (propiedad == "minutos") {
            return b.minutos - a.minutos;
        }
        if (propiedad == "valor") {
            return b.valor - a.valor;
        }
    });

    JugadoresDef.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("id", "estadisticas");
        let div1 = document.createElement("div");
        div1.setAttribute("id", "uno");
        let div2 = document.createElement("div");
        div2.setAttribute("id", "uno");
        let div3 = document.createElement("div");
        div3.setAttribute("id", "uno");
        let div4 = document.createElement("div");
        div4.setAttribute("id", "uno");
        let div5 = document.createElement("div");
        div5.setAttribute("id", "uno");
        let div6 = document.createElement("div");
        div6.setAttribute("id", "uno");
        let div7 = document.createElement("div");
        div7.setAttribute("id", "uno");
        let div8 = document.createElement("div");
        div8.setAttribute("id", "uno");
        let div9 = document.createElement("div");
        div9.setAttribute("id", "uno");
        let div10 = document.createElement("div");
        div10.setAttribute("id", "uno");
        let div11 = document.createElement("div");
        div11.setAttribute("id", "uno");

        div1.innerHTML = "Foto";
        div2.innerHTML = "Nombre";
        div3.innerHTML = "Equipo";
        div4.innerHTML = "Nacionalidad";
        div5.innerHTML = "Liga";
        div6.innerHTML = "Edad";
        div7.innerHTML = "Posicion";
        div8.innerHTML = "Goles";
        div9.innerHTML = "Asistencias";
        div10.innerHTML = "Minutos";
        div11.innerHTML = "Valor";

        let div12 = document.createElement("div");
        div12.setAttribute("id", "perfil");
        div12.innerHTML = "<img src='img/" + element.foto + "'>";

        let div13 = document.createElement("div");
        div13.setAttribute("id", "dos");
        div13.innerHTML = element.nombre;

        let id_equipo;
        JugadoresEquipo.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                id_equipo = element2.id_equipo;
            }
        });
        let fotoEquipo;
        Equipos.forEach(element => {
            if (id_equipo == element.id_equipo) {
                fotoEquipo = element.foto;
            }
        });

        let div14 = document.createElement("div");
        div14.setAttribute("id", "equipo");
        div14.innerHTML = "<img src='img/" + fotoEquipo + "'>";


        let idSeleccion;
        JugadoresSeleccion.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                idSeleccion = element2.id_seleccion;
            }
        });
        let fotoSeleccion;
        Selecciones.forEach(element2 => {
            if (idSeleccion == element2.id_seleccion) {
                fotoSeleccion = element2.foto;
            }
        });

        let div15 = document.createElement("div");
        div15.setAttribute("id", "seleccion");
        div15.innerHTML = "<img src='img/" + fotoSeleccion + "'>";

        let idLiga;
        EquiposLiga.forEach(element2 => {
            if (id_equipo == element2.id_equipo) {
                idLiga = element2.id_liga;
            }
        });
        let fotoLiga;
        Ligas.forEach(element2 => {
            if (idLiga == element2.id_liga) {
                fotoLiga = element2.foto;
            }
        });

        let div16 = document.createElement("div");
        div16.setAttribute("id", "liga");
        div16.innerHTML = "<img src='img/" + fotoLiga + "'>";

        let div17 = document.createElement("div");
        div17.setAttribute("id", "dos");
        div17.innerHTML = element.edad;

        let div18 = document.createElement("div");
        div18.setAttribute("id", "dos");
        div18.innerHTML = element.posicion;

        let div19 = document.createElement("div");
        div19.setAttribute("id", "dos");
        div19.innerHTML = element.goles;

        let div20 = document.createElement("div");
        div20.setAttribute("id", "dos");
        div20.innerHTML = element.asistencias;

        let div21 = document.createElement("div");
        div21.setAttribute("id", "dos");
        div21.innerHTML = element.minutos;

        let div22 = document.createElement("div");
        div22.setAttribute("id", "dos");
        div22.innerHTML = element.valor;
        div22.innerHTML += " Millones";

        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);
        div.appendChild(div6);
        div.appendChild(div7);
        div.appendChild(div8);
        div.appendChild(div9);
        div.appendChild(div10);
        div.appendChild(div11);
        div.appendChild(div12);
        div.appendChild(div13);
        div.appendChild(div14);
        div.appendChild(div15);
        div.appendChild(div16);
        div.appendChild(div17);
        div.appendChild(div18);
        div.appendChild(div19);
        div.appendChild(div20);
        div.appendChild(div21);
        div.appendChild(div22);

        document.getElementById('general').appendChild(div);
    });

}

function ordenarPosicion(propiedad) {
    document.getElementById('general').innerHTML = "";
    let JugadoresDef = [];

    Jugadores.forEach(element => {
        if (posicion == element.posicion) {
            JugadoresDef.push(element);
        }
    });

    JugadoresDef.sort(function (a, b) {
        if (propiedad == "goles") {
            return b.goles - a.goles;
        }
        if (propiedad == "asistencias") {
            return b.asistencias - a.asistencias;
        }
        if (propiedad == "minutos") {
            return b.minutos - a.minutos;
        }
        if (propiedad == "valor") {
            return b.valor - a.valor;
        }
    });

    JugadoresDef.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("id", "estadisticas");
        let div1 = document.createElement("div");
        div1.setAttribute("id", "uno");
        let div2 = document.createElement("div");
        div2.setAttribute("id", "uno");
        let div3 = document.createElement("div");
        div3.setAttribute("id", "uno");
        let div4 = document.createElement("div");
        div4.setAttribute("id", "uno");
        let div5 = document.createElement("div");
        div5.setAttribute("id", "uno");
        let div6 = document.createElement("div");
        div6.setAttribute("id", "uno");
        let div7 = document.createElement("div");
        div7.setAttribute("id", "uno");
        let div8 = document.createElement("div");
        div8.setAttribute("id", "uno");
        let div9 = document.createElement("div");
        div9.setAttribute("id", "uno");
        let div10 = document.createElement("div");
        div10.setAttribute("id", "uno");
        let div11 = document.createElement("div");
        div11.setAttribute("id", "uno");

        div1.innerHTML = "Foto";
        div2.innerHTML = "Nombre";
        div3.innerHTML = "Equipo";
        div4.innerHTML = "Nacionalidad";
        div5.innerHTML = "Liga";
        div6.innerHTML = "Edad";
        div7.innerHTML = "Posicion";
        div8.innerHTML = "Goles";
        div9.innerHTML = "Asistencias";
        div10.innerHTML = "Minutos";
        div11.innerHTML = "Valor";

        let div12 = document.createElement("div");
        div12.setAttribute("id", "perfil");
        div12.innerHTML = "<img src='img/" + element.foto + "'>";

        let div13 = document.createElement("div");
        div13.setAttribute("id", "dos");
        div13.innerHTML = element.nombre;

        let id_equipo;
        JugadoresEquipo.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                id_equipo = element2.id_equipo;
            }
        });
        let fotoEquipo;
        Equipos.forEach(element => {
            if (id_equipo == element.id_equipo) {
                fotoEquipo = element.foto;
            }
        });

        let div14 = document.createElement("div");
        div14.setAttribute("id", "equipo");
        div14.innerHTML = "<img src='img/" + fotoEquipo + "'>";


        let idSeleccion;
        JugadoresSeleccion.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                idSeleccion = element2.id_seleccion;
            }
        });
        let fotoSeleccion;
        Selecciones.forEach(element2 => {
            if (idSeleccion == element2.id_seleccion) {
                fotoSeleccion = element2.foto;
            }
        });

        let div15 = document.createElement("div");
        div15.setAttribute("id", "seleccion");
        div15.innerHTML = "<img src='img/" + fotoSeleccion + "'>";

        let idLiga;
        EquiposLiga.forEach(element2 => {
            if (id_equipo == element2.id_equipo) {
                idLiga = element2.id_liga;
            }
        });
        let fotoLiga;
        Ligas.forEach(element2 => {
            if (idLiga == element2.id_liga) {
                fotoLiga = element2.foto;
            }
        });

        let div16 = document.createElement("div");
        div16.setAttribute("id", "liga");
        div16.innerHTML = "<img src='img/" + fotoLiga + "'>";

        let div17 = document.createElement("div");
        div17.setAttribute("id", "dos");
        div17.innerHTML = element.edad;

        let div18 = document.createElement("div");
        div18.setAttribute("id", "dos");
        div18.innerHTML = element.posicion;

        let div19 = document.createElement("div");
        div19.setAttribute("id", "dos");
        div19.innerHTML = element.goles;

        let div20 = document.createElement("div");
        div20.setAttribute("id", "dos");
        div20.innerHTML = element.asistencias;

        let div21 = document.createElement("div");
        div21.setAttribute("id", "dos");
        div21.innerHTML = element.minutos;

        let div22 = document.createElement("div");
        div22.setAttribute("id", "dos");
        div22.innerHTML = element.valor;
        div22.innerHTML += " Millones";

        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);
        div.appendChild(div6);
        div.appendChild(div7);
        div.appendChild(div8);
        div.appendChild(div9);
        div.appendChild(div10);
        div.appendChild(div11);
        div.appendChild(div12);
        div.appendChild(div13);
        div.appendChild(div14);
        div.appendChild(div15);
        div.appendChild(div16);
        div.appendChild(div17);
        div.appendChild(div18);
        div.appendChild(div19);
        div.appendChild(div20);
        div.appendChild(div21);
        div.appendChild(div22);

        document.getElementById('general').appendChild(div);
    });
}

function ordenar(propiedad) {
    document.getElementById('general').innerHTML = "";

    Jugadores.sort(function (a, b) {
        if (propiedad == "goles") {
            return b.goles - a.goles;
        }
        if (propiedad == "asistencias") {
            return b.asistencias - a.asistencias;
        }
        if (propiedad == "minutos") {
            return b.minutos - a.minutos;
        }
        if (propiedad == "valor") {
            return b.valor - a.valor;
        }
    });

    Jugadores.forEach(element => {
        let div = document.createElement("div");
        div.setAttribute("id", "estadisticas");
        let div1 = document.createElement("div");
        div1.setAttribute("id", "uno");
        let div2 = document.createElement("div");
        div2.setAttribute("id", "uno");
        let div3 = document.createElement("div");
        div3.setAttribute("id", "uno");
        let div4 = document.createElement("div");
        div4.setAttribute("id", "uno");
        let div5 = document.createElement("div");
        div5.setAttribute("id", "uno");
        let div6 = document.createElement("div");
        div6.setAttribute("id", "uno");
        let div7 = document.createElement("div");
        div7.setAttribute("id", "uno");
        let div8 = document.createElement("div");
        div8.setAttribute("id", "uno");
        let div9 = document.createElement("div");
        div9.setAttribute("id", "uno");
        let div10 = document.createElement("div");
        div10.setAttribute("id", "uno");
        let div11 = document.createElement("div");
        div11.setAttribute("id", "uno");

        div1.innerHTML = "Foto";
        div2.innerHTML = "Nombre";
        div3.innerHTML = "Equipo";
        div4.innerHTML = "Nacionalidad";
        div5.innerHTML = "Liga";
        div6.innerHTML = "Edad";
        div7.innerHTML = "Posicion";
        div8.innerHTML = "Goles";
        div9.innerHTML = "Asistencias";
        div10.innerHTML = "Minutos";
        div11.innerHTML = "Valor";

        let div12 = document.createElement("div");
        div12.setAttribute("id", "perfil");
        div12.innerHTML = "<img src='img/" + element.foto + "'>";

        let div13 = document.createElement("div");
        div13.setAttribute("id", "dos");
        div13.innerHTML = element.nombre;

        let id_equipo;
        JugadoresEquipo.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                id_equipo = element2.id_equipo;
            }
        });
        let fotoEquipo;
        Equipos.forEach(element => {
            if (id_equipo == element.id_equipo) {
                fotoEquipo = element.foto;
            }
        });

        let div14 = document.createElement("div");
        div14.setAttribute("id", "equipo");
        div14.innerHTML = "<img src='img/" + fotoEquipo + "'>";


        let idSeleccion;
        JugadoresSeleccion.forEach(element2 => {
            if (element.id_jugador == element2.id_jugador) {
                idSeleccion = element2.id_seleccion;
            }
        });
        let fotoSeleccion;
        Selecciones.forEach(element2 => {
            if (idSeleccion == element2.id_seleccion) {
                fotoSeleccion = element2.foto;
            }
        });

        let div15 = document.createElement("div");
        div15.setAttribute("id", "seleccion");
        div15.innerHTML = "<img src='img/" + fotoSeleccion + "'>";  

        let idLiga;
        EquiposLiga.forEach(element2 => {
            if (id_equipo == element2.id_equipo) {
                idLiga = element2.id_liga;
            }
        });
        let fotoLiga;
        Ligas.forEach(element2 => {
            if (idLiga == element2.id_liga) {
                fotoLiga = element2.foto;
            }
        });

        let div16 = document.createElement("div");
        div16.setAttribute("id", "liga");
        div16.innerHTML = "<img src='img/" + fotoLiga + "'>";

        let div17 = document.createElement("div");
        div17.setAttribute("id", "dos");
        div17.innerHTML = element.edad;

        let div18 = document.createElement("div");
        div18.setAttribute("id", "dos");
        div18.innerHTML = element.posicion;

        let div19 = document.createElement("div");
        div19.setAttribute("id", "dos");
        div19.innerHTML = element.goles;

        let div20 = document.createElement("div");
        div20.setAttribute("id", "dos");
        div20.innerHTML = element.asistencias;

        let div21 = document.createElement("div");
        div21.setAttribute("id", "dos");
        div21.innerHTML = element.minutos;

        let div22 = document.createElement("div");
        div22.setAttribute("id", "dos");
        div22.innerHTML = element.valor;
        div22.innerHTML += " Millones";

        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);
        div.appendChild(div6);
        div.appendChild(div7);
        div.appendChild(div8);
        div.appendChild(div9);
        div.appendChild(div10);
        div.appendChild(div11);
        div.appendChild(div12);
        div.appendChild(div13);
        div.appendChild(div14);
        div.appendChild(div15);
        div.appendChild(div16);
        div.appendChild(div17);
        div.appendChild(div18);
        div.appendChild(div19);
        div.appendChild(div20);
        div.appendChild(div21);
        div.appendChild(div22);

        document.getElementById('general').appendChild(div);
    });

}

if (idLIGAURL != null) {

    document.getElementById('opcion1').addEventListener('click', function () {
        ordenaridLiga('goles');
    });
    document.getElementById('opcion2').addEventListener('click', function () {
        ordenaridLiga('asistencias');
    });

    document.getElementById('opcion3').addEventListener('click', function () {
        ordenaridLiga('minutos');
    });

    document.getElementById('opcion4').addEventListener('click', function () {
        ordenaridLiga('valor');
    });

} else if (nombreEQUIPOURL != null) {
    document.getElementById('opcion1').addEventListener('click', function () {
        ordenarNombreEquipo('goles');
    });
    document.getElementById('opcion2').addEventListener('click', function () {
        ordenarNombreEquipo('asistencias');
    });

    document.getElementById('opcion3').addEventListener('click', function () {
        ordenarNombreEquipo('minutos');
    });

    document.getElementById('opcion4').addEventListener('click', function () {
        ordenarNombreEquipo('valor');
    });
} else if (seleccionURL != null) {
    document.getElementById('opcion1').addEventListener('click', function () {
        ordenarNombreSeleccion('goles');
    });
    document.getElementById('opcion2').addEventListener('click', function () {
        ordenarNombreSeleccion('asistencias');
    });

    document.getElementById('opcion3').addEventListener('click', function () {
        ordenarNombreSeleccion('minutos');
    });

    document.getElementById('opcion4').addEventListener('click', function () {
        ordenarNombreSeleccion('valor');
    });
} else if (posicion != null) {
    document.getElementById('opcion1').addEventListener('click', function () {
        ordenarPosicion('goles');
    });
    document.getElementById('opcion2').addEventListener('click', function () {
        ordenarPosicion('asistencias');
    });

    document.getElementById('opcion3').addEventListener('click', function () {
        ordenarPosicion('minutos');
    });

    document.getElementById('opcion4').addEventListener('click', function () {
        ordenarPosicion('valor');
    });

} else if(idLIGAURL==null && nombreEQUIPOURL==null &&   seleccionURL==null &&   posicion==null){
    document.getElementById('opcion1').addEventListener('click', function () {
        ordenar('goles');
    });
    document.getElementById('opcion2').addEventListener('click', function () {
        ordenar('asistencias');
    });

    document.getElementById('opcion3').addEventListener('click', function () {
        ordenar('minutos');
    });

    document.getElementById('opcion4').addEventListener('click', function () {
        ordenar('valor');
    });
}
