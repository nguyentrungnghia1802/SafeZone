<x-app-layout>

    <style>
@keyframes alert-border-glow {
    0% {
        box-shadow: 0 0 0 0 rgba(236, 72, 72, 0.6); /* hồng nhạt */
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

    <div class="max-w-4xl mx-auto py-10 px-4 text-white">
        <h1 class="text-2xl font-bold mb-6 text-pink-400 flex items-center gap-2">
            🚨 Danh sách cảnh báo
        </h1>

        <!-- Danh sách alert -->
        <ul id="alert-list" class="space-y-4">
            @foreach($alerts as $alert)
                <li class="group relative flex items-start gap-4 rounded-xl border-l-4 p-5 shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden h-[140px]
    {{ match($alert->severity) {
        'low' => 'border-green-400 bg-green-900/30',
        'medium' => 'border-yellow-400 bg-yellow-900/30',
        'high' => 'border-orange-500 bg-orange-900/30',
        'critical' => 'border-red-600 bg-red-900/40',
        default => 'border-gray-500 bg-gray-800',
    } }}">
    
    <!-- Ảnh cảnh báo -->
    <!-- Ảnh cảnh báo -->
        <div class="flex items-center justify-center w-16 h-16 rounded-md overflow-hidden border border-gray-600 bg-gray-700">
            @if($alert->image_path)
                <img src="{{ asset('storage/' . $alert->image_path) }}" 
                     alt="{{ $alert->title }}" 
                     class="object-contain w-full h-full">
            @else
                <img src="{{ asset('images/base.png') }}" 
                     alt="default" 
                     class="object-contain w-full h-full opacity-70">
            @endif
        </div>

    <!-- Nội dung cảnh báo -->
    <div class="flex-1 min-w-0">
        <div class="flex justify-between items-start">
            <h2 class="text-lg font-semibold text-white truncate pr-2">{{ $alert->title }}</h2>
            <span class="text-xs px-2 py-1 rounded-md uppercase font-semibold tracking-wide
                {{ match($alert->severity) {
                    'low' => 'bg-green-700 text-green-100',
                    'medium' => 'bg-yellow-700 text-yellow-100',
                    'high' => 'bg-orange-700 text-orange-100',
                    'critical' => 'bg-red-700 text-red-100',
                    default => 'bg-gray-700 text-gray-300',
                } }}">
                {{ $alert->severity }}
            </span>
        </div>

        <p class="text-sm text-gray-400 mt-1 truncate">
            {{ ucfirst($alert->type) }} • {{ $alert->created_at->format('d/m/Y H:i') }}
        </p>

        <!-- Mô tả, giới hạn 3 dòng -->
        <p class="mt-2 text-gray-200 text-sm line-clamp-2 leading-relaxed">
            {{ $alert->description }}
        </p>
    </div>
</li>

            @endforeach
        </ul>

        <!-- Template thêm alert mới -->
        <template id="alert-template">
    <li class="group relative flex items-start gap-4 rounded-xl border-l-4 p-5 shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden h-[140px] animate-pulse">
        <div class="w-14 h-14 flex-shrink-0">
            <img src="/images/base.png" 
                 alt="default" 
                 class="w-14 h-14 object-cover rounded-lg border border-gray-600 opacity-70">
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start">
                <h2 class="text-lg font-semibold text-pink-300 truncate pr-2"></h2>
                <span class="text-xs px-2 py-1 rounded-md uppercase bg-gray-700 text-gray-300"></span>
            </div>
            <p class="text-sm text-gray-400 mt-1 truncate"></p>
            <p class="mt-2 text-gray-200 text-sm line-clamp-2 leading-relaxed"></p>
        </div>
    </li>
</template>

    </div>

    <!-- Socket.IO -->
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
    });

    function addAlert(alert) {
        const list = document.getElementById("alert-list");
        const template = document.getElementById("alert-template").content.cloneNode(true);
        const li = template.querySelector("li");

       // Cập nhật ảnh cảnh báo
const img = li.querySelector("img");
img.src = `/storage/${alert.image_path || 'images/base.png'}`;
img.alt = alert.title || "alert image";



        // Set màu theo severity
        const severityStyles = {
            low: "border-green-400 bg-green-900/30",
            medium: "border-yellow-400 bg-yellow-900/30",
            high: "border-orange-500 bg-orange-900/30",
            critical: "border-red-600 bg-red-900/40",
        };
        li.classList.add(...(severityStyles[alert.severity] || "border-gray-500 bg-gray-800").split(" "));

        // Set dữ liệu
        li.querySelector("h2").textContent = alert.title;
        li.querySelector("span.text-xs").textContent = alert.severity;
        li.querySelector("p.text-gray-400").textContent =
            `${capitalize(alert.type)} • ${new Date(alert.created_at).toLocaleString()}`;
        li.querySelector("p.mt-2").textContent = alert.description || "Không có mô tả.";

        // Thêm hiệu ứng "mới"
        li.classList.add("alert-new", "animate-pulse");

        setTimeout(() => {
            li.classList.remove("alert-new", "animate-pulse");
        }, 20000);


        list.prepend(li);
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    </script>
    @endpush
</x-app-layout>
