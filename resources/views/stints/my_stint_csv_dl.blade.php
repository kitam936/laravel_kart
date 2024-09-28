<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            MyStint ダウンロード
        </h2>
        <div class="flex">
        <div class="ml-2 md:ml-4">
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white md:ml-12 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('my_stint') }}'" >MyStint</button>
        </div>
        <div class="ml-8 text-sm">
        ※条件を指定してダウンロードできます。<br>
        　条件を指定しない場合は全データをダウンロードします。<br>
        </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />



            <x-flash-message status="session('status')"/>

            <form method="get" action="{{ route('myStintCSV_download2') }}" >



                <div class="flex relative w-40">
                    <div class="relative ml-2 mr-0">
                    <x-label for="cir_id" value="サーキット" />
                    <select  id="cir_id" name="cir_id"  class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="" @if(\Request::get('cir_id') == '0') selected  @endif >サーキット選択</option>
                        {{-- <option :value="old('cir_id')" @if(\Request::get('cir_id') == old('cir_id')) selected  @endif >{{ old('cir_name')}}</option> --}}
                        @foreach ($cirs as $cir)
                            <option value="{{ $cir->id }}" @if(old('cir_id') == $cir->id) selected @endif>{{ $cir->cir_name }}</option>
                            {{-- <option value="{{ $cir->id }}"  >{{ $cir->cir_name }}</option> --}}
                        @endforeach
                    </select>
                    </div>
                    <div class="relative ml-2">
                        <x-label for="kart_id" value="カート" />
                        <select  id="kart_id" name="kart_id"  class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="" @if(\Request::get('kart_id') == '0') selected @endif >kart選択</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($karts as $kart)
                            <option value="{{ $kart->maker_id }}" @if(old('kart_id') == $kart->maker_id) selected @endif>{{ $kart->maker_id }}_{{ $kart->maker_name }}</option>
                            {{-- <option value="{{ $kart->mykart_id }}"  >{{ $kart->mykart_id }}_{{ $kart->maker_name }}_{{ $kart->model_year }}</option> --}}
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex mt-1">

                    <div class="relative ml-2 mr-0">
                        <x-label for="engine_id" value="エンジン" />
                        <select  id="engine_id" name="engine_id"  class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="" @if(\Request::get('engine_id') == '0') selected @endif >エンジン選択</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($engines as $engine)
                            <option value="{{ $engine->engine_id }}" @if(old('engine_id') == $engine->engine_id) selected @endif>{{ $engine->engine_name }}</option>
                            {{-- <option value="{{ $engine->myengine_id }}"  >{{ $engine->myengine_id }}_{{ $engine->engine_name }}_{{ \Carbon\Carbon::parse($engine->purchase_date)->format('y-m') }}</option> --}}
                        @endforeach
                        </select>
                    </div>
                    <div class="relative ml-2 ">
                        <x-label for="tire_id" value="タイヤ" />
                        <select  id="tire_id" name="tire_id"  class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" >
                        <option value="" @if(\Request::get('tire_id') == '0') selected @endif >タイヤ選択</option>
                        {{-- <option value="{{ $user->area_id }}" @if(\Request::get('area_id') == '0') selected @endif >{{ $user->area_name }}</option> --}}
                        @foreach ($tires as $tire)
                            <option value="{{ $tire->tire_id }}" @if(old('tire_id') == $tire->tire_id) selected @endif>{{ $tire->tire_name }}</option>
                            {{-- <option value="{{ $tire->mytire_id }}"  >{{ $tire->mytire_id }}_{{ $tire->tire_name }}_{{ \Carbon\Carbon::parse($tire->purchase_date)->format('y-m') }}</option> --}}
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="ml-2 mr-4 flex relative ">

                    <div>
                        <x-label for="temp_id" value="気温" class="mt-0"/>
                        <select class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="temp_id" name="temp_id" type="text" >
                            <option value="" @if(\Request::get('temp_id') == '0') selected @endif >気温</option>
                            @foreach ($temps as $temp)
                                <option value="{{ $temp->id}}" @if(old('temp_id') == $temp->id) selected @endif>{{ $temp->temp_range  }}</option>
                                {{-- <option value="{{ $temp->id }}" @if(\Request::get('temp_id') == $temp->id ) selected @endif >{{ $temp->temp_range  }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-label for="humi_id" value="湿度" class="mt-0"/>
                        <select class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="humi_id" name="humi_id" type="text" >
                            <option value="" @if(\Request::get('humi_id') == '0') selected @endif >湿度</option>
                            @foreach ($humis as $humi)
                                <option value="{{ $humi->id}}" @if(old('humi_id') == $humi->id) selected @endif>{{ $humi->humi_range  }}</option>
                                {{-- <option value="{{ $humi->id }}" @if(\Request::get('humi_id') == $humi->id ) selected @endif >{{ $humi->humi_range  }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="ml-2 mr-4 flex">
                    <div class="mr-2">
                        <x-label for="dry_wet" value="路面" class="mt-0"/>
                        <select name="dry_wet" class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                            <option value="" @if(\Request::get('dry/wet') == '0') selected @endif >路面</option>
                            {{-- <option value="dry">dry</option> --}}
                            <option value="dry" @if(old('dry_wet') == "dry") selected @endif>dry</option>
                            <option value="wet" @if(old('dry_wet') == "wet") selected @endif>wet</option>
                            {{-- <option value="wet">wet</option> --}}

                        </select>
                    </div>

                    <div>
                        <x-label for="road_temp_id" value="路面温度" class="mt-0"/>
                        <select class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="road_temp_id" name="road_temp_id" type="text" >
                            <option value="" @if(\Request::get('road_temp_id') == '0') selected @endif >路面温度</option>
                            @foreach ($road_temps as $road_temp)
                                <option value="{{ $road_temp->id}}" @if(old('road_temp_id') == $road_temp->id) selected @endif>{{ $road_temp->roadtemp_range  }}</option>
                                {{-- <option value="{{ $road_temp->id }}" @if(\Request::get('road_temp_id') == $road_temp->id ) selected @endif >{{ $road_temp->roadtemp_range  }}</option> --}}
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="ml-2 mr-4 flex">

                    <div>
                        <x-label for="tire_temp_id" value="タイヤ温度" class="mt-0"/>
                        <select class="w-40 h-8 text-sm bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 " id="tire_temp_id" name="tire_temp_id" type="text" >
                            <option value="" @if(\Request::get('tire_temp_id') == '0') selected @endif >タイヤ温度</option>
                            @foreach ($tire_temps as $tire_temp)
                                <option value="{{ $tire_temp->id}}" @if(old('tire_temp_id') == $tire_temp->id) selected @endif>{{ $tire_temp->tiretemp_range  }}</option>
                                {{-- <option value="{{ $tire_temp->id }}" @if(\Request::get('tire_temp_id') == $tire_temp->id ) selected @endif >{{ $tire_temp->tiretemp_range  }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                </div>




            <div class="flex p-2 mt-2 w-full ">
                <div class="ml-2 md:ml-0 md:mt-0">
                    <button type="button" class="w-40 h-8 text-sm bg-pink-400 text-white hover:bg-pink-500 rounded" onclick="location.href='{{ route('mystint_DL') }}'" >条件クリア</button>
                </div>
                <div class="ml-4 flex justify-around">
                    <button type="submit" class="w-40 h-8 text-sm text-white bg-blue-400 border-0 focus:outline-none hover:bg-blue-500 rounded text-lg">ダウンロード</button>
                </div>
            </div>

        </form>
            </div>
        </div>
        </div>
    </div>


    <script>

        // const sub = document.getElementById('number_of_sub')
        // sub.addEventListener('change', function(){
        // this.form.submit()
        // })




    </script>
</x-app-layout>

