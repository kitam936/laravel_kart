
<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            イベント編集
            {{-- <button type="button" onclick="location.href='{{ route('user.company.index') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">戻る</button> --}}
        </h2>
        <div class="ml-2 flex md:ml-20">
        <div class="ml-0 mt-2 md:mt-0 md:ml-60">
            <button type="button" class="w-40 h-8 bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('events.show',['event'=>$event->id]) }}'" >イベント詳細_管理者</button>
        </div>

        {{-- <div class="ml-00 mt-2 md:ml-4 md:mt-0">
            @foreach ($events as $event)
            <button type="button" class="w-40 h-8 bg-red-500 text-white ml-2 hover:bg-red-600 rounded" onclick="location.href='{{ route('events.destroy',['event'=>$event->id]) }}'" >削除</button>
            @endforeach
        </div> --}}

        <form id="delete_{{$event->id}}" method="POST" action="{{ route('events.destroy',['event'=>$event->id]) }}">
            @csrf
            @method('delete')
            <div class="ml-0 mt-2 md:ml-4 md:mt-0">
                <div class="w-40 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                <a href="#" data-id="{{ $event->id }}" onclick="deletePost(this)" >削除</a>
                </div>
            </div>
        </form>
        </div>

        <div CLASS="max-w-2xl mx-auto">

            <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- <x-flash-message status="session('status')"/> --}}


        <form method="POST" action="{{ route('events.update',['event'=>$event->id]) }}">
            @csrf
            @method('put')
            <div>
                <x-label for="event_name" value="イベント名" class="block mt-1 w-full" />
                <x-input id="event_name" class="block mt-1 w-full" type="text" name="event_name" value="{{ $event->event_name}}" required autofocus />
            </div>
            <div>
                <x-label for="information" value="イベント情報" class="block mt-1 w-full" />
                <x-textarea row="5" id="information" class="block mt-1 w-full" type="text" name="information" required>{{ $event->information}}</x-textarea>
            </div>
            <div class="flex justify-between">
            <div>
                <x-label for="event_date" value="開催日" class="block mt-1 w-full" />
                <x-input id="event_date" class="block mt-1 w-full" id="event_date" type="text" name="event_date" value="{{ $eventDate}}" required  />
            </div>

            <div>
                <x-label for="start_time" value="開始時間" class="block mt-1 w-full" />
                <x-input id="start_time" class="block mt-1 w-full" id="start_time" type="text" name="start_time" value="{{ $startTime}}" required  />
            </div>

            <div>
                <x-label for="end_time" value="終了時間" class="block mt-1 w-full" />
                <x-input id="end_time" class="block mt-1 w-full" id="end_time" type="text" name="end_time" value="{{ $endTime}}" required  />
            </div>
            </div>
            <div class="relative ml-0 ">
                @foreach ($events as $event2)
                <x-label for="area_id" value="エリア" class="block mt-1 w-full" />
                <select  id="area_id" name="area_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                <option value="{{ $event2->place_area_id}}" @if(\Request::get('area_id') == '0') selected @endif >{{ $event2->area_name}}</option>
                {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                @endforeach
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"  >{{ $area->area_name }}</option>
                @endforeach
                </select>
        </div>

            <div>
                <x-label for="place" value="開催場所" class="block mt-1 w-full" />
                <x-input id="place" class="block mt-1 w-full" type="text" name="place" value="{{ $event->place}}" required  />
            </div>

            <div class="flex justify-between">
            <div>
                <x-label for="main_fee" value="参加費" class="block mt-1 w-full" />
                <x-input id="main_fee" class="block mt-1 w-full text-right " type="number" name="main_fee" value="{{ ($event->main_fee)}}" required  />
            </div>

            <div>
                <x-label for="sub_fee" value="同伴参加費" class="block mt-1 w-full" />
                <x-input id="sub_fee" class="block mt-1 w-full text-right " type="number" name="sub_fee" value="{{ ($event->sub_fee)}}" required  />
            </div>

            <div>
                <x-label for="capacity" value="定員" class="block mt-1 w-full" />
                <x-input id="capacity" class="block mt-1 w-full  text-right" type="number" name="capacity" value="{{ ($event->capacity)}}" required  />
            </div>
            </div>

            <div class="flex justify-between">
            <div>
                <x-label for="is_visible" value="表示" class="block mt-1 w-full" />
                <input type="radio" name="is_visible" value="1" @if($event->is_visible === 1 ){ checked } @endif />公開
                <input type="radio" name="is_visible" value="0" @if($event->is_visible === 0 ){ checked } @endif/>非公開
            </div>
            <div class="p-2 w-1/2 mx-auto flex">
                <div class="p-2 w-full mt-2 flex justify-around">
                    <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新</button>
                </div>
            </div>
            </div>
        </form>
        </div>
            {{-- <div class=" p-1 text-gray-900 dark:text-gray-100 md:flex-auto md:mt-6">
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_m_form',['event'=>$event->id]) }}'" >月別売上推移</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_w_form',['event'=>$event->id]) }}'" >週別売上推移</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_u_form',['event'=>$event->id]) }}'" >Unit別売上</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_s_form',['event'=>$event->id]) }}'" >Season別売上</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_h_form',['event'=>$event->id]) }}'" >品番別売上</button>
            </div> --}}
            {{-- <div class=" p-1 text-gray-900 dark:text-gray-100 md:flex-auto ">
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_md_form',['event'=>$event->id]) }}'" >月別納品推移</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_wd_form',['event'=>$event->id]) }}'" >日別納品推移</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_ud_form',['event'=>$event->id]) }}'" >Unit別納品</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_sd_form',['event'=>$event->id]) }}'" >Season別納品</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_hd_form',['event'=>$event->id]) }}'" >品番別納品</button>
            </div> --}}
            {{-- <div class=" p-1 text-gray-900 dark:text-gray-100 md:flex-auto ">
                <button type="button" class="w-32 flex-auto p-0 text-sm text-gray-900 dark:text-gray-100 bg-gray-200 "  >******</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-gray-900 dark:text-gray-100 bg-gray-200 "  >******</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_uz_form',['event'=>$event->id]) }}'" >Unit別在庫</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_sz_form',['event'=>$event->id]) }}'" >Season別在庫</button>
                <button type="button" class="w-32 flex-auto p-0 text-sm text-white dark:text-white bg-indigo-400 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('user.event.s_hz_form',['event'=>$event->id]) }}'" >品番別在庫</button>
            </div> --}}


    </x-slot>

    <script>
        function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
        }
    </script>
</x-app-layout>
