<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stint新規作成
        </h2>
        <div class="flex">
        <div class="ml-2 md:ml-4">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white ml-60 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('my_stint') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">MyStint</button>
        </div>
        <div class="ml-2 md:ml-4">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white ml-60 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('stint_create') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">登録画面へ</button>
        </div>
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

            <form method="get" action="{{ route('stint_create') }}">
                @csrf

                <div class="relative ml-0 ">
                    <x-label for="cir_id" value="サーキット" />
                    <select  id="cir_id" name="cir_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                    <option value="" @if(\Request::get('cir_id') == '0') selected @endif >サーキット選択</option>
                    {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                    @foreach ($cirs as $cir)
                        <option value="{{ $cir->id }}"  >{{ $cir->cir_name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="relative ml-0 ">
                    <x-label for="kart_id" value="kart" />
                    <select  id="kart_id" name="kart_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                    <option value="" @if(\Request::get('kart_id') == '0') selected @endif >kart選択</option>
                    {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                    @foreach ($karts as $kart)
                        <option value="{{ $kart->id }}"  >{{ $kart->id }}_{{ \Carbon\Carbon::parse($kart->purchase_date)->format('Y-m-d') }}_{{ $kart->maker_name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="relative ml-0 ">
                    <x-label for="engine_id" value="エンジン" />
                    <select  id="engine_id" name="engine_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                    <option value="" @if(\Request::get('engine_id') == '0') selected @endif >エンジン選択</option>
                    {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                    @foreach ($engines as $engine)
                        <option value="{{ $engine->id }}"  >{{ $engine->id }}_{{ \Carbon\Carbon::parse($engine->purchase_date)->format('Y-m-d') }}_{{ $engine->engine_name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="relative ml-0 ">
                    <x-label for="tire_id" value="タイヤ" />
                    <select  id="tire_id" name="tire_id"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                    <option value="" @if(\Request::get('tire_id') == '0') selected @endif >タイヤ選択</option>
                    {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                    @foreach ($tires as $tire)
                        <option value="{{ $tire->id }}"  >{{ $tire->tire_name }}</option>
                    @endforeach
                    </select>
                </div>


            </form>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
