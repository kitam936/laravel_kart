<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Engine編集
        </h2>

        <div class="flex mt-4 ml-8">
        <div class="ml-2 ">
            <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
        </div>

        {{-- <div class="ml-12 md:ml-12">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >My_Engine_List</button>
        </div> --}}
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

            <form method="POST" action="{{ route('myengine_update',['engine'=>$my_engine->my_engine_id]) }}" enctype="multipart/form-data">
                @csrf
                <x-input type="hidden" id="my_engine_id" name="my_engine_id" value="{{ $my_engine->my_engine_id }}"/>

                <div class="">
                    <div class="relative w-32 ml-2 ">
                        <x-label for="id" value="ID" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $my_engine->my_engine_id }}">{{ $my_engine->my_engine_id  }}
                        </div>
                    </div>
                    <div class="ml-2 mr-2">
                        <x-label for="engine_id" value="Engine" class="mt-1"/>
                        <div class="ml-0 w-52">
                            <select  id="engine_id" name="engine_id"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="{{ $my_engine->engine_id }}" @if(\Request::get('engine_id') == '0') selected @endif >{{ $my_engine->engine_name }}</option>
                            @foreach ($engines as $engine)
                                <option value="{{ $engine->engine_id }}" @if(\Request::get('engine_id') == $engine->engine_id) selected @endif >{{ $engine->engine_name }}</option>
                            @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="mt-1 ">
                <div class="flex">
                    <div class="ml-2">
                        <x-label for="purchase_date" value="購入日" />
                        <x-input id="purchase_date" class="bg-gray-100 text-gray-800 block mt-1 w-full" id="purchase_date" type="text" name="purchase_date" value="{{ \Carbon\Carbon::parse($my_engine->purchase_date)->format('Y-m-d') }}" required  />
                    </div>
                    </div>
                    <div class="relative">
                        <x-label for="my_engine_info" value="MyEngine情報" class="mt-1 ml-2 mr-2"/>
                        {{-- <label for="cir_info" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">info</label> --}}
                        <x-textarea id="my_engine_info" name="my_engine_info" rows="3" required class="ml-2 w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{!! nl2br(e($my_engine->my_engine_info)) !!}</x-textarea>
                    </div>

                </div>


                </div>
                <div class="flex justify-between">

                <div class="p-2 w-1/2 mx-auto flex">
                    <div class="p-2 w-full mt-2 flex justify-around">
                        <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新</button>
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

