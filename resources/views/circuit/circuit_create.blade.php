<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Circuit登録
        </h2>

        <div class="flex mt-4 ml-8">

        <div class="ml-12 md:ml-12">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('circuit_list') }}'" >Circuit_List</button>
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

            <form method="POST" action="{{ route('circuit_store') }}" enctype="multipart/form-data">
                @csrf


                <div class="">
                    <div class="ml-2 mr-2">
                        <x-label for="area_id" value="エリア" class="mt-1"/>
                        {{-- <label for="area_id" class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >エリア　</label> --}}
                        <div class="ml-0 w-52">
                                {{-- <label for="area_id" class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >エリア　</label> --}}
                                <select  id="area_id" name="area_id"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                {{-- <option value="" @if(\Request::get('area_id') == '0') selected @endif >エリア</option> --}}
                                <option value="" @if(\Request::get('area_id') == '0') selected @endif >エリア選択</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->area_id }}" @if(\Request::get('area_id') == $area->area_id) selected @endif >{{ $area->area_name }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="relative">
                            <x-label for="cir_name" value="サーキット名" class="mt-1"/>
                            {{-- <label for="cir_name" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">サーキット名</label> --}}
                            <x-input id="cir_name" name="cir_name" :value="old('cir_name')" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></x-input>
                        </div>
                        <div class="relative">
                            <x-label for="length" value="コース長（M）" class="mt-1"/>
                            {{-- <label for="length" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">コース長（M）</label> --}}
                            <x-input id="length" name="length" :value="old('length')" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></x-input>
                        </div>
                    </div>
                </div>
                <div class="mt-1 ">

                    <div class="relative">
                        <x-label for="url" value="HP" class="mt-1 ml-2 mr-2"/>
                        {{-- <label for="url" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">HP</label> --}}
                        <x-input id="url" name="url" :value="old('url')" class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></x-input>
                    </div>
                    <div class="relative">
                        <x-label for="cir_info" value="サーキット情報" class="mt-1 ml-2 mr-2"/>
                        {{-- <label for="cir_info" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">info</label> --}}
                        <x-textarea id="cir_info" name="cir_info" rows="8" required class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('cir_info')  }}</x-textarea>
                    </div>
                </div>



            <div class="p-0 md:flex">
                <div class="relative">
                    <x-label for="image1" value="画像1" class="mt-00  ml-2 mr-2"/>
                    <input type="file" id="image1" name="image1" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative">
                    <x-label for="image2" value="画像2" class="mt-00  ml-2 mr-2"/>
                    <input type="file" id="image2" name="image2" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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

