<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            MyEngine詳細
        </h2>
    <form>
        <div class="md:flex md:ml-20">
        <x-input type="hidden" id="my_engine_id" name="my_engine_id" value="{{ $myengine->my_engine_id }}"/>
        <x-input type="hidden" id="engine_id" name="engine_id" value="{{ $myengine->engine_id }}"/>
        <div class="ml-0 md:ml-4">
            <button type="button" class="w-40 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >My_Engine_List</button>
        </div>

        </div>
    </form>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="mb-2 max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-flash-message status="session('status')"/>

            {{-- {{ $resv_id }} --}}
                <div class="relative w-32 ml-2 ">
                    <x-label for="id" value="ID" class="mt-1"/>
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $myengine->my_engine_id }}">{{ $myengine->my_engine_id  }}
                    </div>
                </div>
                <div class="flex ml-2 mr-4 mt-1">
                    <div class="relative w-32">
                        <x-label for="purchase_date" value="購入日" class="mt-1"/>
                        <div name="purchase_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $myengine->purchase_date}}" >
                            {{ \Carbon\Carbon::parse($myengine->purchase_date)->format('Y-m-d') }}
                        </div>
                    </div>

                </div>



                <div class="ml-2 mr-4 flex">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="engine_name" value="Engine" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="engine_name" name="emgine_name"  value="{{ $myengine->engine_name }}">{{ $myengine->engine_name  }}
                        </div>
                    </div>

                </div>

                {{-- </div> --}}



            @if(!empty($myengine->my_engine_info))
            <div class="ml-2 mr-4">
                <x-label for="my_engine_info" value="MyEngine情報" class="mt-1"/>
                <div row="5" id="my_engine_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="my_engine_info" >{!! nl2br(e($myengine->my_engine_info)) !!}</div>
            </div>
            @endif
            </div>


            <div class="flex justify-between">
            <div class="p-2 w-1/2 mt-2 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('myengine_edit',['engine'=>$myengine->my_engine_id])}}'" >編集</button>
                </div>
            <form id="delete_{{$myengine->my_engine_id}}" method="POST" action="{{ route('myengine_destroy',['engine'=>$myengine->my_engine_id]) }}">

                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-40 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $myengine->my_engine_id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            </div>
            </div>


            </form>
            </div>

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

