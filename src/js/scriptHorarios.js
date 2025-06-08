/**
 * Inicialización al cargar el DOM
 */
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('search-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se ha encontrado adonde apunta el fetch');
                }
                return response.json();
            })
            .then(data => {
                llenarTablaHorario(data);
                document.getElementById('horario-table').style.display = 'table';
            })
            .catch(error => console.error('Error:', error));
    });
});

/**
 * Obtiene opciones de profesores o secciones según el tipo seleccionado
 */
function fetchOptions() {
    const tipo = document.getElementById('search-type').value;
    const idSelect = document.getElementById('search-id');

    idSelect.innerHTML = '<option value="">Cargando...</option>';

    fetch(`get_options.php?tipo=${tipo}`)
        .then(response => response.json())
        .then(data => {
            idSelect.innerHTML = '';
            data.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.id;

                if (tipo === 'profesor') {
                    opt.textContent = `${option.name} ${option.lastname || ''}`;
                } else if (tipo === 'seccion') {
                    opt.textContent = option.name;
                }

                idSelect.appendChild(opt);
            });
        })
        .catch(error => console.error('Error al obtener opciones:', error));
}

/**
 * Llena la tabla de horarios con los datos recibidos
 * @param {Array} horario - Arreglo de objetos con los datos del horario
 */
function llenarTablaHorario(horario) {
    const table = document.getElementById('horario-table');
    const tbody = table.querySelector('tbody');
    tbody.innerHTML = '';

    const horas = rango(1, 7);
    const dias = rango(1, 5);

    horas.forEach(hora => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${hora}</td>`;

        dias.forEach(dia => {
            const asignatura = horario.find(item => item.hora == hora && item.diaSemana == dia);

            if (asignatura) {
                if (asignatura.nombreSeccion) {
                    if (asignatura.tipoAsignatura === 'e') {
                        row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.nombreSeccion}) <button class="delete-button" data-dia="${dia}" data-hora="${hora}" data-asignatura="${asignatura.idAsignatura}">Eliminar</button></td>`;
                    } else {
                        row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.nombreSeccion})</td>`;
                    }
                } else if (asignatura.cod_profesor) {
                    row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.cod_profesor})</td>`;
                } else {
                    if (asignatura.tipoAsignatura === 'e') {
                        row.innerHTML += `<td>${asignatura.nombreAsignatura} <button class="delete-button" data-dia="${dia}" data-hora="${hora}" data-asignatura="${asignatura.idAsignatura}">Eliminar</button></td>`;
                    } else {
                        row.innerHTML += `<td>${asignatura.nombreAsignatura}</td>`;
                    }
                }
            } else {
                row.innerHTML += `<td><button class="add-button" data-dia="${dia}" data-hora="${hora}">+</button></td>`;
            }
        });

        tbody.appendChild(row);
    });

    addEventListenersToButtons();
}

/**
 * Inserta una nueva fila de horario en la base de datos y actualiza la tabla
 * @param {number} diaSemana 
 * @param {number} hora 
 * @param {number} idAsignatura 
 * @param {number} idSeccion 
 * @param {number} idProfesor 
 */
function insertarFilaEnTabla(diaSemana, hora, idAsignatura, idSeccion, idProfesor) {
    fetch(`insertar_horario.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `diaSemana=${diaSemana}&hora=${hora}&idAsignatura=${idAsignatura}&idSeccion=${idSeccion}&idProfesor=${idProfesor}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('asignaturas-especiales-container').style.display = 'none';
                document.getElementById('secciones-container').style.display = 'none';

                const formData = new FormData(document.getElementById('search-form'));
                fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
                    .then(response => response.json())
                    .then(data => llenarTablaHorario(data))
                    .catch(error => console.error('Error:', error));
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

/**
 * Agrega eventos a los botones de añadir y eliminar en la tabla de horarios
 */
function addEventListenersToButtons() {
    document.querySelectorAll('.add-button').forEach(button => {
        button.addEventListener('click', function () {
            const diaSemana = this.getAttribute('data-dia');
            const hora = this.getAttribute('data-hora');

            fetch(`get_asignaturas_especiales.php`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('asignaturas-especiales-container');
                    container.style.display = 'block';
                    const asignaturasContainer = document.getElementById('asignaturas-especiales');
                    asignaturasContainer.innerHTML = '';

                    data.forEach(asignatura => {
                        const button = document.createElement('button');
                        button.textContent = asignatura.nombreAsignatura;
                        button.addEventListener('click', function () {
                            fetch(`get_secciones.php`)
                                .then(response => response.json())
                                .then(secciones => {
                                    const seccionesContainer = document.getElementById('secciones-container');
                                    seccionesContainer.style.display = 'block';
                                    const seccionesDiv = document.getElementById('secciones');
                                    seccionesDiv.innerHTML = '';

                                    secciones.forEach(seccion => {
                                        const seccionButton = document.createElement('button');
                                        seccionButton.textContent = seccion.name;
                                        seccionButton.addEventListener('click', function () {
                                            const idProfesor = document.getElementById('search-id').value;
                                            insertarFilaEnTabla(diaSemana, hora, asignatura.idAsignatura, seccion.id, idProfesor);
                                        });
                                        seccionesDiv.appendChild(seccionButton);
                                    });
                                })
                                .catch(error => console.error('Error al obtener secciones:', error));
                        });
                        asignaturasContainer.appendChild(button);
                    });
                })
                .catch(error => console.error('Error al obtener asignaturas especiales:', error));
        });
    });

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            const diaSemana = this.getAttribute('data-dia');
            const hora = this.getAttribute('data-hora');
            const idAsignatura = this.getAttribute('data-asignatura');
            const idProfesor = document.getElementById('search-id').value;

            fetch(`eliminar_horario.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `diaSemana=${diaSemana}&hora=${hora}&idAsignatura=${idAsignatura}&idProfesor=${idProfesor}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const formData = new FormData(document.getElementById('search-form'));
                        fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
                            .then(response => response.json())
                            .then(data => llenarTablaHorario(data))
                            .catch(error => console.error('Error:', error));
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
}

/**
 * Genera un array de números entre un rango dado
 * @param {number} inicio - Número inicial del rango
 * @param {number} fin - Número final del rango
 * @returns {number[]} - Array de números entre inicio y fin
 */
function rango(inicio, fin) {
    return Array.from({ length: fin - inicio + 1 }, (_, i) => inicio + i);
}
