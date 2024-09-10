<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Maker詳細
        </h2>
    <form>
        <div class="md:flex md:ml-20">
        <x-input type="hidden" id="maker_id" name="maker_id" value="{{ $maker->id }}"/>
        <x-input type="hidden" id="maker_id" name="maker_id" value="{{ $maker->id }}"/>
        <div class="ml-0 md:ml-4">
            <button type="button" class="w-40 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('maker_index') }}'" >Maker_List</button>
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
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $maker->id }}">{{ $maker->id  }}
                    </div>
                </div>

                <div class="ml-0 mr-4 flex">

                    <div class="relative w-32 ml-2 mr-2 ">
                        <x-label for="maker_name" value="maker" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maker_name" name="emgine_name"  value="{{ $maker->maker_name }}">{{ $maker->maker_name  }}
                        </div>
                    </div>

                </div>

                {{-- </div> --}}



            @if(!empty($maker->maker_info))
            <div class="ml-2 mr-4">
                <x-label for="maker_info" value="maker情報" class="mt-1"/>
                <div row="5" id="maker_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="maker_info" >{!! nl2br(e($maker->maker_info)) !!}</div>
            </div>
            @endif
            </div>


            <div class="flex justify-between">
            <div class="p-2 w-1/2 mt-2 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('maker_edit',['maker'=>$maker->id])}}'" >編集</button>
                </div>
            @if($login_user->role_id == 1)
            <form id="delete_{{$maker->id}}" method="POST" action="{{ route('maker_destroy',['maker'=>$maker->id]) }}">

                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-40 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $maker->id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            @endif
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

