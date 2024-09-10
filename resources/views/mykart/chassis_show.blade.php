<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            My Chassis詳細
        </h2>
    <form>
        <div class="md:flex md:ml-20">
        <x-input type="hidden" id="mykart_id" name="mykart_id" value="{{ $kart->kart_id }}"/>

        <div class="ml-0 md:ml-4">
            <button type="button" class="w-40 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_index') }}'" >Chassis_Kist</button>
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
                <div>
                    <div class="relative w-32 ml-2 ">
                        <x-label for="id" value="ID" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $kart->kart_id }}">{{ $kart->kart_id  }}
                        </div>
                    </div>

                </div>
                <div class="flex ml-2 mr-4 mt-1">
                    <div class="relative w-32">
                        <x-label for="purchase_date" value="購入日" class="mt-1"/>
                        <div name="purchase_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $kart->purchase_date}}" >
                            {{ \Carbon\Carbon::parse($kart->purchase_date)->format('Y-m-d') }}
                        </div>
                    </div>

                </div>



                <div class="ml-2 mr-4 flex">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="maker_name" value="Maker" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maker_name" name="maker_name"  value="{{ $kart->maker_name }}">{{ $kart->maker_name  }}
                        </div>
                    </div>
                    <div>
                        <x-label for="model_year" value="ModelYear" class="mt-1"/>
                        <div id="model_year" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="model_year" value="{{ $kart->model_year}}" >{{ $kart->model_year}}</div>
                    </div>

                </div>

                {{-- </div> --}}



            @if(!empty($kart->my_kart_info))
            <div class="ml-2 mr-4">
                <x-label for="my_kart_info" value="コメント" class="mt-1"/>
                <div row="5" id="my_kart_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="my_kart_info" >{!! nl2br(e($kart->my_kart_info)) !!}</div>
            </div>
            @endif

            <div class="flex ml-0 px-2 mx-auto">
                <div class="w-full mb-1">
                    @if(!empty($kart->photo1))
                    <span class=" text-sm ">画像1</span>
                    <img src="{{ asset('storage/kart/'.$kart->photo1) }}">
                    @endif
                    {{-- <img src="{{ asset('storage/users/'.$user->photo1) }}"> --}}
                </div>
                <div class="w-full mb-1 ml-1">
                    @if(!empty($kart->photo2))
                    <span class=" text-sm ">画像2</span>
                    <img src="{{ asset('storage/kart/'.$kart->photo2) }}">
                    @endif
                    {{-- <img src="{{ asset('storage/users/'.$user->photo2) }}"> --}}
                </div>

            </div>
            </div>


            <div class="flex justify-between">
            <div class="p-2 w-1/2 mt-2 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('chassis_edit',['chassis'=>$kart->kart_id])}}'" >編集</button>
                </div>
            <form id="delete_{{$kart->kart_id}}" method="POST" action="{{ route('chassis_destroy',['chassis'=>$kart->kart_id]) }}">
                <input type="hidden" id="photo1" name="photo1" value="{{ $kart->photo1 }}" />
                <input type="hidden" id="photo2" name="photo2" value="{{ $kart->photo2 }}" />
                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-40 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $kart->kart_id }}" onclick="deletePost(this)" >削除</a>
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

