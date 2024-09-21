<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Engine メンテナンス詳細
        </h2>

        <div class="flex">
        <form>
            <div class="md:flex md:ml-20">
            <x-input type="hidden" id="eg_maint_id" name="eg_maint_id" value="{{ $maint->maint_id }}"/>
            <x-input type="hidden" id="myengine_id" name="myengine_id" value="{{ $maint->myengine_id }}"/>
            <div class="ml-0 md:ml-4">
                {{-- <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >Chassis_List</button> --}}
            </div>

            </div>
        </form>
        <div class="flex ">
            <div class=" w-1/2 mt-0 flex md:ml-60">
                <div class="ml-4 md:ml-4">
                    <button type="button" class="w-32 h-8 bg-indigo-500 text-sm text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_show',['engine'=>$maint->myengine_id]) }}'" >MyEngine詳細</button>
                    {{-- <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button> --}}
                </div>
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('eg_maint_edit',['maint'=>$maint->maint_id])}}'" >編集</button>
                </div>
                <form id="delete_{{$maint->maint_id}}" method="POST" action="{{ route('eg_maint_destroy',['maint'=>$maint->maint_id]) }}">
                    <x-input type="hidden" id="myengine_id2" name="myengine_id2" value="{{ $maint->myengine_id }}"/>
                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-32 h-8 bg-red-500  text-sm text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $maint->maint_id }}" onclick="deletePost(this)" >削除</a>
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
            <form>
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
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $maint->maint_id }}">{{ $maint->maint_id  }}
                        </div>
                    </div>

                </div>
                <div class="flex ml-2 mr-4 mt01">
                    <div class="relative w-32">
                        <x-label for="maint_date" value="実施日" class="mt-1"/>
                        <div name="maint_date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $maint->maint_date}}" >
                            {{ \Carbon\Carbon::parse($maint->maint_date)->format('Y-m-d') }}
                        </div>
                    </div>

                </div>
            </div>


                <div class="ml-2 mr-4 ">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="eg_maint_name" value="カテゴリー" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maint_name" name="maint_name"  value="{{ $maint->eg_maint_name }}">{{ $maint->eg_maint_name  }}
                        </div>
                    </div>
                    <div class="relative w-full mr-2 ">
                        <x-label for="maint_info" value="内容" class="mt-1"/>
                        <div class="pl-2 w-full text-sm items-center bg-gray-100 border rounded" id="maint_info" name="maint_info"  value="{{ $maint->maint_info }}">{!! nl2br(e($maint->maint_info)) !!}
                        </div>
                    </div>

                </div>
                <div class="relative w-32 ml-2 ">
                    <x-label for="eg_maint_fee" value="費用" class="mt-1"/>
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maint_fee" name="maint_fee"  value="{{ $maint->maint_fee }}">{{ $maint->maint_fee  }}
                    </div>
                </div>


            @if(!empty($maint->eg_maint_info))
            <div class="ml-2 mr-4">
                <x-label for="maint_info" value="詳細" class="mt-1"/>
                <div row="5" id="maint_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="maint_info" >{!! nl2br(e($maint->maint_info)) !!}</div>
            </div>
            @endif
            </div>
            </form>
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

