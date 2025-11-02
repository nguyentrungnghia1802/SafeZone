<x-app-layout>

    <div id="windy" class="w-full h-[70vh] rounded-lg overflow-hidden shadow-lg mt-2"></div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6 space-y-6 text-slate-200">

                    <!-- ✅ Leaflet 1.4.0 -->
                    <script>
                        const options = {
                            key: "{{ config('services.windy.key') }}",
                            lat: 16.0544,
                            lon: 108.2022,
                            zoom: 5,
                            overlay: 'wind',
                        };

                        const windyScript = document.createElement('script');
                        windyScript.src = "https://api.windy.com/assets/libBoot.js";
                        windyScript.onload = () => {
                            if (typeof windyInit === 'function') {
                                windyInit(options, windyAPI => {
                                    const { map, store, picker } = windyAPI;
                                    console.log("✅ Windy map đã sẵn sàng!");

                                    // ======================
                                    // Thanh legend
                                    // ======================
                                    const legendDiv = document.createElement('div');
                                    legendDiv.id = 'legend';
                                    legendDiv.className =
                                        'absolute bottom-2 left-1/2 -translate-x-1/2 z-[9999] text-white text-xs px-3 py-1 rounded shadow';
                                    document.getElementById('windy').appendChild(legendDiv);

                                    const updateLegend = (layer) => {
                                        let gradient = '', labels = '';
                                        if (layer === 'wind') {
                                            gradient = 'linear-gradient(to right, #6271B8, #4A94AA, #4DA67C, #6AAE4A, #A26D5C, #974B91)';
                                            labels = ['0', '10', '20', '35', '55', '70', '100 km/h'];
                                        } else if (layer === 'temp') {
                                            gradient = 'linear-gradient(to right, #2C7BB6, #ABD9E9, #FFFFBF, #FDAE61, #D7191C)';
                                            labels = ['-20°C', '0°C', '10°C', '20°C', '30°C', '40°C'];
                                        } else if (layer === 'pressure') {
                                            gradient = 'linear-gradient(to right, #4575B4, #91BFDB, #E0F3F8, #FFFFBF, #FEE090, #FC8D59, #D73027)';
                                            labels = ['950', '970', '990', '1010', '1030', '1050 hPa'];
                                        }

                                        legendDiv.innerHTML = `
                                            <div class="bg-gray-900/80 rounded-lg px-3 py-2">
                                                <div class="w-72 h-3 rounded" style="background: ${gradient};"></div>
                                                <div class="flex justify-between mt-1 text-[11px]">
                                                    ${labels.map(l => `<span>${l}</span>`).join('')}
                                                </div>
                                            </div>
                                        `;
                                    };
                                    updateLegend('wind');

                                    // ======================
                                    // Thanh chọn lớp overlay hiện đại
                                    // ======================
                                    const controlDiv = document.createElement('div');
                                    controlDiv.className =
                                        'absolute top-4 right-4 flex flex-col gap-2 z-[9999] select-none';

                                    const layers = [
                                        { id: 'wind', name: 'Wind', img: 'https://www.windy.com/img/menu3/wind.jpg' },
                                        { id: 'temp', name: 'Temperature', img: 'https://www.windy.com/img/menu3/temp.jpg' },
                                        { id: 'pressure', name: 'Pressure', img: 'https://www.windy.com/img/menu3/pressure.jpg' },
                                    ];

                                    layers.forEach(layer => {
                                        const btn = document.createElement('div');
                                        btn.className = `
                                            overlay-btn flex items-center gap-3 cursor-pointer 
                                            bg-black/60 text-white rounded-full px-0 py-0 w-[160px]
                                            backdrop-blur-sm shadow-md border border-white/10
                                            hover:scale-[1.03] hover:border-white/30 transition-all duration-200 ease-out
                                        `;

                                        btn.innerHTML = `
                                            <div class="w-8 h-8 rounded-full overflow-hidden border border-white/20 flex-shrink-0">
                                                <img src="${layer.img}" alt="${layer.name}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="text-sm">${layer.name}</div>
                                        `;

                                        btn.addEventListener('click', () => {
                                            store.set('overlay', layer.id);
                                            updateLegend(layer.id);
                                            console.log(`🌀 Đã chuyển sang lớp: ${layer.id}`);
                                            document.querySelectorAll('#windy .overlay-btn').forEach(b =>
                                                b.classList.remove('ring-2', 'ring-white', 'scale-105')
                                            );
                                            btn.classList.add('ring-2', 'ring-white', 'scale-105');
                                        });

                                        controlDiv.appendChild(btn);
                                    });

                                    document.getElementById('windy').appendChild(controlDiv);
                                    // ======================
                                    // 🔳 Nút fullscreen hiện đại
                                    // ======================
                                    const fullscreenBtn = document.createElement('button');
                                    fullscreenBtn.className = `
                                        absolute bottom-4 right-4 z-[9999] 
                                        bg-gray-900/70 dark:bg-gray-700 text-white 
                                        p-3 rounded-full shadow-lg 
                                        backdrop-blur-md 
                                        hover:bg-gray-800 dark:hover:bg-gray-600 
                                        transition-all duration-300 ease-in-out 
                                        opacity-80 hover:opacity-100
                                    `;
                                    fullscreenBtn.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3H5a2 2 0 00-2 2v3m0 8v3a2 2 0 002 2h3m8-18h3a2 2 0 012 2v3m0 8v3a2 2 0 01-2 2h-3" />
                                        </svg>
                                    `;

                                    let isFullscreen = false;

                                    fullscreenBtn.addEventListener('click', () => {
                                        const mapContainer = document.getElementById('windy');
                                        if (!isFullscreen) {
                                            mapContainer.classList.add('fixed', 'inset-0', 'z-[10000]', 'fade-in');
                                            mapContainer.requestFullscreen?.();
                                            fullscreenBtn.innerHTML = `
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform duration-300 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V5a2 2 0 012-2h3m8 18h3a2 2 0 002-2v-3M16 3h3a2 2 0 012 2v3M8 21H5a2 2 0 01-2-2v-3" />
                                                </svg>
                                            `;
                                        } else {
                                            mapContainer.classList.remove('fixed', 'inset-0', 'z-[10000]', 'fade-in');
                                            document.exitFullscreen?.();
                                            fullscreenBtn.innerHTML = `
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3H5a2 2 0 00-2 2v3m0 8v3a2 2 0 002 2h3m8-18h3a2 2 0 012 2v3m0 8v3a2 2 0 01-2 2h-3" />
                                                </svg>
                                            `;
                                        }

                                        isFullscreen = !isFullscreen;
                                    });

                                    document.getElementById('windy').appendChild(fullscreenBtn);


                                    // ======================
                                    // P I C K E R  
                                    // ======================
                                    const infoDiv = document.createElement('div');
                                    infoDiv.className =
                                        'absolute top-4 left-4 bg-gray-900/80 text-white text-xs rounded p-2 z-[9999]';
                                    infoDiv.innerHTML = 'Nhấp vào bản đồ để xem giá trị...';
                                    document.getElementById('windy').appendChild(infoDiv);

                                    map.on('click', (e) => {
                                        const { lat, lng } = e.latlng;
                                        const overlay = store.get('overlay');
                                        picker.open({ lat, lon: lng });
                                        console.log('📌 Picker mở tại', lat, lng);

                                        setTimeout(() => {
                                            infoDiv.innerHTML = `
                                                <b>Tọa độ:</b> ${lat.toFixed(3)}, ${lng.toFixed(3)}<br>
                                                <b>Lớp:</b> ${overlay}<br>
                                            `;
                                        }, 500);
                                    });
                                });
                            } else {
                                console.error("❌ Windy API chưa sẵn sàng.");
                            }
                        };
                        document.body.appendChild(windyScript);
                    </script>
```
                {{-- 🌫️ Dashboard Glassmorphism hiện đại --}}
                <div class="space-y-6 text-slate-200">

                    {{-- Safety Status --}}
                    <div class="relative bg-white/10 dark:bg-white/5 backdrop-blur-xl border border-white/20 p-6 rounded-2xl shadow-lg hover:shadow-[0_0_25px_rgba(56,189,248,0.2)] transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-sky-500/20 rounded-xl border border-sky-400/20">
                                    <svg class="w-8 h-8 text-sky-400 drop-shadow-[0_0_8px_#38bdf8]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-sky-400">Bạn đang an toàn</h2>
                                    <p class="text-slate-300 mt-1">Không có cảnh báo khẩn cấp trong bán kính 10km.</p>
                                    <p class="text-xs text-slate-500 mt-1">Cập nhật: 2 phút trước</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="/alerts"
                                    class="px-4 py-2 rounded-lg bg-white/10 border border-white/20 hover:bg-white/20 text-slate-100 backdrop-blur-md transition-all duration-300">
                                    Xem cảnh báo
                                </a>
                                <button
                                    class="px-4 py-2 rounded-lg bg-sky-500/80 hover:bg-sky-500 text-white shadow-[0_0_10px_rgba(56,189,248,0.4)] transition-all duration-300">
                                    Gửi SOS
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="bg-white/10 dark:bg-white/5 backdrop-blur-xl border border-white/20 p-6 rounded-2xl shadow-lg">
                        <h4 class="text-sm font-semibold mb-4 text-slate-300 uppercase tracking-wider">Hành động nhanh</h4>
                        <div class="flex flex-wrap gap-3">
                            <button
                                class="flex items-center gap-2 px-4 py-3 rounded-xl bg-sky-500/30 hover:bg-sky-500/40 border border-sky-400/20 text-white font-medium shadow-[0_0_15px_rgba(56,189,248,0.25)] transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3v18" />
                                </svg>
                                Báo cáo nhanh
                            </button>

                            <button
                                class="flex items-center gap-2 px-4 py-3 rounded-xl bg-emerald-500/30 hover:bg-emerald-500/40 border border-emerald-400/20 text-white font-medium shadow-[0_0_15px_rgba(16,185,129,0.25)] transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20h9" />
                                </svg>
                                Hỗ trợ khẩn cấp
                            </button>

                            <button
                                class="flex items-center gap-2 px-4 py-3 rounded-xl bg-indigo-500/30 hover:bg-indigo-500/40 border border-indigo-400/20 text-white font-medium shadow-[0_0_15px_rgba(99,102,241,0.25)] transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m7-7v14" />
                                </svg>
                                Gửi vị trí
                            </button>
                        </div>
                    </div>

                </div>
```






                </div>
            </div>
        </div>
    </div>

</x-app-layout>
