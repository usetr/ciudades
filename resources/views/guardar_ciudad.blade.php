<head>
    <!-- Otras metaetiquetas y encabezados aquí -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    
    
    
        <div class="form-group">
            <label for="">pais</label><br>
            <select name="pais" id="pais" onchange="getState()"> 
            <option value="" selected disabled>Seleccionar</option>
            </select> <br><br>
            

            <label for="">estado</label><br>
            <select name="estado" id="estado" onchange="getCity()">
            <option value="" selected disabled>Seleccionar</option>
            </select> <br><br>

            <label for="">ciudad</label><br>
            <select name="ciudad" id="ciudad" onchange="detalleC()">
            <option value="" selected disabled>Seleccionar</option>
            </select><br><br>

            <div id="info">
                
            </div>

           
        </div>

        <button onclick="guardarDatos()">Guardar</button>
    
        
    
       
</div>
<script>
    var detallesCiudad;
    getContry();
    function getContry(){
       let headers = new Headers();
        headers.append("X-CSCAPI-KEY", "QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==");

       let requestOptions = {
            method: 'GET',
        headers: headers,
        redirect: 'follow'
        };

        fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
        .then(response => response.json())
        .then(result => {
                        // Obtén el elemento select
           let selectElement = document.getElementById("pais");
           selectElement.innerHTML = '';

            // Array de opciones que quieres agregar
           let opciones = result;

            // Itera sobre el array y crea opciones
            for (var i = 0; i < opciones.length; i++) {
            // Crea un elemento de opción
           let opcion = document.createElement("option");

            // Asigna el valor y el texto de la opción
            opcion.value = opciones[i] ['iso2'];
            opcion.text = opciones[i]['name'];

            // Agrega la opción al select
            selectElement.add(opcion);
            }

        })
        .catch(error => console.log('error', error));

    }

    function getState(){
       let headers = new Headers();
        headers.append("X-CSCAPI-KEY", "QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==");

       let requestOptions = {
            method: 'GET',
        headers: headers,
        redirect: 'follow'
        };
        let pais = document.getElementById("pais").value;


        fetch("https://api.countrystatecity.in/v1/countries/"+pais+"/states", requestOptions)
        .then(response => response.json())
        .then(result => {
            console.log(result);
                        // Obtén el elemento select
           let selectElement = document.getElementById("estado");
           selectElement.innerHTML = '';

            // Array de opciones que quieres agregar
           let opciones = result;

            // Itera sobre el array y crea opciones
            for (var i = 0; i < opciones.length; i++) {
            // Crea un elemento de opción
           let opcion = document.createElement("option");

            // Asigna el valor y el texto de la opción
            opcion.value = opciones[i] ['iso2'];
            opcion.text = opciones[i]['name'];

            // Agrega la opción al select
            selectElement.add(opcion);
            }

        })
        .catch(error => console.log('error', error));

    }

    function getCity(){
       let headers = new Headers();
        headers.append("X-CSCAPI-KEY", "QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==");

       let requestOptions = {
            method: 'GET',
        headers: headers,
        redirect: 'follow'
        };
        let pais = document.getElementById("pais").value;
        let estado = document.getElementById("estado").value;


        fetch("https://api.countrystatecity.in/v1/countries/"+pais+"/states/"+estado+"/cities", requestOptions)
        .then(response => response.json())
        .then(result => {
            console.log(result);
                        // Obtén el elemento select
           let selectElement = document.getElementById("ciudad");
           selectElement.innerHTML = '';

            // Array de opciones que quieres agregar
           let opciones = result;

            // Itera sobre el array y crea opciones
            for (var i = 0; i < opciones.length; i++) {
            // Crea un elemento de opción
           let opcion = document.createElement("option");

            // Asigna el valor y el texto de la opción
            opcion.value = opciones[i] ['name'];
            opcion.text = opciones[i]['name'];

            // Agrega la opción al select
            selectElement.add(opcion);
            }

        })
        .catch(error => console.log('error', error));

    }

    function detalleC(){

        let ciudad = document.getElementById("ciudad").value;

        fetch('https://api.api-ninjas.com/v1/city?name=' + ciudad, {
        method: 'GET',
        headers: {
            'X-Api-Key': '2IcApMQr2QgqcZ7X8iGhKw==bnUksqDgjX7ooPvx',
            'Content-Type': 'application/json'
        }
        })
        .then(response => {
            if (!response.ok) {
            throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            console.log(result);
            let info = document.getElementById("info")
            let country = document.createElement("label").innerHTML=result[0].country;
            let is_capital = document.createElement("label").innerHTML=result[0].is_capital;
            let latitude = document.createElement("label").innerHTML=result[0].latitude;
            let longitude= document.createElement("label").innerHTML=result[0].longitude;
            let name = document.createElement("label").innerHTML=result[0].name;
            let population = document.createElement("label").innerHTML=result[0].population;
            info.append(country,is_capital,latitude,longitude,name,population);

            detallesCiudad=result
            
        })
        .catch(error => {
            console.error('Error:', error);
        });
               
    }
    function guardarDatos(){
        console.log(detallesCiudad);
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch('/guardar-city', {
                method: 'POST',
                body: JSON.stringify({ciudad:detallesCiudad[0]}),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken
                }
            }).then(response => {
                return response.json()
            }).then(data => {
                alert('se guardo la ciudad')
              
                

            }).catch(error => console.log(error))
    }


</script>

