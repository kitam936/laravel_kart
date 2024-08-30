<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dataアップロード・更新
        </h2>
        <form class="md:ml-60 pt-2">
        <x-input type="hidden" id="stint_id2" name="stint_id2"  value="{{ $stint->stint_id }}"/>
        {{-- <button type="button" onclick="location.href='{{ route('doc_index',['event'=>$event->event_id])}}'" class="h-8 text-white mx-auto bg-indigo-500 border-0 py-0 px-8 focus:outline-none hover:bg-indigo-600 rounded text-ml">資料リスト</button> --}}
        <button type="button" onclick="location.href='{{ route('my_stint_show',['stint'=>$stint->stint_id])}}'" class="h-8 text-white mx-auto bg-indigo-500 border-0 py-0 px-8 focus:outline-none hover:bg-indigo-600 rounded text-ml">MyStint詳細</button>
        </form>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')"/>
                    <form method="post" action="{{ route('stint_data_upload',['stint'=>$stint->stint_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="stint_id" name="stint_id" value="{{ $stint->stint_id }}"/>
                        <div class="-m-2">
                            <div class="p-2 mx-auto">
                                <div class="mb-2 md:ml-2 ">
                                    <x-label for="stint_id" value="Stint" />
                                    <div class="pl-2 w-72 h-6 text-sm items-center bg-gray-100 border rounded" name="stint_id" value="{{ $stint->stint_id }}">{{ $stint->stint_id }}--{{ $stint->username }}--{{ \Carbon\Carbon::parse($stint->start_date)->format('Y-m-d H:i') }}</div>
                                    {{-- <div class="pl-2 w-72 h-6 text-sm items-center bg-gray-100 border rounded" name="evt_id" value="{{ $event->id }}">{{ $event->id }}</div> --}}

                                </div>



                                <div class="p-2 md:w-1/2 mx-auto">
                                    <div class="relative">
                                        <x-label for="data" value="File" />
                                        <input type="file" id="data" name="files[][data]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" ><span class="ml-8 text-indigo-700">現保存Data：{{ $stint->filename }} </span>
                                    </div>
                                </div>

                            </div>

                            <div class="p-2 w-full flex justify-around mt-4">
                                {{-- <button type="button" onclick="location.href='{{ route('doc_index',['event'=>$event->id])}}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button> --}}
                                <button type="submit" class="w-32 h-8 text-white bg-green-500 border-0 py-0 px-8 focus:outline-none hover:bg-green-600 rounded text-ml">更新</button>

                            </div>

                    </form>
                    <form id="delete_{{$stint->stint_id}}" method="POST" action="{{ route('stint_data_destroy',['stint'=>$stint->stint_id]) }}">
                        @csrf
                        {{-- @method('delete') --}}
                        <x-input type="hidden" id="stint_id" name="stint_id"  value="{{ $stint->stint_id }}"/>
                        <div class="pt-1 w-32 h-8 text-center mx-auto text-white bg-red-500 border-0 py-0 px-8 focus:outline-none hover:bg-red-600 rounded text-ml">
                        <a href="#" data-id="{{ $stint->stint_id }}" onclick="deletePost(this)" >削除</a>
                        </div>
                    </form>
                </div>
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

