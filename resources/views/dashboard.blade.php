<x-app-layout>

    <!-- <div id="windy" class="w-full h-[70vh] rounded-lg overflow-hidden shadow-lg mt-2"></div> -->
      <iframe
    class="w-full h-[70vh]"
    src="https://embed.windy.com/embed2.html?lat=15.5&lon=108.0&zoom=5&level=surface&overlay=wind&menu=&message=true&marker=&calendar=&pressure=true&type=map&location=coordinates"
    frameborder="0"
  ></iframe>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6 space-y-6 text-slate-200">

                    <!-- ✅ Leaflet 1.4.0 -->
                    <div class="w-full h-[70vh] rounded-lg overflow-hidden shadow-lg mt-2">

</div>

                    
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
