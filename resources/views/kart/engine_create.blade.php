<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Engine登録
        </h2>

        <div class="flex mt-4 ml-8">

        <div class="ml-12 md:ml-12">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-sm text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('engine_index') }}'" >Engine List</button>
        </div>
        </div>

    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- <x-flash-message status="session('status')"/> --}}

            <form method="POST" action="{{ route('engine_store') }}" enctype="multipart/form-data">
                @csrf


                <div class="">
                    <div class="ml-2 mr-2">
                        <x-label for="engine_maker" value="メーカー" class="mt-1"/>
                        <x-input id="engine_maker" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="engine_maker" type="text" name="engine_maker" :value="old('engine_maker')" required  />
                    </div>
                    <div class="ml-2 mr-2">
                        <x-label for="engine_name" value="エンジン名" class="mt-1"/>
                        <x-input id="engine_name" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="engine_name" type="text" name="engine_name" :value="old('engine_name')" required  />
                    </div>
                </div>



                <div class="relative">
                    <x-label for="engine_info" value="Engine情報" class="mt-1 ml-2 mr-2"/>
                    {{-- <label for="cir_info" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">info</label> --}}
                    <x-textarea id="engine_info" name="engine_info" rows="3" required class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('engine_info')  }}</x-textarea>
                </div>

                <div class="ml-2 mr-2">
                    <x-label for="sort_order" value="並び順" class="mt-1"/>
                    <x-input id="sort_order" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="sort_order" type="text" name="sort_order" :value="old('sort_order')" required  />
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

