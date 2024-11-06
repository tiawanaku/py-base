@if(isset($geojsonData))
    <!-- Mostrar el mapa con GeoJSON -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Mapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 70%;"></div> <!-- Ajustar el tamaño del mapa al 70% -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Esperar a que el modal se haya mostrado
        $('#myModal').on('shown.bs.modal', function () {
            // Inicializa el mapa solo después de que el modal esté visible
            const map = L.map('map').setView([40.4168, -3.7038], 15); // Usa la latitud y longitud predeterminadas

            // Añadir los tiles del mapa
            L.tileLayer('https://tile.openstreetmap.de/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // Si hay datos geojson, añádelos al mapa
            @if(isset($geojsonData))
                L.geoJSON(@json($geojsonData)).addTo(map);
            @endif
        });
    </script>
@else
    <p>No hay mapa disponible.</p>
@endif
