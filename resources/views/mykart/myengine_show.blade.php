<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            MyEngine詳細
        </h2>
        <div class="flex ">
        <form>
            <div class="ml-2 md:flex md:ml-20">
            <x-input type="hidden" id="my_engine_id" name="my_engine_id" value="{{ $myengine->my_engine_id }}"/>
            <x-input type="hidden" id="engine_id" name="engine_id" value="{{ $myengine->engine_id }}"/>
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
            </div>
            {{-- <div class="ml-0 md:ml-4">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >MyEngine List</button>
            </div> --}}
            <div class="mt-2 md:mt-0 md:ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-pink-500 text-white ml-2 hover:bg-pink-600 rounded" onclick="location.href='{{ route('eg_maint_create',['eg'=>$myengine->my_engine_id])}}'" >メンテナンス登録</button>
            </div>

            </div>
        </form>

        <div class="p-0 w-1/2 mt-0 flex md:ml-48">

            <div class="md:ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('myengine_edit',['engine'=>$myengine->my_engine_id])}}'" >編集</button>
            </div>
        <form id="delete_{{$myengine->my_engine_id}}" method="POST" action="{{ route('myengine_destroy',['engine'=>$myengine->my_engine_id]) }}">

            @csrf
            <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                <div class="w-32 h-8 bg-red-500 text-sm text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                <a href="#" data-id="{{ $myengine->my_engine_id }}" onclick="deletePost(this)" >削除</a>
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
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $myengine->my_engine_id }}">{{ $myengine->my_engine_id  }}
                        </div>
                    </div>
                    <div class="relative w-32 ml-2">
                        <x-label for="purchase_date" value="購入日" class="mt-1"/>
                        <div name="purchase_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $myengine->purchase_date}}" >
                            {{ \Carbon\Carbon::parse($myengine->purchase_date)->format('Y-m-d') }}
                        </div>
                    </div>
                    <div class="ml-2 mr-4 flex">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="engine_name" value="Engine" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="engine_name" name="emgine_name"  value="{{ $myengine->engine_name }}">{{ $myengine->engine_name  }}
                        </div>
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

            </form>
            </div>

            </div>

            <div class=" max-w-2xl mt-2 mx-auto sm:px-6 lg:px-8 rounded">

                <form method="get" action="{{ route('myengine_show',['engine'=>$myengine->my_engine_id])}}" class="mt-1">

                    <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※メンテナンスカテゴリーを指定してメンテナンス以降の走行距離・時間を検索できます　　　</span>
                    <div class="md:flex">
                    <select class="w-52 h-8 rounded text-sm pt-1 border mr-2 mb-2" id="category_id" name="category_id" type="text" >
                        <option value="" @if(\Request::get('category_id') == '0') selected @endif >メンテナンスカテゴリー検索</option>
                        @foreach ($maint_categories as $maint_category)
                            <option value="{{ $maint_category->id }}" @if(\Request::get('category_id') == $maint_category->id ) selected @endif >{{ $maint_category->eg_maint_name  }}</option>
                        @endforeach
                    </select>

                    <div class="mb-2 flex">

                    <div>
                        <div class="ml-2 ">
                            <button type="button" class="w-20 h-8 bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_show',['engine'=>$myengine->my_engine_id]) }}'" >全表示</button>
                        </div>
                    </div>

                    </div>
                </div>
                </form>
                @if(!empty($stints_total->laps))
                <div class='border text-sm bg-gray-100 h-6'>
                    　　　Lap数：{{ ($stints_total->laps) }}Lap　/　 走行距離：{{ ($stints_total->distance)/1000  }}Km　/　走行時間：{{ round($stints_total->laps * $stints_total->time/60)  }} 分
                </div>
                @endif
            </div>

            <div class="bg-white mt-4">
                <span class="text-ml ml-24"> メンテナンス履歴</span><span class="text-sm">　　※IDクリックで詳細表示</span>
            </div>

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
                            <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('eg_maint_show',['maint'=>$maint->maint_id]) }}" >{{ $maint->maint_id }} </a></td>
                            <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($maint->maint_date)->format("y/m/d") }} </td>
                            <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $maint->eg_maint_name }} </td>
                            <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $maint->maint_info }} </td>
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

        const maint = document.getElementById('category_id')
        maint.addEventListener('change', function(){
        this.form.submit()
        })
    </script>
</x-app-layout>

