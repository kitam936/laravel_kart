<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Engineメンテナンス登録
        </h2>

        <div class="flex mt-4 ml-8">
            <div class="flex relative w-16 ml-0 ">
                <x-label for="id" value="ID" class="mt-0"/>
                <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $myengine->id }}">{{ $myengine->id  }}
                </div>
            </div>
        <div class="ml-12 md:ml-12">
            <x-input type="hidden" id="myengine_id" name="myengine_id" value="{{ $myengine->id }}"/>
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_show',['engine'=>$myengine->id]) }}'" >MyEngine詳細</button>
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

            <form method="POST" action="{{ route('eg_maint_store') }}" >
                @csrf
                <x-input type="hidden" id="myengine_id2" name="myengine_id2" value="{{ $myengine->id }}"/>

                <div class="mt-1 ">
                    <div class="flex">

                    <div class="ml-2">
                        <x-label for="maint_date" value="実施日" />
                        <x-input id="maint_date" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="maint_date" type="text" name="maint_date" :value="old('maint_date')" required  />
                    </div>

                    </div>
                    <div class="ml-2 mr-2">
                        <x-label for="eg_maint_category_id" value="メンテナンスカテゴリー" class="mt-1"/>
                        <div class="ml-0 w-full">
                                <select  id="eg_maint_category_id" name="eg_maint_category_id"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="" @if(\Request::get('eg_maint_category_id') == '0') selected @endif >カテゴリー選択</option>
                                @foreach ($eg_maint_categories as $eg_maint_category)
                                    <option value="{{ $eg_maint_category->id }}" @if(\Request::get('eg_maint_category_id') == $eg_maint_category->id) selected @endif >{{ $eg_maint_category->eg_maint_name }}---{{ $eg_maint_category->eg_maint_category_info }}</option>
                                @endforeach
                                </select>
                        </div>

                    </div>

                    <div class="relative">
                        <x-label for="eg_maint_info" value="メンテナンス内容" class="mt-1 ml-2 "/>
                        {{-- <label for="cir_info" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">info</label> --}}
                        <x-textarea id="eg_maint_info" name="eg_maint_info" rows="3" class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('eg_maint_info')  }}</x-textarea>
                    </div>

                    <div class="ml-2 mr-2">
                        <x-label for="maint_fee" value="費用" class="mt-1"/>
                        <x-input id="maint_fee" class="bg-gray-100 text-gray-800  rounded block mt-1 w-full" id="maint_fee" type="text" name="maint_fee" :value="old('maint_fee')"  />
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

