<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Tire詳細
        </h2>
    <form>
        <div class="md:flex md:ml-20">
        <x-input type="hidden" id="tire_id" name="tire_id" value="{{ $tire->id }}"/>
        <x-input type="hidden" id="tire_id" name="tire_id" value="{{ $tire->id }}"/>
        <div class="ml-2 ">
            <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
        </div>
        <div class="ml-0 md:ml-4">
            <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('tire_index') }}'" >Tire List</button>
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
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $tire->id }}">{{ $tire->id  }}
                    </div>
                </div>

                <div class="ml-0 mr-4 flex">
                    <div class="relative w-32 ml-2 ">
                        <x-label for="maker_name" value="Maker_Name" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maker_name" name="maker_name"  value="{{ $tire->tire_maker_name }}">{{ $tire->tire_maker_name  }}
                        </div>
                    </div>
                    <div class="relative w-32 ml-2 mr-2 ">
                        <x-label for="tire_name" value="tire" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="tire_name" name="emgine_name"  value="{{ $tire->tire_name }}">{{ $tire->tire_name  }}
                        </div>
                    </div>

                </div>

                {{-- </div> --}}



            @if(!empty($tire->tire_info))
            <div class="ml-2 mr-4">
                <x-label for="tire_info" value="tire情報" class="mt-1"/>
                <div row="5" id="tire_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="tire_info" >{!! nl2br(e($tire->tire_info)) !!}</div>
            </div>
            @endif
            </div>


            <div class="ml-2 flex justify-between">
            <div class="p-2 w-1/2 mt-2 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('tire_edit',['tire'=>$tire->id])}}'" >編集</button>
                </div>
            @if($login_user->role_id == 1)
            <form id="delete_{{$tire->id}}" method="POST" action="{{ route('tire_destroy',['tire'=>$tire->id]) }}">

                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-32 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $tire->id }}" onclick="deletePost(this)" >削除</a>
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

