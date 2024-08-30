<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント新規作成
        </h2>

        <div class="ml-2 md:ml-4">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white ml-60 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('events.index') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">イベント管理</button>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- <x-flash-message status="session('status')"/> --}}

            <form method="POST" action="{{ route('events.store') }}">
                @csrf

                <div>
                    <x-input id="planner" class="block mt-1 w-full" type="hidden" name="planner" value="{{ $planner->id }}" required autofocus />
                </div>

                <div>
                    <x-label for="event_name" value="イベント名" />
                    <x-input id="event_name" class="block mt-1 w-full" type="text" name="event_name" :value="old('event_name')" required autofocus />
                </div>
                <div>
                    <x-label for="information" value="イベント情報" />
                    <x-textarea row="5" id="information" class="block mt-1 w-full" type="text" name="information" required>{{ old('information')  }}</x-textarea>
                </div>
                <div class="flex justify-between">
                <div>
                    <x-label for="event_date" value="開催日" />
                    <x-input id="event_date" class="block mt-1 w-full" id="event_date" type="text" name="event_date" :value="old('event_date')" required  />
                </div>

                <div>
                    <x-label for="start_time" value="開始時間" />
                    <x-input id="start_time" class="block mt-1 w-full" id="start_time" type="text" name="start_time" :value="old('start_time')" required  />
                </div>

                <div>
                    <x-label for="end_time" value="終了時間" />
                    <x-input id="end_time" class="block mt-1 w-full" id="end_time" type="text" name="end_time" :value="old('end_time')" required  />
                </div>
                </div>
                <div class="relative ml-0 ">
                    <x-label for="area_id" value="エリア" />
                    <select  id="area_id" name="area_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                    <option value="" @if(\Request::get('area_id') == '0') selected @endif >エリア選択</option>
                    {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}"  >{{ $area->area_name }}</option>
                    @endforeach
                    </select>
            </div>

                <div>
                    <x-label for="place" value="開催場所" />
                    <x-input id="place" class="block mt-1 w-full" type="text" name="place" :value="old('place')" required  />
                </div>

                <div class="flex justify-between">
                <div>
                    <x-label for="main_fee" value="参加費" />
                    <x-input id="main_fee" class="block mt-1 w-full text-right" type="number" name="main_fee" :value="(old('main_fee'))" required  />
                </div>

                <div>
                    <x-label for="sub_fee" value="同伴参加費" />
                    <x-input id="sub_fee" class="block mt-1 w-full text-right " type="number" name="sub_fee" :value="(old('sub_fee'))" required  />
                </div>

                <div>
                    <x-label for="capacity" value="定員" />
                    <x-input id="capacity" class="block mt-1 w-full  text-right" type="number" name="capacity" :value="(old('capacity'))" required  />
                </div>
                </div>

                <div class="flex justify-between">
                <div>
                    <x-label for="is_visible" value="表示" />
                    <input id="is_visible" type="radio" name="is_visible" value="1" />公開
                    <input id="is_visible" type="radio" name="is_visible" value="0" checked  />非公開
                </div>
                <div class="p-2 w-1/2 mx-auto flex">
                    <div class="p-2 w-full mt-2 flex justify-around">
                        <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録</button>
                    </div>
                </div>
                </div>
            </form>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
