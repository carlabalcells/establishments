import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')) {

        const lat = 55.9495303;
        const lng = -3.1899738;

        const mapa = L.map('mapa').setView([lat, lng], 16);

        //Eliminar pines previos
        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin, draggable para poder arrastrar el pin / autoPan para mover dinamicamente el mapa con el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        //Agregar el pin a las capas
        markers.addLayer(marker);

        //Geocode Service
        const geocodeService = L.esri.Geocoding.geocodeService({ 
            apikey: "AAPKed6c9a9475744710bd202a1c810d5e21j4HLAcA8DacBvqJlLfEKIaPKQqsTONtse9sE-Me2sYja1v7fWEj11uStrx5jFpmG"
        }); 

        //Buscador de direcciones
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);

        //Detectar movimiento del pin
        reubicarPin(marker);
    } 

    function reubicarPin(marker){
        //Detectar movimiento del pin
        marker.on('moveend', function(e){
            marker = e.target;
            const posicion = marker.getLatLng();

            //centrar automaticamente
            mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));

            //Reverse Geocoding cuando el usuari reubica el pin
            geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado){
                
                marker.bindPopup(resultado.address.LongLabel);
                marker.openPopup();

                //Llenar los campos
                llenarInputs(resultado);
            });

        })
    }

    function buscarDireccion(e){

        if(e.target.value.length > 10){
            provider.search({ query: e.target.value + ' UK ' })
                .then( resultado => {
                    if(resultado){

                        //Limpiamos pines previos
                        markers.clearLayers();

                        //Reverse Geocoding cuando el usuario reubica el pin
                        geocodeService.reverse().latlng(resultado[0].bounds[0], 16).run(function(error, resultado){
                            
                            //Llenar los inputs
                            llenarInputs(resultado);

                            //Centrar el mapa
                            mapa.setView(resultado.latlng);

                            //Agregar el pin
                            marker = new L.marker(resultado.latlng, {
                                draggable: true,
                                autoPan: true
                            }).addTo(mapa);

                            //assignar el contenedor de markets el nuevo pin
                            markers.addLayer(marker);

                            //Mover el pin
                            reubicarPin(marker);
                        })
                    }
                })
                .catch(
                    error => {
                        console.log(error);
                    }
                )
        }
    }

    function llenarInputs(resultado){
       document.querySelector('#direccion').value = resultado.address.Address || '';
       document.querySelector('#city').value = resultado.address.City || '';
       document.querySelector('#lat').value = resultado.latlng.lat || '';
       document.querySelector('#lng').value = resultado.latlng.lng || '';
    }
});    