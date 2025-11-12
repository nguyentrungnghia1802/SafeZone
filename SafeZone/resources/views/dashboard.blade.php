<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-950 via-slate-900 to-gray-950">
            <div class="mb-8 bg-gradient-to-br from-slate-800/40 to-slate-900/20 backdrop-blur-xl border border-slate-600/30 rounded-2xl p-8 shadow-xl">
                <iframe
                    class="w-full rounded-2xl overflow-hidden shadow-2xl"
                    style="height: 600px;"
                    src="https://embed.windy.com/embed2.html?lat=15.5&lon=108.0&zoom=5&level=surface&overlay=wind&menu=&message=true&marker=&calendar=&pressure=true&type=map&location=coordinates"
                    frameborder="0"
                ></iframe>
            </div>
            <!-- Thẻ trạng thái an toàn dưới map -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                <div class="bg-gradient-to-br from-slate-800/40 to-slate-900/20 backdrop-blur-xl border border-slate-600/30 rounded-2xl p-8 shadow-xl">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Trạng thái an toàn
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <!-- An toàn -->
                        <div class="group relative overflow-hidden rounded-xl p-6 bg-gradient-to-br from-emerald-500/20 to-green-500/20 border border-emerald-500/30">
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-emerald-500/30 rounded-xl">
                                    <svg class="w-10 h-10 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xl font-semibold text-white">An toàn</p>
                                    <p class="text-emerald-200/70 text-sm">Không có rủi ro đáng kể</p>
                                </div>
                            </div>
                        </div>

                        {{--
                        Đặt điều kiện render 2 thẻ dưới đây khi cần, ví dụ:
                        @if($stats['high_alerts'] > 0) ... Không an toàn ... @endif
                        @if($stats['critical_alerts'] > 0) ... Nguy hiểm ... @endif

                        <!-- Không an toàn (ẩn mặc định, sẽ kiểm tra điều kiện sau) -->
                        <div class="group relative overflow-hidden rounded-xl p-6 bg-gradient-to-br from-amber-500/20 to-yellow-500/20 border border-amber-500/30">
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-amber-500/30 rounded-xl">
                                    <svg class="w-10 h-10 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xl font-semibold text-white">Không an toàn</p>
                                    <p class="text-amber-200/70 text-sm">Cần thận trọng</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nguy hiểm (ẩn mặc định, sẽ kiểm tra điều kiện sau) -->
                        <div class="group relative overflow-hidden rounded-xl p-6 bg-gradient-to-br from-rose-500/20 to-pink-500/20 border border-rose-500/30">
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-rose-500/30 rounded-xl">
                                    <svg class="w-10 h-10 text-rose-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xl font-semibold text-white">Nguy hiểm</p>
                                    <p class="text-rose-200/70 text-sm">Hạn chế di chuyển</p>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>
                    <p class="text-xs text-slate-500 mt-4 italic">Thẻ tĩnh — bạn có thể thêm điều kiện hiển thị sau.</p>
                </div>
            </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">


            <!-- Cảnh báo Nguy hiểm và Cao -->
            <div class="space-y-6 mb-8">
                <!-- Cảnh báo Nguy hiểm (Critical) -->
                <div class="bg-gradient-to-br from-red-900/40 to-red-800/20 backdrop-blur-xl border border-red-500/30 rounded-2xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                                <svg class="w-8 h-8 text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Cảnh báo Nguy hiểm
                                <span class="px-3 py-1 bg-red-500/30 text-red-200 text-sm rounded-full">{{ $criticalAlerts->count() }}</span>
                            </h2>
                            <a href="/alerts?severity=critical" class="text-red-300 hover:text-red-200 text-sm font-medium transition-colors">
                                Xem tất cả →
                            </a>
                        </div>

                        @if($criticalAlerts->count() > 0)
                            <div class="space-y-3">
                                @foreach($criticalAlerts as $alert)
                                    <div class="group bg-red-950/50 hover:bg-red-950/70 border border-red-500/20 rounded-xl p-4 transition-all duration-300 hover:shadow-[0_0_20px_rgba(239,68,68,0.3)]">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0 p-3 bg-red-500/30 rounded-lg">
                                                @if($alert->type === 'storm')
                                                    <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                    </svg>
                                                @elseif($alert->type === 'flood')
                                                    <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                @elseif($alert->type === 'earthquake')
                                                    <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-semibold text-white mb-1 group-hover:text-red-300 transition-colors">
                                                    {{ $alert->title }}
                                                </h3>
                                                <p class="text-red-200/70 text-sm mb-2 line-clamp-2">{{ $alert->description }}</p>
                                                <div class="flex flex-wrap items-center gap-3 text-xs text-red-300/60">
                                                    @if($alert->address)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                            {{ $alert->address->city ?? 'N/A' }}
                                                        </span>
                                                    @endif
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $alert->created_at->diffForHumans() }}
                                                    </span>
                                                    @if($alert->creator)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                            </svg>
                                                            {{ $alert->creator->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500/20 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-red-300/70">Không có cảnh báo nguy hiểm</p>
                            </div>
                        @endif
                    </div>

                <!-- Cảnh báo Cao (High) -->
                <div class="bg-gradient-to-br from-orange-900/40 to-orange-800/20 backdrop-blur-xl border border-orange-500/30 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Cảnh báo Mức Cao
                            <span class="px-3 py-1 bg-orange-500/30 text-orange-200 text-sm rounded-full">{{ $highAlerts->count() }}</span>
                        </h2>
                        <a href="/alerts?severity=high" class="text-orange-300 hover:text-orange-200 text-sm font-medium transition-colors">
                            Xem tất cả →
                        </a>
                    </div>

                    @if($highAlerts->count() > 0)
                        <div class="space-y-3">
                            @foreach($highAlerts as $alert)
                                <div class="group bg-orange-950/50 hover:bg-orange-950/70 border border-orange-500/20 rounded-xl p-4 transition-all duration-300">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 p-3 bg-orange-500/30 rounded-lg">
                                            @if($alert->type === 'storm')
                                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                </svg>
                                            @elseif($alert->type === 'flood')
                                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            @elseif($alert->type === 'earthquake')
                                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-white mb-1">{{ $alert->title }}</h3>
                                            <p class="text-orange-200/70 text-sm mb-2 line-clamp-2">{{ $alert->description }}</p>
                                            <div class="flex flex-wrap items-center gap-3 text-xs text-orange-300/60">
                                                @if($alert->address)
                                                    <span>📍 {{ $alert->address->city ?? 'N/A' }}</span>
                                                @endif
                                                <span>🕒 {{ $alert->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar với thống kê và hành động nhanh -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="space-y-6">
                    <!-- Thống kê theo loại thiên tai -->
                    <div class="bg-gradient-to-br from-slate-800/40 to-slate-900/20 backdrop-blur-xl border border-slate-600/30 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Thống kê theo loại
                        </h3>
                        <div class="space-y-3">
                            @foreach($alertsByType as $type => $count)
                                <div class="flex items-center justify-between p-3 bg-slate-700/30 rounded-lg hover:bg-slate-700/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span>
                                            @if($type === 'storm')
                                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                </svg>
                                            @elseif($type === 'flood')
                                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            @elseif($type === 'earthquake')
                                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                            @elseif($type === 'fire')
                                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                                </svg>
                                            @elseif($type === 'landslide')
                                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                            @endif
                                        </span>
                                        <span class="text-slate-200 font-medium capitalize">{{ ucfirst($type) }}</span>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-500/30 text-blue-200 rounded-full text-sm font-semibold">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hành động nhanh -->
                    <div class="bg-gradient-to-br from-cyan-900/40 to-cyan-800/20 backdrop-blur-xl border border-cyan-600/30 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Hành động nhanh
                        </h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-medium shadow-lg hover:shadow-cyan-500/50 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Tạo cảnh báo mới
                            </button>
                            <button class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 text-white font-medium shadow-lg hover:shadow-red-500/50 transition-all duration-300 animate-pulse">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                Gửi SOS khẩn cấp
                            </button>
                            <a href="/alerts" class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-slate-700/50 hover:bg-slate-700/70 text-white font-medium border border-slate-600/30 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Xem tất cả cảnh báo
                            </a>
                        </div>
                    </div>

                    <!-- Trung tâm cứu hộ -->
                    <div class="bg-gradient-to-br from-emerald-900/40 to-emerald-800/20 backdrop-blur-xl border border-emerald-600/30 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Trung tâm cứu hộ
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-emerald-950/50 rounded-lg">
                                <span class="text-emerald-200 text-sm">Đội phản ứng nhanh</span>
                                <span class="px-2 py-1 bg-emerald-500/30 text-emerald-200 text-xs rounded-full">Hoạt động</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-emerald-950/50 rounded-lg">
                                <span class="text-emerald-200 text-sm">Cứu hộ miền Trung</span>
                                <span class="px-2 py-1 bg-yellow-500/30 text-yellow-200 text-xs rounded-full">Di chuyển</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-emerald-950/50 rounded-lg">
                                <span class="text-emerald-200 text-sm">Hỗ trợ giao thông</span>
                                <span class="px-2 py-1 bg-red-500/30 text-red-200 text-xs rounded-full">Tạm ngưng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bản đồ thống kê thiên tai theo quốc gia -->
            <div class="mt-8 bg-gradient-to-br from-slate-800/40 to-slate-900/20 backdrop-blur-xl border border-slate-600/30 rounded-2xl p-8 shadow-xl">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Thống kê thiên tai theo quốc gia
                </h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Bản đồ -->
                    <div>
                        <div id="map" class="rounded-xl overflow-hidden border border-slate-600/30 shadow-lg" style="height: 400px;"></div>
                        <p id="selectedCountry" class="text-sm text-slate-400 mt-3 italic">Nhấn vào bản đồ để chọn quốc gia...</p>
                    </div>

                    <!-- Thống kê -->
                    <div>
                        <h3 id="countryTitle" class="text-xl font-semibold text-white mb-4">Chọn quốc gia để xem thống kê</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-xl p-6 border border-blue-500/30">
                                <p id="stormCount" class="text-4xl font-bold text-blue-300 mb-2">--</p>
                                <p class="text-sm text-blue-200/70">Bão / Áp thấp</p>
                            </div>
                            <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-xl p-6 border border-amber-500/30">
                                <p id="earthquakeCount" class="text-4xl font-bold text-amber-300 mb-2">--</p>
                                <p class="text-sm text-amber-200/70">Động đất / Sóng thần</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-500/20 to-green-500/20 rounded-xl p-6 border border-emerald-500/30">
                                <p id="floodCount" class="text-4xl font-bold text-emerald-300 mb-2">--</p>
                                <p class="text-sm text-emerald-200/70">Lũ / Ngập lụt</p>
                            </div>
                            <div class="bg-gradient-to-br from-rose-500/20 to-pink-500/20 rounded-xl p-6 border border-rose-500/30">
                                <p id="diseaseCount" class="text-4xl font-bold text-rose-300 mb-2">--</p>
                                <p class="text-sm text-rose-200/70">Dịch bệnh / Khác</p>
                            </div>
                        </div>
                        <p id="updateTime" class="text-xs text-slate-500 mt-4 text-right italic">Chưa có dữ liệu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Tạo bản đồ
            const map = L.map("map").setView([20, 105], 3);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(map);

            let marker = null;

            // Khi người dùng click lên bản đồ
            map.on("click", async (e) => {
                const { lat, lng } = e.latlng;

                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lng]).addTo(map);

                document.getElementById("selectedCountry").textContent = "🔍 Đang xác định quốc gia...";

                try {
                    const geoRes = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`);
                    const geoData = await geoRes.json();
                    const country = geoData.address.country;

                    document.getElementById("selectedCountry").textContent = `🌍 Quốc gia: ${country}`;
                    document.getElementById("countryTitle").textContent = `Thống kê thiên tai gần đây tại ${country}`;

                    try {
                        const rwRes = await fetch(`https://api.reliefweb.int/v1/disasters?appname=safezone&limit=100`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                limit: 100,
                                filter: {
                                    field: 'country.name',
                                    value: country
                                }
                            })
                        });

                        if (!rwRes.ok) throw new Error('API not available');

                        const rwData = await rwRes.json();
                        const counts = { storm: 0, earthquake: 0, flood: 0, disease: 0 };
                        
                        if (rwData.data && Array.isArray(rwData.data)) {
                            rwData.data.forEach(d => {
                                const name = (d.fields?.name || '').toLowerCase();
                                if (name.includes("typhoon") || name.includes("storm") || name.includes("cyclone")) counts.storm++;
                                else if (name.includes("earthquake") || name.includes("tsunami")) counts.earthquake++;
                                else if (name.includes("flood") || name.includes("mudslide") || name.includes("landslide")) counts.flood++;
                                else counts.disease++;
                            });
                        }

                        document.getElementById("stormCount").textContent = counts.storm;
                        document.getElementById("earthquakeCount").textContent = counts.earthquake;
                        document.getElementById("floodCount").textContent = counts.flood;
                        document.getElementById("diseaseCount").textContent = counts.disease;
                        document.getElementById("updateTime").textContent = `Cập nhật: ${new Date().toLocaleTimeString()}`;

                    } catch (apiErr) {
                        const fallbackCounts = generateFallbackData(country);
                        document.getElementById("stormCount").textContent = fallbackCounts.storm;
                        document.getElementById("earthquakeCount").textContent = fallbackCounts.earthquake;
                        document.getElementById("floodCount").textContent = fallbackCounts.flood;
                        document.getElementById("diseaseCount").textContent = fallbackCounts.disease;
                        document.getElementById("updateTime").textContent = `⚠️ Dữ liệu ước tính`;
                    }
                } catch (err) {
                    document.getElementById("selectedCountry").textContent = "⚠️ Không thể xác định quốc gia";
                }
            });

            function generateFallbackData(country) {
                const profiles = {
                    'Vietnam': { storm: 8, earthquake: 2, flood: 12, disease: 3 },
                    'Việt Nam': { storm: 8, earthquake: 2, flood: 12, disease: 3 },
                    'Japan': { storm: 6, earthquake: 15, flood: 5, disease: 1 },
                    'Philippines': { storm: 12, earthquake: 8, flood: 10, disease: 4 },
                    'Indonesia': { storm: 7, earthquake: 20, flood: 9, disease: 5 },
                    'Thailand': { storm: 5, earthquake: 1, flood: 8, disease: 3 },
                    'China': { storm: 9, earthquake: 12, flood: 15, disease: 6 },
                    'India': { storm: 10, earthquake: 8, flood: 18, disease: 7 },
                    'United States': { storm: 11, earthquake: 5, flood: 7, disease: 2 }
                };
                return profiles[country] || { storm: 5, earthquake: 5, flood: 5, disease: 2 };
            }
        });
    </script>
</x-app-layout>
