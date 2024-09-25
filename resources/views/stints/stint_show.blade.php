<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Stint詳細
        </h2>
    <form>
        <div class="flex md:ml-20">
        <div class="ml-0 md:ml-4">
            <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('stint_list') }}'" >StintList</button>
        </div>
        <div class="ml-0 md:ml-4">
            <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('circuit_detail',['circuit'=>$stint->cir_id]) }}'" >Circuit詳細</button>
        </div>
        </div>
        @if(!empty($stint->filename))
        <div class="ml-0 mt-2 md:ml-4 md:mt-0">
            <x-input type="hidden" id="stint_id" name="stint_id" value="{{ $stint_id }}"/>
            <button type="button" class="w-32 h-8 text-sm bg-blue-400 text-white ml-2 hover:bg-blue-500 rounded" onclick="location.href='{{ route('stint_data_download',['stint'=>$stint_id]) }}'" >ロガーData DL</button>
        </div>
        @endif


    </form>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="mb-2 max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-flash-message status="session('status')"/>

            {{-- {{ $resv_id }} --}}
                <div>
                    {{-- <input type="hidden" id="user_id" name="user_id" value="{{ $stint->user_id }}" /> --}}

                </div>
                <div class="flex ml-2 mr-4 mt-1">
                    <div class="relative w-32">
                        {{-- <label for="category" class="leading-7 text-sm text-gray-600">車種</label> --}}
                        <x-label for="date" value="走行日" class="mt-1"/>
                        <div name="date" class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $stint->start_date}}" >
                            {{ \Carbon\Carbon::parse($stint->start_date)->format('Y-m-d') }}
                        </div>
                    </div>
                    <div class="relative w-32">
                        <x-label for="start_date" value="開始時間" class="mt-1 ml-2"/>
                        <div name="start_time" class="ml-2 pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $stint->start_date}}" >
                            {{ \Carbon\Carbon::parse($stint->start_date)->format('H:i') }}
                        </div>
                    </div>
                </div>

                    <div class="relative ml-2 mr-2">
                        <x-label for="user_name" value="Member名" class="mt-1"/>
                        <div name="user_name" class="pl-2 w-48 h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $stint->name}}" >
                            {{ $stint->name }}
                        </div>
                    </div>

                <div class="relative w-1/2 md:w-1/3 ml-2 mr-2">
                    <x-label for="circuit" value="サーキット" class="mt-1"/>
                    <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="circuit" name="circuit"  value="{{ $stint->cir_name }}">{{ $stint->cir_name  }}
                    </div>
                </div>
                <div class="ml-2 mr-4 flex">
                    <div class="relative w-32 mr-2 ">
                        <x-label for="dry_wet" value="路面" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="dry_wet" name="dry_wet"  value="{{ $stint->dry_wet }}">{{ $stint->dry_wet  }}
                        </div>
                    </div>
                    <div>
                        <x-label for="road_temp" value="路面温度" class="mt-1"/>
                        <div id="road_temp" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="road_temp" value="{{ $stint->road_temp}}" >{{ $stint->roadtemp_range}}</div>
                    </div>
                    <div>
                        <x-label for="tire_temp" value="タイヤ温度" class="mt-1"/>
                        <div id="tire_temp" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="tire_temp" value="{{ $stint->tire_temp}}" >{{ $stint->tiretemp_range}}</div>
                    </div>

                </div>
                <div class="ml-2 mr-4 flex">
                    <div >
                        <x-label for="atm_pressure" value="気圧" class="mt-1"/>
                        <div class="pl-2 w-32 h-6 mr-2 text-sm bg-gray-100 border rounded" id="atm_pressure" name="atm_pressure"  value="{{ $stint->atm_pressure }}">{{ $stint->atm_pressure  }}
                        </div>
                    </div>
                    <div>
                        <x-label for="temp" value="気温" class="mt-1"/>
                        <div id="temp" class="pl-2 w-32 h-6 mr-2 text-sm bg-gray-100 border rounded" name="temp" value="{{ $stint->temp}}" >{{ $stint->temp_range}}</div>
                    </div>
                    <div>
                        <x-label for="humidity" value="湿度" class="mt-1"/>
                        <div id="humidity" class="pl-2 w-32 h-6 text-sm bg-gray-100 border rounded" name="humidity" value="{{ $stint->humidity}}" >{{ $stint->humi_range}}</div>
                    </div>

                </div>
                {{-- </div> --}}

                <div class="flex ml-2 md:ml-2">
                    <div >
                        {{-- <label for="category" class="leading-7 text-sm text-gray-600">車種</label> --}}
                        <x-label for="kart" value="カート" class="mt-1"/>
                        <div name="kart" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" value="{{ $stint->maker_id}}" >
                            {{ $stint->maker_name }} _ {{ $stint->model_year }}
                        </div>
                    </div>
                    <div >
                        <x-label for="engine" value="エンジン" class="ml-2 mt-1"/>
                        <div class="ml-2 pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" id="engine" name="engine"  value="{{ $stint->engine_id }}">{{ $stint->engine_name  }}
                        </div>
                    </div>
                    <div >
                        <x-label for="tire" value="タイヤ" class="mt-1"/>
                        <div class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" id="tire" class="bg-gray-100 block mt-1 w-40" name="tire" value="{{ $stint->tire_id}}" required >{{ $stint->tire_name}}</div>
                    </div>
                </div>


            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="laps" value="Lap数" class="mt-1"/>
                    <div id="laps" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="laps" value="{{ $stint->laps}}" >{{ $stint->laps}}</div>
                </div>
                <div class="md:ml-0">
                    <x-label for="best_time" value="ベストタイム" class="mt-1"/>
                    <div id="best_time" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="best_time" value="{{ $stint->best_time}}" required autofocus >{{ $stint->best_time}}</div>
                </div>
            </div>
            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="max_rev" value="最高回転数" class="mt-1"/>
                    <div id="max_rev" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="max_rev" value="{{ $stint->max_rev}}" >{{ $stint->max_rev}}</div>
                </div>
                <div>
                    <x-label for="min_rev" value="最低回転数" class="mt-1"/>
                    <div id="min_rev" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="min_rev" value="{{ $stint->min_rev}}" >{{ $stint->min_rev}}</div>
                </div>
            </div>
            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="fr_tread" value="フロントトレッド" class="mt-1"/>
                    <div id="fr_tread" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="fr_tread" value="{{ $stint->fr_tread}}" >{{ $stint->fr_tread}}</div>
                </div>
                <div>
                    <x-label for="re_tread" value="リアトレッド" class="mt-1"/>
                    <div id="re_tread" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="re_tread" value="{{ $stint->re_tread}}" >{{ $stint->re_tread}}</div>
                </div>
            </div>
            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="fr_sprocket" value="フロントスプロケット" class="mt-1"/>
                    <div id="fr_sprocket" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="fr_sprocket" value="{{ $stint->fr_sprocket}}" >{{ $stint->fr_sprocket}}</div>
                </div>
                <div>
                    <x-label for="re_sprocket" value="リアスプロケット" class="mt-1"/>
                    <div id="re_sprocket" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="re_sprocket" value="{{ $stint->re_sprocket}}" >{{ $stint->re_sprocket}}</div>
                </div>
                <div>
                    <x-label for="stabilizer" value="スタビ" class="mt-1"/>
                    <div id="stabilizer" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="stabilizer" value="{{ $stint->stabilizer}}" >{{ $stint->stabilizer}}</div>
                </div>
            </div>
            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="tire_pres" value="タイヤ圧" class="mt-1"/>
                    <div id="tire_pres" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="tire_pres" value="{{ $stint->tire_pres}}" >{{ $stint->tire_pres}}</div>
                </div>
                <div>
                    <x-label for="tire_age" value="タイヤ累計Lap数" class="mt-1"/>
                    <div id="tire_age" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="tire_age" value="{{ $stint->tire_age}}" >{{ $stint->tire_age}}</div>
                </div>

            </div>
            <div class="ml-2 mr-4 flex">
                <div>
                    <x-label for="cab_hi" value="キャブHigh" class="mt-1"/>
                    <div id="cab_hi" class="pl-2 w-32 h-6 mr-2 text-sm items-center bg-gray-100 border rounded" name="cab_hi" value="{{ $stint->cab_hi}}" >{{ $stint->cab_hi}}</div>
                </div>
                <div>
                    <x-label for="cab_lo" value="キャブLow" class="mt-1"/>
                    <div id="cab_lo" class="pl-2 w-32 h-6 text-sm items-center bg-gray-100 border rounded" name="cab_lo" value="{{ $stint->cab_lo}}" >{{ $stint->cab_lo}}</div>
                </div>
            </div>
            @if(!empty($stint->stint_info))
            <div class="ml-2 mr-4">
                <x-label for="stint_info" value="コメント" class="mt-1"/>
                <div row="5" id="stint_info" class="pl-2 w-full text-sm items-center bg-gray-100 border rounded"  name="stint_info" required>{!! nl2br(e($stint->stint_info)) !!}</div>
            </div>
            @endif

            <div class="flex ml-0 px-2 mx-auto">
                <div class="w-full mb-1">
                    @if(!empty($stint->photo1))
                    <span class=" text-sm ">サーキット写真</span>
                    <img src="{{ asset('storage/stint/'.$stint->photo1) }}">
                    @endif
                    {{-- <img src="{{ asset('storage/users/'.$user->photo1) }}"> --}}
                </div>
                <div class="w-full mb-1 ml-1">
                    @if(!empty($stint->photo2))
                    <span class=" text-sm ">Fタイヤ写真</span>
                    <img src="{{ asset('storage/stint/'.$stint->photo2) }}">
                    @endif
                    {{-- <img src="{{ asset('storage/users/'.$user->photo2) }}"> --}}
                </div>
                <div class="w-full mb-1 ml-1">
                    @if(!empty($stint->photo3))
                    <span class=" text-sm ">Rタイヤ写真</span>
                    <img src="{{ asset('storage/stint/'.$stint->photo3) }}">
                    @endif
                    {{-- <img src="{{ asset('storage/users/'.$user->photo2) }}"> --}}
                </div>
            </div>
            </div>


            {{-- <div class="flex justify-between">
            <div class="p-2 w-1/2 mt-2 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('stint_edit',['stint'=>$stint_id])}}'" >変更</button>
                </div>
            <form id="delete_{{$stint_id}}" method="POST" action="{{ route('stint_destroy',['stint'=>$stint_id]) }}">
                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-32 h-8 bg-red-500 text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $stint_id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            </div>
            </div> --}}


            </form>
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

