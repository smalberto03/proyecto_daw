// Función para obtener opciones de profesores o secciones según el tipo seleccionado
function fetchOptions() {
    const tipo = document.getElementById('search-type').value;
    const idSelect = document.getElementById('search-id');

    // Limpiar opciones existentes
    idSelect.innerHTML = '<option value="">Cargando...</option>';

    // Realiza una solicitud AJAX para obtener las opciones
    fetch(`get_options.php?tipo=${tipo}`)
        .then(response => response.json())
        .then(data => {
            idSelect.innerHTML = ''; // Limpiar opción de carga
            data.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.id;

                // Diferenciar entre profesores y secciones
                if (tipo === 'profesor') {
                    // Mostrar nombre y apellido para profesores
                    opt.textContent = `${option.name} ${option.lastname || ''}`;
                } else if (tipo === 'seccion') {
                    // Mostrar solo el nombre para secciones
                    opt.textContent = option.name;
                }

                idSelect.appendChild(opt);
            });
        })
        .catch(error => console.error('Error al obtener opciones:', error));
}

// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
    let idProfesorSeleccionado = null; // Variable para almacenar el idProfesor seleccionado

    // Añade un event listener para el envío del formulario
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el comportamiento por defecto del envío del formulario

        // Crea un objeto FormData a partir del formulario
        const formData = new FormData(this);

        // Guarda el idProfesor seleccionado
        idProfesorSeleccionado = formData.get('id');

        // Realiza una solicitud AJAX al servidor usando fetch
        fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
            .then(response => {
                // Verifica si la respuesta es exitosa
                if (!response.ok) {
                    throw new Error('No se ha encontrado adonde apunta el fetch');
                }
                // Convierte la respuesta a JSON
                return response.json();
            })
            .then(data => {
                // Llena la tabla de horarios con los datos recibidos
                llenarTablaHorario(data);
                // Muestra la tabla de horarios
                document.getElementById('horario-table').style.display = 'table';
            })
            .catch(error => console.error('Error:', error)); // Maneja cualquier error que ocurra
    });

    // Función para llenar la tabla de horarios con los datos recibidos
    function llenarTablaHorario(horario) {
        console.log(horario); // Verifica los datos recibidos
        const table = document.getElementById('horario-table');
        const tbody = table.querySelector('tbody');

        // Limpia el contenido actual de la tabla
        tbody.innerHTML = '';

        // Genera rangos de números para las horas y días
        const horas = rango(1, 7);
        const dias = rango(1, 5);

        // Itera sobre cada hora y crea una fila en la tabla para cada hora
        horas.forEach(hora => {
            const row = document.createElement('tr');
            row.innerHTML = `<td>${hora}</td>`;

            // Itera sobre cada día y añade una celda a la fila para cada día
            dias.forEach(dia => {
                const asignatura = horario.find(item => item.hora == hora && item.diaSemana == dia);

                if (asignatura) {
                    console.log('Asignatura:', asignatura); // Verifica los datos de la asignatura
                    if (asignatura.nombreSeccion) {
                        // Añade un botón de eliminación si la asignatura es de tipo 'e'
                        if (asignatura.tipoAsignatura === 'e') {
                            row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.nombreSeccion})</td>`;
                        } else {
                            row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.nombreSeccion})</td>`;
                        }
                    } else if (asignatura.cod_profesor) {
                        row.innerHTML += `<td>${asignatura.nombreAsignatura} (${asignatura.cod_profesor})</td>`;
                    } else {
                        // Añade un botón de eliminación si la asignatura es de tipo 'e'
                        if (asignatura.tipoAsignatura === 'e') {
                            row.innerHTML += `<td>${asignatura.nombreAsignatura}</td>`;
                        } else {
                            console.log('Asignatura especial NO encontrada:', asignatura);
                            row.innerHTML += `<td>${asignatura.nombreAsignatura}</td>`;
                        }
                    }
                } else {
                    // Añade un botón "Añadir" en las celdas vacías
                    // row.innerHTML += `<td><button class="add-button" data-dia="${dia}" data-hora="${hora}">+</button></td>`;
                }
            });

            tbody.appendChild(row);
        });

        // Añade event listeners a los botones "Añadir"
        document.querySelectorAll('.add-button').forEach(button => {
            button.addEventListener('click', function() {
                const diaSemana = this.getAttribute('data-dia');
                const hora = this.getAttribute('data-hora');

                // Realiza una solicitud AJAX para obtener las asignaturas especiales
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
                            button.addEventListener('click', function() {
                                // Realiza una solicitud AJAX para obtener las secciones
                                fetch(`get_secciones.php`)
                                    .then(response => response.json())
                                    .then(data => {
                                        const seccionesContainer = document.getElementById('secciones-container');
                                        seccionesContainer.style.display = 'block';
                                        const seccionesDiv = document.getElementById('secciones');
                                        seccionesDiv.innerHTML = '';

                                        data.forEach(seccion => {
                                            const seccionButton = document.createElement('button');
                                            seccionButton.textContent = seccion.name;
                                            seccionButton.addEventListener('click', function() {
                                                // Inserta una nueva fila en la tabla de horarios
                                                insertarFilaEnTabla(diaSemana, hora, asignatura.idAsignatura, seccion.id);
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

        // Añade event listeners a los botones "Eliminar"
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const diaSemana = this.getAttribute('data-dia');
                const hora = this.getAttribute('data-hora');
                const idAsignatura = this.getAttribute('data-asignatura');

                console.log('Eliminar botón clickeado:', diaSemana, hora, idAsignatura); // Verifica que los datos se están obteniendo correctamente

                // Realiza una solicitud AJAX para eliminar la fila de la tabla Horarios
                fetch(`eliminar_horario.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `diaSemana=${diaSemana}&hora=${hora}&idAsignatura=${idAsignatura}&idProfesor=${idProfesorSeleccionado}`
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data); // Verifica la respuesta del servidor
                    if (data.success) {
                        // Vuelve a cargar el horario actualizado
                        const formData = new FormData(document.getElementById('search-form'));
                        fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
                            .then(response => response.json())
                            .then(data => {
                                llenarTablaHorario(data);
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        // Muestra un mensaje de error al usuario
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    }


    // Función para insertar una nueva fila en la tabla de horarios
    function insertarFilaEnTabla(diaSemana, hora, idAsignatura, idSeccion) {
        fetch(`insertar_horario.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `diaSemana=${diaSemana}&hora=${hora}&idAsignatura=${idAsignatura}&idSeccion=${idSeccion}&idProfesor=${idProfesorSeleccionado}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualiza la tabla de horarios con la nueva fila
                const table = document.getElementById('horario-table');
                const tbody = table.querySelector('tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `<td>${hora}</td><td>${diaSemana}</td><td>${data.nombreAsignatura}</td><td>${data.nombreSeccion}</td>`;
                tbody.appendChild(newRow);

                // Oculta los contenedores de asignaturas y secciones
                document.getElementById('asignaturas-especiales-container').style.display = 'none';
                document.getElementById('secciones-container').style.display = 'none';

                // Vuelve a cargar el horario actualizado
                const formData = new FormData(document.getElementById('search-form'));
                fetch(`conseguirhorario.php?${new URLSearchParams(formData)}`)
                    .then(response => response.json())
                    .then(data => {
                        llenarTablaHorario(data);
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                // Muestra un mensaje de error al usuario
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Función para generar un array de números en un rango específico
    function rango(inicio, fin) {
        return Array.from({ length: fin - inicio + 1 }, (_, i) => inicio + i);
    }
});
