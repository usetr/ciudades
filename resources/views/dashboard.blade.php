<head>

    <!-- Otras metaetiquetas y encabezados aquí -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Datos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .eliminar-boton {
            background-color: #ff0000; /* Rojo */
            color: #fff; /* Texto blanco */
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>País</th>
                                <th>Capital</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Población</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listarCiudades as $ciudad)
                                <tr>
                                    <td>{{ $ciudad['id'] }}</td>
                                    <td>{{ $ciudad['name'] }}</td>
                                    <td>{{ $ciudad['country'] }}</td>
                                    <td>{{ $ciudad['is_capital'] ? 'Sí' : 'No' }}</td>
                                    <td>{{ $ciudad['latitude'] }}</td>
                                    <td>{{ $ciudad['longitude'] }}</td>
                                    <td>{{ $ciudad['population'] }}</td>
                                    <td><button class="eliminar-boton" onclick="eliminarCiudad({{ $ciudad['id'] }})">Eliminar</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function eliminarCiudad(id) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Llamada a la función Fetch para eliminar por ID
        fetch('/eliminar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al eliminar la ciudad.');
            }
            return response.json();
        })
        .then(data => {
            // Puedes manejar la respuesta si es necesario
            console.log(data);
            // Eliminar la fila de la tabla
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>