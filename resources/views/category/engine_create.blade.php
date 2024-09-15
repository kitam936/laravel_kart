<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Engine Category登録
        </h2>

        <div class="flex mt-4 ml-8">

        <div class="ml-12 md:ml-12">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-sm text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('category_index') }}'" >category List</button>
        </div>
        </div>

    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            {{-- @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif --}}

            <x-flash-message status="session('status')"/>

            <form method="POST" action="{{ route('eg_category_store') }}" >
                @csrf

                <div class="ml-2 mr-2">
                    <x-label for="eg_maint_name" value="カテゴリー名" class="mt-1"/>
                    <x-input id="eg_maint_name" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="eg_maint_name" type="text" name="eg_maint_name" :value="old('eg_maint_name')" required  />
                </div>

                <div class="relative">
                    <x-label for="eg_maint_info" value="カテゴリー情報" class="mt-1 ml-2 mr-2"/>
                    {{-- <label for="cir_info" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">info</label> --}}
                    <x-textarea id="eg_maint_info" name="eg_maint_info" rows="3" required class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('eg_maint_info')  }}</x-textarea>
                </div>

            </div>

            </div>
            <div class="flex justify-between">

            <div class="p-2 w-1/2 mx-auto flex">
                <div class="p-2 w-full mt-2 flex justify-around">
                    <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録</button>
                </div>
            </div>
            </div>
        </form>


            </div>

            </div>
        </div>


    <script>
        function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
        }
    </script>
</x-app-layout>

