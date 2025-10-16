<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Address') }}
        </h2>
    </x-slot>
    <x-alert />
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <!-- Bản đồ -->
    <div class="h-[500px] mb-6">
        <x-map-view :locations="$addresses" :zoom="7" />
    </div>

    <!-- Nút thêm địa chỉ -->
    <div class="flex justify-end">
        <a href="{{ route('addresses.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add address
        </a>
    </div>
</div>


</x-app-layout>





