<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            My Chassis詳細
        </h2>

        <div class="flex">
        <form>
            <div class="md:flex md:ml-20">
            <x-input type="hidden" id="mykart_id" name="mykart_id" value="{{ $kart->kart_id }}"/>
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
            </div>

            {{-- <div class="ml-0 md:ml-4">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_index') }}'" >Chassis_List</button>
            </div> --}}
            <div class="mt-2 md:mt-0 md:ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-pink-500 text-white ml-2 hover:bg-pink-600 rounded" onclick="location.href='{{ route('ch_maint_create',['ch'=>$kart->kart_id])}}'" >メンテナンス登録</button>
            </div>

            </div>
        </form>
        <div class="flex ">
            <div class=" w-1/2 mt-0 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('chassis_edit',['chassis'=>$kart->kart_id])}}'" >編集</button>
                </div>
            <form id="delete_{{$kart->kart_id}}" method="POST" action="{{ route('chassis_destroy',['chassis'=>$kart->kart_id]) }}">
                <input type="hidden" id="photo1" name="photo1" value="{{ $kart->photo1 }}" />
                <input type="hidden" id="photo2" name="photo2" value="{{ $kart->photo2 }}" />
                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-32 h-8 bg-red-500  text-sm text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $kart->kart_id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            </div>
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

            <div class="flex">
                <div>
                    <div class="relative w-16 ml-2 ">
                        <x-label for="id" value="ID" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $kart->kart_id }}">{{ $kart->kart_id  }}
                        </div>
                    </div>

                </div>
                <div class="flex ml-2 mr-4 mt01">
                    <div class="relative w-32">
                        <x-label for="purchase_date" value="購入日" class="mt-1"/>
                        <div name="purchase_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $kart->purchase_date}}" >
                            {{ \Carbon\Carbon::parse($kart->purchase_date)->format('Y-m-d') }}
                        </div>
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


            </form>
            </div>

        </div>

        <div class="max-w-2xl mt-2 mx-auto sm:px-6 lg:px-8 rounded">
            <form method="get" action="{{ route('chassis_show',['chassis'=>$kart->kart_id])}}" class="mt-1">

                <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※メンテナンスカテゴリーを指定してメンテナンス以降の走行距離・時間を検索できます　　　</span>
                <div class="md:flex">
                <select class="w-52 h-8 rounded text-sm pt-1 border mr-2 mb-2" id="category_id" name="category_id" type="text" >
                    <option value="" @if(\Request::get('category_id') == '0') selected @endif >メンテナンスカテゴリー検索</option>
                    @foreach ($maint_categories as $maint_category)
                        <option value="{{ $maint_category->id }}" @if(\Request::get('category_id') == $maint_category->id ) selected @endif >{{ $maint_category->ch_maint_name  }}</option>
                    @endforeach
                </select>

                <div class="mb-2 flex">

                <div>
                    <div class="ml-2 ">
                        <button type="button" class="w-20 h-8 bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_show',['chassis'=>$kart->kart_id]) }}'" >全表示</button>
                    </div>
                </div>

                </div>
            </div>
            </form>
            @if(!empty($stints_total->laps))
            <div class='text-sm border bg-gray-100 h-6'>
                　　　Lap数　：　{{ ($stints_total->laps) }}　Lap　　 /　　 走行距離　：　{{ ($stints_total->distance)/1000  }}Km　
            </div>
           @endif
        </div>

        <div class="bg-white mt-4">
            <span class="text-ml ml-24"> メンテナンス履歴</span><span class="text-sm">　　※IDクリックでメンテナンス詳細表示</span>
        </div>
        @if(!empty($maints))
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ID</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">実施日</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カテゴリー</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">内容</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($maints as $maint)

                    <tr>
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('ch_maint_show',['maint'=>$maint->maint_id]) }}" >{{ $maint->maint_id }} </a></td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($maint->maint_date)->format("y/m/d") }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $maint->ch_maint_name }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $maint->maint_info }} </td>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
        @endif


    <script>

        function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
        }

        const maint = document.getElementById('category_id')
        maint.addEventListener('change', function(){
        this.form.submit()
        })
    </script>
</x-app-layout>

