<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            MyTire詳細
        </h2>
        <div class="flex">
        <form>
            <div class="md:flex md:ml-20">
            <x-input type="hidden" id="my_tire_id" name="my_tire_id" value="{{ $mytire->my_tire_id }}"/>
            <x-input type="hidden" id="tire_id" name="tire_id" value="{{ $mytire->tire_id }}"/>

            <div class="ml-2 ">
                <button type="button" class="w-24 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
            </div>
            {{-- <div class="ml-0 md:ml-4">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mytire_index') }}'" >My_tire_List</button>
            </div> --}}

            </div>
        </form>
        <div class="flex justify-between">
        <div class="w-1/2 mt-0 flex md:ml-60">
            <div class="md:ml-2 md:ml-4">
                <button type="button" class="w-24 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('mytire_edit',['tire'=>$mytire->my_tire_id])}}'" >編集</button>
            </div>
            <form id="delete_{{$mytire->my_tire_id}}" method="POST" action="{{ route('mytire_destroy',['tire'=>$mytire->my_tire_id]) }}">

                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-24 h-8 bg-red-500 text-sm text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $mytire->my_tire_id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="mb-2 max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            {{-- @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif --}}

            <x-flash-message status="session('status')"/>

            {{-- {{ $resv_id }} --}}
            <div class="flex ml-2 mr-4 mt-1">
                <div class="relative w-16 ml-0 ">
                    <x-label for="id" value="ID" class="mt-1"/>
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $mytire->my_tire_id }}">{{ $mytire->my_tire_id  }}
                    </div>
                </div>

                    <div class="relative w-32 ml-2">
                        <x-label for="purchase_date" value="購入日" class="mt-1"/>
                        <div name="purchase_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $mytire->purchase_date}}" >
                            {{ \Carbon\Carbon::parse($mytire->purchase_date)->format('Y-m-d') }}
                        </div>
                    </div>

                <div class="ml-2 mr-4 flex">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="tire_name" value="tire" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="tire_name" name="emgine_name"  value="{{ $mytire->tire_name }}">{{ $mytire->tire_name  }}
                        </div>
                    </div>

                </div>
            </div>




            @if(!empty($mytire->my_tire_info))
            <div class="ml-2 mr-4">
                <x-label for="my_tire_info" value="Mytire情報" class="mt-1"/>
                <div row="5" id="my_tire_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="my_tire_info" >{!! nl2br(e($mytire->my_tire_info)) !!}</div>
            </div>
            @endif
            </div>


            </form>
            </div>

            </div>
        </div>

        <div class=" max-w-2xl mt-2 mx-auto sm:px-6 lg:px-8 rounded">
            @if(!empty($stints_total->laps))
            <div class='border bg-gray-100 h-6'>
                　　　Lap数：{{ ($stints_total->laps) }}　周　　走行距離：{{ floor(($stints_total->distance)/1000)  }}Km　
            </div>
            @endif
        </div>


    <div class=" mx-auto sm:px-4 lg:px-4 border ">
        {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
        <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
            <thead>
                <tr>
                    {{-- <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">No</th> --}}
                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">走行日</th>
                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">サーキット</th>
                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Laps</th>
                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">距離</th>
                </tr>
            </thead>

            <tbody>
                {{-- @foreach ($tires as $tire)

                <tr>
                    <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('mytire_show',['tire'=>$tire->my_tire_id]) }}" >{{ $tire->my_tire_id }} </a></td>
                    <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($tire->purchase_date)->format("y/m/d") }} </td>
                    <td class="w-2/13 md:2/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('tire_show',['tire'=>$tire->tire_id]) }}" > {{$tire->tire_name}}</a> </td>

                @endforeach --}}

                @foreach ($stints as $stint)

                <tr>
                    {{-- <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('stint_show',['stint'=>$stint->id]) }}" >{{ $stint->id }} </a></td> --}}
                    <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($stint->date)->format("y/m/d") }} </td>
                    <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $stint->cir_name }} </td>
                    <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $stint->laps }} </td>
                    <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ floor($stint->distance/1000) }}km </td>
                @endforeach

            </tbody>

        </table>
        {{-- {{  $users->links()}} --}}
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

