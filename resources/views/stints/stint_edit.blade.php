<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            MyStint編集
        </h2>

        <div class="flex mt-4 ml-8">
            <div>
                Stint.No_{{ $stint->stint_id }}
            </div>
        <div class="ml-12 md:ml-12">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white md:ml-3232 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('my_stint_show',['stint'=>$stint->stint_id]) }}'" >MyStint詳細</button>
        </div>
        </div>

    </x-slot>

    <div class="py-4">
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

            <form method="POST" action="{{ route('stint_update',['stint'=>$stint->stint_id]) }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                    <input type="hidden" id="stint_id" name="stint_id" value="{{ $stint->stint_id }}" />
                    <input type="hidden" id="photo1" name="photo1" value="{{ $stint->photo1 }}" />
                    <input type="hidden" id="photo2" name="photo2" value="{{ $stint->photo2 }}" />
                    <input type="hidden" id="photo3" name="photo3" value="{{ $stint->photo3 }}" />
                </div>


                <div class="flex ml-2 mt-1">
                    <div class="flex justify-between">
                        <div class="mr-2">
                            <x-label for="start_date" value="走行日" />
                            <x-input id="start_date" class="bg-gray-100 block mt-1 w-40" id="start_date" type="text" name="start_date" value="{{ \Carbon\Carbon::parse($stint->start_date)->format('Y-m-d') }}" required  />
                        </div>
                        <div>
                            <x-label for="start_time" value="開始時間" />
                            <x-input id="start_time" class="bg-gray-100 block mt-1 w-40" id="start_time" type="text" name="start_time" value="{{ \Carbon\Carbon::parse($stint->start_date)->format('H:i') }}" required  />
                        </div>
                    </div>
                </div>
                <div class="flex relative w-40">
                    <div class="relative ml-2 mr-2">
                    <x-label for="cir_id" value="サーキット" />
                    <select  id="cir_id" name="cir_id"  class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="{{ $stint->cir_id }}" @if(\Request::get('cir_id') == '0') selected @endif >{{ $stint->cir_name }}</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($cirs as $cir)
                            <option value="{{ $cir->id }}"  >{{ $cir->cir_name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="relative ml-2">
                        <x-label for="kart_id" value="カート" />
                        <select  id="kart_id" name="kart_id"  class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="{{ $stint->my_kart_id }}" @if(\Request::get('kart_id') == '0') selected @endif >{{ $stint->maker_name }}_{{ $stint->model_year }}</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($karts as $kart)
                            <option value="{{ $kart->id }}"  >{{ $kart->id }}_{{ $kart->maker_name }}_{{ $kart->model_year }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex mt-1">

                    <div class="relative ml-2 mr-2">
                        <x-label for="engine_id" value="エンジン" />
                        <select  id="engine_id" name="engine_id"  class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="{{ $stint->my_engine_id }}" @if(\Request::get('engine_id') == '0') selected @endif >{{ $stint->my_engine_id }}_{{ $stint->engine_name }}_{{ \Carbon\Carbon::parse($stint->my_engine_date)->format('y-m') }}</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($engines as $engine)
                            <option value="{{ $engine->id }}"  >{{ $engine->id }}_{{ $engine->engine_name }}_{{ \Carbon\Carbon::parse($engine->purchase_date)->format('y-m') }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="relative ml-2 ">
                        <x-label for="tire_id" value="タイヤ" />
                        <select  id="tire_id" name="tire_id"  class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="{{ $stint->my_tire_id }}" @if(\Request::get('tire_id') == '0') selected @endif >{{ $stint->my_tire_id }}_{{ $stint->tire_name }}_{{ \Carbon\Carbon::parse($stint->my_tire_date)->format('y-m') }}</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($tires as $tire)
                            <option value="{{ $tire->id }}"  >{{ $tire->id }}_{{ $tire->tire_name }}_{{ \Carbon\Carbon::parse($tire->purchase_date)->format('y-m') }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="ml-2 mr-4 flex relative ">
                    <div >
                        <x-label for="atm_pressure" value="気圧" class="mt-0"/>
                        <select name="atm_pressure" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->atm_pressure }}" @if(\Request::get('atm_pressure') == '0') selected @endif >{{ $stint->atm_pressure }}</option>
                            @for($i = 990; $i <= 1040; $i=$i+5)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <x-label for="temp_id" value="気温" class="mt-0 ml-2"/>
                        <select class="w-24 bg-gray-100 border-gray-300 ml-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="temp_id" name="temp_id" type="text" >
                            <option value="{{ $stint->temp }}" @if(\Request::get('temp_id') == '0') selected @endif >{{ $stint->temp_range }}</option>
                            @foreach ($temps as $temp)
                                <option value="{{ $temp->id }}" @if(\Request::get('temp_id') == $temp->id ) selected @endif >{{ $temp->temp_range  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-label for="humi_id" value="湿度" class="mt-0"/>
                        <select class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="humi_id" name="humi_id" type="text" >
                            <option value="{{ $stint->humidity }}" @if(\Request::get('humi_id') == '0') selected @endif >{{ $stint->humi_range  }}</option>
                            @foreach ($humis as $humi)
                                <option value="{{ $humi->id }}" @if(\Request::get('humi_id') == $humi->id ) selected @endif >{{ $humi->humi_range  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="ml-2 mr-4 flex">
                    <div class="mr-2">
                        <x-label for="dry/wet" value="路面" class="mt-0"/>
                        <select name="dry/wet" class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->dry_wet }}" @if(\Request::get('dry/wet') == '0') selected @endif >{{ $stint->dry_wet }}</option>
                            <option value="dry">dry</option>
                            <option value="wet">wet</option>
                        </select>
                    </div>

                    <div>
                        <x-label for="road_temp_id" value="路面温度" class="mt-0"/>
                        <select class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="road_temp_id" name="road_temp_id" type="text" >
                            <option value="{{ $stint->road_temp }}" @if(\Request::get('road_temp_id') == '0') selected @endif >{{ $stint->roadtemp_range }}</option>
                            @foreach ($road_temps as $road_temp)
                                <option value="{{ $road_temp->id }}" @if(\Request::get('road_temp_id') == $road_temp->id ) selected @endif >{{ $road_temp->roadtemp_range  }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="ml-2 mr-4 flex">
                    <div class="mr-2">
                        <x-label for="tire_pres" value="タイヤ圧" class="mt-0"/>
                        <select name="tire_pres" class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="{{ $stint->tire_pres*100 }}" @if(\Request::get('tire_pres') == '0') selected @endif >{{ $stint->tire_pres }}</option>
                            @for($i = 65; $i <= 130; $i=$i+5)
                            <option value="{{$i}}">{{$i/100}}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <x-label for="tire_temp_id" value="タイヤ温度" class="mt-0"/>
                        <select class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="tire_temp_id" name="tire_temp_id" type="text" >
                            <option value="{{ $stint->tire_temp }}" @if(\Request::get('tire_temp_id') == '0') selected @endif >{{ $stint->tiretemp_range }}</option>
                            @foreach ($tire_temps as $tire_temp)
                                <option value="{{ $tire_temp->id }}" @if(\Request::get('tire_temp_id') == $tire_temp->id ) selected @endif >{{ $tire_temp->tiretemp_range  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="ml-2 mr-4 flex">
                <div class="mr-2">
                    <x-label for="fr_tread" value="フロントトレッド" class="mt-0"/>
                    <select name="fr_tread" class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                        <option value="{{ $stint->fr_tread }}" @if(\Request::get('fr_tread') == '0') selected @endif >{{ $stint->fr_tread }}</option>
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <x-label for="re_tread" value="リアトレッド" class="mt-0"/>
                    <select name="re_tread" class="w-40 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                        <option value="{{ $stint->re_tread }}" @if(\Request::get('re_tread') == '0') selected @endif > {{ $stint->re_tread }}</option>
                        @for($i = 1350; $i <= 1400; $i=$i+5)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                </div>


                <div class="flex ml-2">
                    <div calss="mr-2">
                        <x-label for="upper_of_time" value="BestTime" class="mt-0"/>
                        <select name="upper_of_time" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ floor($stint->best_time) }}" @if(\Request::get('upper_of_time') == '0') selected @endif >{{ floor($stint->best_time) }}</option>
                            @for($i = 30; $i <= 60; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <span>.</span>
                    </div>

                    <div class="ml-2">
                        <x-label for="bottom_of_time" value=" コンマ以下2桁" class="mt-0"/>
                        {{-- <x-input id="number_of_sub" class="bg-gray-100 block mt-1 w-full" id="number_of_sub" type="text" name="number_of_sub" :value="old('number_of_sub')" required  /> --}}
                        <select name="bottom_of_time" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ ($stint->best_time*100)%100}}" @if(\Request::get('bottom_of_time') == '0') selected @endif >{{ ($stint->best_time*100)%100 }}</option>
                            @for($i = 00; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <span>　秒　</span>
                    </div>
                    <div class="flex ml-00 ml-4">
                        <div>
                        <x-label for="laps" value="Lap数" class="mt-0"/>
                        {{-- <x-input id="number_of_sub" class="bg-gray-100 block mt-1 w-full" id="number_of_sub" type="text" name="number_of_sub" :value="old('number_of_sub')" required  /> --}}
                        <select name="laps" class="w-20 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->laps }}" @if(\Request::get('laps') == '0') selected @endif >{{ $stint->laps }}</option>
                            @for($i = 00; $i <= 50; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        </div>

                    </div>
                </div>

                <div class="ml-2 mr-4 flex">
                    <div>
                        <x-label for="max_rev" value="最高回転数" class="mt-0"/>
                        <select name="max_rev" class="w-24 mr-2 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->max_rev }}" @if(\Request::get('max_rev') == '0') selected @endif >{{ $stint->max_rev }}</option>
                            @for($i = 13500; $i <= 15000; $i=$i+100)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mr-4">
                        <x-label for="min_rev" value="最低回転数" class="mt-0"/>
                        <select name="min_rev" class="w-20 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->min_rev }}" @if(\Request::get('max_rev') == '0') selected @endif >{{ $stint->min_rev }}</option>
                            @for($i = 6500; $i <= 9000; $i=$i+100)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mr-2">
                        <x-label for="cab_hi" value="キャブHigh" class="mt-0"/>
                        <select name="cab_hi" class="w-20 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->cab_hi }}" @if(\Request::get('cab_hi') == '0') selected @endif >{{ $stint->cab_hi }}</option>
                            @for($i = 10; $i <= 30; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <x-label for="cab_lo" value="キャブLow" class="mt-0"/>
                        <select name="cab_lo" class="w-20 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->cab_lo }}" @if(\Request::get('cab_lo') == '0') selected @endif >{{ $stint->cab_lo }}</option>
                            @for($i = 80; $i <= 150; $i=$i+5)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="ml-2 mr-4 flex">
                    <div class="mr-2">
                        <x-label for="fr_sprocket" value="フロントスプロケ" class="mt-00"/>
                        <select name="fr_sprocket" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->fr_sprocket }}" @if(\Request::get('fr_sprocket') == '0') selected @endif >{{ $stint->fr_sprocket }}</option>
                            @for($i = 8; $i <= 12; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mr-2">
                        <x-label for="re_sprocket" value="リアスプロケ" class="mt-00"/>
                        <select name="re_sprocket" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->re_sprocket }}" @if(\Request::get('re_sprocket') == '0') selected @endif >{{ $stint->re_sprocket }}</option>
                            @for($i = 75; $i <= 90; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <x-label for="stabilizer" value="スタビ" class="mt-00"/>
                        <select name="stabilizer" class="w-24 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="{{ $stint->stabilizer }}">{{ $stint->stabilizer }}</option>
                            <option value="0度">0度</option>
                            <option value="30度">30度</option>
                            <option value="60度">60度</option>
                            <option value="90度">90度</option>
                        </select>
                    </div>
                </div>


            <div class="ml-2">
                <x-label for="stint_info" value="コメント" class="mt-1"/>
                <x-textarea row="5" id="stint_info" class="bg-gray-100 block mt-1 w-full" type="text" name="stint_info" >{{ $stint->stint_info }}</x-textarea>
            </div>
            <div class="px-2 md:w-2/1 mx-auto">
                <div class="relative flex">
                <div class="w-80 ml-2">
                    <x-stint-thumbnail :filename="$stint->photo1" />
                </div>
                <div class="w-80 ml-2">
                    <x-stint-thumbnail :filename="$stint->photo2" />
                </div>
                <div class="w-80 ml-2">
                    <x-stint-thumbnail :filename="$stint->photo3" />
                </div>
                </div>
            </div>

            <div class="p-0 md:flex">
                <div class="relative">
                    <x-label for="image1" value="サーキット画像" class="mt-00"/>
                    <input type="file" id="image1" name="image1" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative">
                    <x-label for="image2" value="フロントタイヤ画像" class="mt-00"/>
                    <input type="file" id="image2" name="image2" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative">
                    <x-label for="image3" value="リアタイヤ画像" class="mt-00"/>
                    <input type="file" id="image3" name="image3" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            </div>
            <div class="flex justify-between">

            <div class="p-2 w-1/2 mx-auto flex">
                <div class="p-2 w-full mt-2 flex justify-around">
                    <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新</button>
                </div>
            </div>
            </div>
        </form>


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

