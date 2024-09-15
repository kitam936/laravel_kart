<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            MyKart
        </h2>
        <div class="flex text-gray-900 dark:text-gray-100  ">
            <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-0 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_index') }}'" >シャーシ</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >エンジン</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mytire_index') }}'" >タイヤ</button>
            </div>
        </div>
        @if($login_user->role_id ==1)
        <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-0 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-pink-400  hover:bg-pink-600 rounded" onclick="location.href='{{ route('category_index') }}'" >カテゴリーData</button>

        </div>
        @endif
    </x-slot>

</x-app-layout>
