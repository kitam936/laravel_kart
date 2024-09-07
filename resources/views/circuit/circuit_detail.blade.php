<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl mb-4 text-gray-800 dark:text-gray-200 leading-tight">
        <div>
            Circuit詳細
        </div>
        </h2>

        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
        <input type="hidden" id="circuit_id" name="circuit_id" value="{{ $circuit->cir_id }}" />

        <div class="flex ml-0 ">
        <div class="ml-2 mb-2 md:mb-0">
            <button type="button" onclick="location.href='{{ route('circuit_list') }}'" class="w-32 h-8 text-center text-sm text-white bg-indigo-400 border-0 py-1 px-2 focus:outline-none hover:bg-indigo-600 rounded ">Circuit_List</button>
        </div>
        {{-- @foreach ($users as $user) --}}


        </div>
        <div class="flex md:ml-2 mt-2">
            <div class="flex md:ml-0">
                @if(!($favorite))
                <div class="ml-2 mb-2 md:ml-0">
                    <button type="button" onclick="location.href='{{ route('favorite_edit',['circuit'=>$circuit->cir_id])}}'" class="w-32  h-8 text-center text-sm text-white bg-blue-300 border-0 py-1 px-2 focus:outline-none hover:bg-blue-400 rounded ">ホームコース登録</button>
                </div>
                @else
                <div class="ml-2 mb-2 md:ml-0">
                    <button type="button" onclick="location.href='{{ route('favorite_edit_of',['circuit'=>$circuit->cir_id])}}'" class="w-32  h-8 text-center text-sm text-white bg-pink-400 border-0 py-1 px-2 focus:outline-none hover:bg-pink-500 rounded ">ホームコース解除</button>
                </div>
                @endif
            </div>
            <div class="ml-2 mb-2 md:ml-32">
                <button type="button" onclick="location.href='{{ route('circuit_edit',['circuit'=>$circuit->cir_id])}}'" class="w-32  h-8 text-center text-sm text-white bg-green-500 border-0 py-1 px-2 focus:outline-none hover:bg-green-600 rounded ">編集</button>
            </div>
            @if(($user->role_id == 1))
            <form id="delete_{{$circuit->cir_id}}" method="POST" action="{{ route('circuit_destroy',['circuit'=>$circuit->cir_id]) }}">
                @csrf
                {{-- @method('delete') --}}
                <div class="ml-2 mt-0 md:ml-4 md:mt-0">
                    <div  class="w-32  h-8 text-center text-sm text-white bg-red-500 border-0 py-1 px-2 focus:outline-none hover:bg-red-600 rounded ">
                    <a href="#" data-id="{{ $circuit->cir_id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            @endif
        </div>
        <span class="text-indigo-600 ml-4">ホームコース登録するとStintDataの新着お知らせメールが届きます。     </span>
        <br>
        <span class="text-indigo-600 ml-4">ホームコースはアカウント情報で確認できます。     </span>




    </x-slot>


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">

                    <x-flash-message status="session('status')"/>
                    <div class="-m-2">
                        <div class="p-2 mx-auto">

                            <div class="p-2 w-full mx-auto">
                                <div class="flex mx-auto">
                                    <div class="w-20 relative mr-2">
                                        <label for="cir_id" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">No</label>
                                        <div  id="cir_id" name="cir_id" value="{{$circuit->cir_id}}" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded">{{$circuit->cir_id}}
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <label for="area_name" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">エリア</label>
                                        <div  id="area_name" name="area_name" value="{{$circuit->area_name}}" class="pl-2 w-60 h-6 text-sm items-center bg-gray-100 border rounded">{{$circuit->area_name}}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex ">

                                <div class="relative ">
                                <label for="circuit_name" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">サーキット名</label>
                                <div  id="circuit_name" name="circuit_name" value="{{$circuit->cir_name}}" class="pl-2 w-60 h-6 text-sm items-center bg-gray-100 border rounded">{{$circuit->cir_name}}
                                </div>
                                </div>

                                <div class="relative ">
                                <label for="length" class="ml-2 leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">コース長</label>
                                <div  id="length" name="length" value="{{$circuit->length}}" class="ml-2 pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded">{{$circuit->length}}　M                                </div>
                                </div>

                                </div>

                                <div class="relative ">
                                <label for="url" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">HP</label>
                                <div  id="url" name="url" value="{{$circuit->url}}" class="pl-2 w-80 h-6 text-indigo-500 text-sm items-center bg-gray-100 border rounded"><a href={{$circuit->url}} > {{$circuit->url}}</a>
                                </div>
                                </div>


                                @if(!empty($circuit->cir_info))
                                <div class="relative">
                                    <label for="cir_info" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">情報</label>
                                    <div  id="cir_info" name="cir_info" value="{!! nl2br(e($circuit->cir_info)) !!}" class="text-sm w-full md:w-2/3 bg-gray-100 bg-opacity-50 border rounded focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{!! nl2br(e($circuit->cir_info)) !!}
                                    </div>
                                </div>
                                @endif
                                </div>

                        </div>


                        <div class="md:flex px-2 md:w-2/3 mx-auto">

                            <div class="w-full mb-1">
                                @if(!empty($circuit->photo1))
                                <img src="{{ asset('storage/circuit/'.$circuit->photo1) }}">
                                @endif
                                {{-- <img src="{{ asset('storage/users/'.$user->photo1) }}"> --}}
                            </div>
                            <div class="w-full mb-1">
                                @if(!empty($circuit->photo2))
                                <img src="{{ asset('storage/circuit/'.$circuit->photo2) }}">
                                @endif
                                {{-- <img src="{{ asset('storage/users/'.$user->photo2) }}"> --}}
                            </div>
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="py-0 border">
            <div class=" mx-auto sm:px-4 lg:px-4 border ">
                LapList
                {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
                <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">No</th>
                            <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">member</th>
                            <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Engine</th>
                            <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Tire</th>
                            <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">BestTime</th>

                            {{--  <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>  --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($stints as $stint)

                        <tr>
                            <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $stint->id }} </td>
                            <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"><a href="{{ route('member_detail',['user'=>$stint->user_id]) }}" > {{ $stint->user_name }}  </a></td>
                            <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $stint->engine_name }} </td>
                            <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $stint->tire_name }} </td>
                            <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('stint_show',['stint'=>$stint->id]) }}" > {{ $stint->best_time }} </a></td>


                            {{--  <td class="w-2/13 md:2/13 text-sm text-indigo-500 md:px-4 py-1 text-center"><a href="{{ route('my_reservation_show',['resv'=>$reservation->id]) }}" >詳細</a></td>  --}}
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                {{-- {{  $users->links()}} --}}
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
