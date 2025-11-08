<x-app-layout>

    <style>
        @keyframes alert-border-glow {
            0% {
                box-shadow: 0 0 0 0 rgba(236, 72, 72, 0.6);
                border-color: rgba(236, 72, 72, 0.8);
            }
            50% {
                box-shadow: 0 0 15px 4px rgba(236, 72, 72, 0.8);
                border-color: rgb(236, 72, 72);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 72, 0.6);
                border-color: rgba(236, 72, 72, 0.8);
            }
        }

        .alert-new {
            animation: alert-border-glow 1.5s ease-in-out infinite;
            transition: all 0.3s ease;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cảnh báo thiên tai') }}
        </h2>
    </x-slot>

    <x-alert />

    <div class="max-w-7xl mx-auto py-10 sm:px-6">

        <!-- MAP -->
        <div class="h-[500px] mb-6">
            <x-map-alert :alerts="$alerts" :zoom="7" />
        </div>

        <form method="GET" class="mb-6 bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-md flex flex-wrap gap-4 items-end">

    <!-- Search -->
    <div class="flex-1 min-w-[200px]">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tìm kiếm</label>
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Nhập từ khóa..."
               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Severity -->
    <div class="min-w-[150px]">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Độ nghiêm trọng</label>
        <select name="severity"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
            <option value="">Tất cả</option>
            <option value="low" {{ request('severity')=='low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ request('severity')=='medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ request('severity')=='high' ? 'selected' : '' }}>High</option>
            <option value="critical" {{ request('severity')=='critical' ? 'selected' : '' }}>Critical</option>
        </select>
    </div>

    <!-- Type -->
    <div class="min-w-[150px]">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Loại cảnh báo</label>
        <select name="type"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-2 focus:ring-green-400 focus:border-green-400">
            <option value="">Tất cả</option>
            <option value="storm" {{ request('type')=='storm' ? 'selected' : '' }}>Bão</option>
            <option value="flood" {{ request('type')=='flood' ? 'selected' : '' }}>Lũ lụt</option>
            <option value="fire" {{ request('type')=='fire' ? 'selected' : '' }}>Cháy rừng</option>
        </select>
    </div>

    <!-- Date From -->
    <div class="min-w-[150px]">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Từ ngày</label>
        <input type="date" name="from_date" value="{{ request('from_date') }}"
               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Buttons -->
    <div class="flex gap-2 mt-2 sm:mt-0">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-colors">
            Lọc
        </button>
        <a href="{{ route('alerts.index') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded-lg shadow hover:bg-gray-500 transition-colors">
            Clear
        </a>
    </div>
</form>



        <!-- ALERT LIST -->
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Alert List
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="alert-list">

                @foreach ($alerts as $alert)
                    <div class="rounded-xl shadow-lg p-4 flex flex-col hover:shadow-xl hover:scale-[1.02]
                        transition-all duration-300 border-l-4
                        {{ match($alert->severity) {
                            'low' => 'border-green-400 bg-green-900/20',
                            'medium' => 'border-yellow-400 bg-yellow-900/20',
                            'high' => 'border-orange-400 bg-orange-900/20',
                            'critical' => 'border-red-500 bg-red-900/30',
                            default => 'border-gray-400 bg-gray-700/30'
                        } }}"
                    >
                        <!-- ẢNH -->
                        <div class="w-full h-40 rounded-lg overflow-hidden mb-4 bg-gray-700 border border-gray-600">
                            @if ($alert->image_path != 'base.png')
                                <img src="{{ asset('storage/' . $alert->image_path) }}"
                                     class="object-contain w-full h-full" />
                            @else
                                <img src="{{ asset('images/base.png') }}"
                                     class="object-contain w-full h-full opacity-60" />
                            @endif
                        </div>

                        <!-- NỘI DUNG -->
                        <div class="flex-1 flex flex-col">

                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-white leading-tight">
                                    {{ $alert->title }}
                                </h3>

                                <span class="px-2 py-1 text-xs rounded-md font-bold uppercase
                                    {{ match($alert->severity) {
                                        'low' => 'bg-green-700 text-green-100',
                                        'medium' => 'bg-yellow-700 text-yellow-100',
                                        'high' => 'bg-orange-700 text-orange-100',
                                        'critical' => 'bg-red-700 text-red-100',
                                        default => 'bg-gray-700 text-gray-200'
                                    } }}"
                                >
                                    {{ $alert->severity }}
                                </span>
                            </div>

                            <p class="text-gray-300 text-sm mb-1">
                                {{ ucfirst($alert->type) }} • {{ $alert->created_at->format('d/m/Y H:i') }}
                            </p>

                            <p class="text-gray-200 text-sm line-clamp-3 leading-relaxed">
                                {{ $alert->description }}
                            </p>

                        </div>

                        <div class="mt-4 flex justify-between items-center">
                                <a href="#"
                                   onclick=""
                                   class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    View
                                </a>
                        </div>
                    </div>


                @endforeach

                <!-- TEMPLATE ALERT MỚI -->
                <template id="alert-template">
                    <div class="rounded-xl shadow-lg p-4 flex flex-col hover:shadow-xl transition-all duration-300
                                border-l-4 animate-pulse bg-gray-700/30">

                        <!-- IMAGE -->
                        <div class="w-full h-40 rounded-lg overflow-hidden mb-4 bg-gray-700 border border-gray-600">
                            <img src="/images/base.png"
                                 alt="default"
                                 class="object-contain w-full h-full opacity-70">
                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1 flex flex-col">

                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-white leading-tight alert-title"></h3>

                                <span class="px-2 py-1 text-xs rounded-md font-bold uppercase alert-severity">
                                </span>
                            </div>

                            <p class="text-gray-300 text-sm alert-meta"></p>

                            <p class="text-gray-200 text-sm line-clamp-3 leading-relaxed mt-2 alert-description"></p>
                        </div>

                    </div>
                </template>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>

        <script>
            const socket = io("http://localhost:6001");

            socket.on("connect", () => {
                console.log("✅ Đã kết nối realtime server:", socket.id);
            });

            socket.on("alertCreated", (alert) => {
                console.log("📢 Có alert mới:", alert);
                addAlert(alert);

                if (typeof window.addAlertToMap === "function") {
                    window.addAlertToMap(alert);
                } else {
                    console.warn("⚠️ Hàm addAlertToMap chưa sẵn sàng");
                }
            });

            function addAlert(alert) {
                const grid = document.getElementById("alert-list");
                const template = document.getElementById("alert-template").content.cloneNode(true);

                const card = template.querySelector("div");

                // IMAGE
                const img = card.querySelector("img");
                img.src = alert.image_path ? `/storage/${alert.image_path}` : "/images/base.png";
                img.alt = alert.title || "alert image";

                // CARD COLOR
                const severityStyles = {
                    low: "border-green-400 bg-green-900/20",
                    medium: "border-yellow-400 bg-yellow-900/20",
                    high: "border-orange-400 bg-orange-900/20",
                    critical: "border-red-500 bg-red-900/30",
                };
                card.classList.add(...(severityStyles[alert.severity] || "border-gray-400 bg-gray-700/30").split(" "));

                // TITLE
                card.querySelector(".alert-title").textContent = alert.title;

                // BADGE
                const severityBadge = card.querySelector(".alert-severity");
                severityBadge.textContent = alert.severity;

                const badgeStyles = {
                    low: "bg-green-700 text-green-100",
                    medium: "bg-yellow-700 text-yellow-100",
                    high: "bg-orange-700 text-orange-100",
                    critical: "bg-red-700 text-red-100",
                };
                severityBadge.classList.add(
                    ...(badgeStyles[alert.severity] || "bg-gray-700 text-gray-200").split(" ")
                );

                // META
                card.querySelector(".alert-meta").textContent =
                    `${capitalize(alert.type)} • ${new Date(alert.created_at).toLocaleString()}`;

                // DESCRIPTION
                card.querySelector(".alert-description").textContent =
                    alert.description || "Không có mô tả.";

                // EFFECT
                card.classList.add("alert-new", "animate-pulse");
                setTimeout(() => {
                    card.classList.remove("alert-new", "animate-pulse");
                }, 20000);

                // PREPEND
                grid.prepend(card);
            }

            function capitalize(str) {
                return str ? str.charAt(0).toUpperCase() + str.slice(1) : "";
            }
        </script>
    @endpush>

</x-app-layout>
