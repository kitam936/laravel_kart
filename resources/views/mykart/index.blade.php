<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            MyKart
        </h2>
        <div class="flex md:flex-auto p-1 text-gray-900 dark:text-gray-100  ">
            <div class="md:flex px-4 py-4 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-4 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_index') }}'" >シャーシ</button>
            <button type="button" class="w-32 h-8 ml-4 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >エンジン</button>
            <button type="button" class="w-32 h-8 ml-4 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mytire_index') }}'" >タイヤ</button>

            </div>
        </div>

    </x-slot>

</x-app-layout>
