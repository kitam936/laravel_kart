<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category Data
        </h2>
        <div class="p-1 text-gray-900 dark:text-gray-100  ">
            <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 text-sm mb-2 border-gray-900 p-0 text-sm text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
            <button type="button" class="w-32 h-8 text-sm ml-2 mb-2 border-gray-900 p-0 text-sm text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('ch_category_index') }}'" >Chassis</button>
            <button type="button" class="w-32 h-8 text-sm ml-2 mb-2 border-gray-900 p-0 text-sm text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('eg_category_index') }}'" >Engine</button>
            {{-- <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mytire_index') }}'" >タイヤ</button> --}}
            </div>

        </div>

    </x-slot>

</x-app-layout>
