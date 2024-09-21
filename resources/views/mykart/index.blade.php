<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            MyKart
        </h2>
        {{-- <div class="flex text-gray-900 dark:text-gray-100  ">
            <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-0 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('chassis_index') }}'" >シャーシ</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('myengine_index') }}'" >エンジン</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-indigo-400  hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mytire_index') }}'" >タイヤ</button>
            </div>
        </div> --}}

        <div class="flex text-gray-900 dark:text-gray-100  ">
            <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-0 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-green-500  hover:bg-green-600 rounded" onclick="location.href='{{ route('chassis_create') }}'" >Chassis登録</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-green-500  hover:bg-green-600 rounded" onclick="location.href='{{ route('myengine_create') }}'" >Engine登録</button>
            <button type="button" class="w-32 h-8 ml-2 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-green-500  hover:bg-green-600 rounded" onclick="location.href='{{ route('mytire_create') }}'" >Tire登録</button>
            </div>
        </div>

        @if($login_user->role_id ==1)
        <div class="flex px-2 py-2 md:w-2/3">
            <button type="button" class="w-32 h-8 ml-0 mb-2 border-gray-900 p-0 text-sm text-white dark:text-white bg-pink-400  hover:bg-pink-600 rounded" onclick="location.href='{{ route('category_index') }}'" >カテゴリーData</button>

        </div>
        @endif

        ※”No”　の青い部分をクリックすると自身の機材詳細確認ができます。<br>
        　"Maker","Name"  の青い部分をクリックすると機材の詳細確認ができます。<br>

    </x-slot>

    <x-flash-message status="session('status')"/>


    <div class="py-0 border">
        Tire
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/12 md:1/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Tire No</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Maker</th>
                        <th class="w-2/12 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Laps</th>
                        {{-- <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">距離</th> --}}
                    </tr>
                </thead>

                <tbody>
                    {{-- @foreach ($tires as $tire)

                    <tr>
                        <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('mytire_show',['tire'=>$tire->my_tire_id]) }}" >{{ $tire->my_tire_id }} </a></td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($tire->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('tire_show',['tire'=>$tire->tire_id]) }}" > {{$tire->tire_name}}</a> </td>

                    @endforeach --}}

                    @foreach ($tires2 as $tire)

                    <tr>
                        {{-- @if(!Empty($tire->laps)) --}}
                        <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('mytire_show',['tire'=>$tire->id]) }}" >{{ $tire->id }} </a></td>
                        {{-- @else --}}
                        {{-- <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-center"> {{ $tire->id }} </td> --}}
                        {{-- @endif --}}
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($tire->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center">{{$tire->tire_maker_name}}</td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('tire_show',['tire'=>$tire->tire_id]) }}" > {{$tire->tire_name}}</a> </td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ $tire->laps }} </td>
                        {{-- <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ $tire->distance }} </td> --}}
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>


    <div class="py-0 border">
        Chassis
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/12 md:1/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Chassis No</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Maker</th>
                        <th class="w-2/12 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Model_Year</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Info</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($karts as $kart)

                    <tr>
                        <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('chassis_show',['chassis'=>$kart->kart_id]) }}" >{{ $kart->kart_id }} </a></td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($kart->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('maker_show',['maker'=>$kart->maker_id]) }}" > {{$kart->maker_name}}</a> </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1  text-center"> {{ $kart->model_year }} </td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1  text-center"> {{ $kart->my_kart_info }} </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>

    <div class="py-0 border">
        Engine
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/12 md:1/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Engine No</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Maker</th>
                        <th class="w-2/12 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
                        <th class="w-3/12 md:3/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Info</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($engines as $engine)

                    <tr>
                        <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('myengine_show',['engine'=>$engine->my_engine_id]) }}" >{{ $engine->my_engine_id }} </a></td>
                        <td class="w-3/12 md:3/12 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($engine->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-center"> {{$engine->engine_maker_name}}</td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('engine_show',['engine'=>$engine->engine_id]) }}" > {{$engine->engine_name}}</a> </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1  text-center"> {{ $engine->my_engine_info }} </td>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>








</x-app-layout>
