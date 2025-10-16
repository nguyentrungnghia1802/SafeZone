<div class="relative w-full h-full">
    <div id="map" class="w-full h-full rounded-lg overflow-hidden shadow"></div>
</div>

    
<script>
    const MAPTILER_KEY = "{{ env('MAPTILER_KEY') }}";

    const locations = @json($locations);
    const center = locations.length > 0 
        ? [locations[0].longitude, locations[0].latitude]
        : [105.8342, 21.0278]; 

    // ==============================
    // Khởi tạo bản đồ
    // ==============================
    const map = new maplibregl.Map({
        container: 'map',
        style: `https://api.maptiler.com/maps/streets/style.json?key=${MAPTILER_KEY}`,
        center: center,
        zoom: {{ $zoom }}
    });

    map.addControl(new maplibregl.NavigationControl(), 'top-right');

    // ==============================
    // Hiển thị các markers
    // ==============================
    locations.forEach(location => {
        const marker = new maplibregl.Marker({ color: '#e63946' })
            .setLngLat([location.longitude, location.latitude])
            .setPopup(
                new maplibregl.Popup({ offset: 25 })
                    .setHTML(`<strong>${location.address_line}</strong>`)
            )
            .addTo(map);
    });

    // ==============================
    // Tự động fit bản đồ để hiển thị tất cả các điểm
    // ==============================
    if (locations.length > 1) {
        const bounds = new maplibregl.LngLatBounds();
        locations.forEach(loc => bounds.extend([loc.longitude, loc.latitude]));
        map.fitBounds(bounds, { padding: 80 });
    }

    map.dragPan.enable();
    map.scrollZoom.enable();
    map.boxZoom.enable();
    map.keyboard.enable();
</script>
