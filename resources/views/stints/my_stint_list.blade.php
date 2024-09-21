<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 leading-tight">
            My Stint
        </h2>
        <div class="ml-4 md:ml-13 text-indigo-500">
            ※”ベストタイム”をクリックすると<br>Stint内容の確認、Dataダウンロードができます。
        </div>



        <form method="get" action="{{ route('my_stint')}}" class="mt-1">
            <x-flash-message status="session('status')"/>
            <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※サーキットを選択してください　　　</span>
            <div class="flex">
            <select class="w-60 h-8 rounded text-sm pt-1 border mr-2 " id="cir_id" name="cir_id" type="text" >
                <option value="" @if(\Request::get('cir_id') == '0') selected @endif >サーキット</option>
                @foreach ($circuits as $circuit)
                    <option value="{{ $circuit->id }}" @if(\Request::get('cir_id') == $circuit->id ) selected @endif >{{ $circuit->cir_name  }}</option>
                @endforeach
            </select>
            </div>
            <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※カート・エンジン・タイヤを選択してください　　　</span>
            <div class="flex">

            <select class="w-32 h-8 rounded text-sm pt-1 boder mr-2 " id="kart_id" name="kart_id" type="text">
                <option value="" @if(\Request::get('kart_id') == '0') selected @endif >カート</option>
                @foreach ($karts as $kart)
                    <option value="{{ $kart->id }}" @if(\Request::get('kart_id') == $kart->id) selected @endif >{{ $kart->maker_name }}</option>
                @endforeach
            </select>
            <select class="w-32 h-8 rounded text-sm pt-1 boder mr-2" id="engine_id" name="engine_id" type="text">
                <option value="" @if(\Request::get('engine_id') == '0') selected @endif >エンジン</option>
                @foreach ($engines as $engine)
                    <option value="{{ $engine->id }}" @if(\Request::get('engine_id') == $engine->id) selected @endif >{{ $engine->engine_name }}</option>
                @endforeach
            </select>
            <select class="w-32 h-8 rounded text-sm pt-1 boder mr-2" id="tire_id" name="tire_id" type="text">
                <option value="" @if(\Request::get('tire_id') == '0') selected @endif >タイヤ</option>
                @foreach ($tires as $tire)
                    <option value="{{ $tire->id }}" @if(\Request::get('tire_id') == $tire->id) selected @endif >{{ $tire->tire_name }}</option>
                @endforeach
            </select>
            </div>
            <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※気温・湿度・路面温度を選択してください　　　</span>
            <div class="flex">
            <select class="w-32 h-8 rounded text-sm pt-1 border mb-2 mr-2 " id="temp_id" name="temp_id" type="text" >
                <option value="" @if(\Request::get('temp_id') == '0') selected @endif >気温</option>
                @foreach ($temps as $temp)
                    <option value="{{ $temp->id }}" @if(\Request::get('temp_id') == $temp->id ) selected @endif >{{ $temp->temp_range  }}</option>
                @endforeach
            </select>
            <select class="w-32 h-8 rounded text-sm pt-1 boder mr-2 " id="humi_id" name="humi_id" type="text">
                <option value="" @if(\Request::get('humi_id') == '0') selected @endif >湿度</option>
                @foreach ($humis as $humi)
                    <option value="{{ $humi->id }}" @if(\Request::get('humi_id') == $humi->id) selected @endif >{{ $humi->humi_range }}</option>
                @endforeach
            </select>
            <select class="w-32 h-8 rounded text-sm pt-1 border mb-2 mr-2 " id="road_temp_id" name="road_temp_id" type="text" >
                <option value="" @if(\Request::get('road_temp_id') == '0') selected @endif >路面温度</option>
                @foreach ($road_temps as $road_temp)
                    <option value="{{ $road_temp->id }}" @if(\Request::get('road_temp_id') == $road_temp->id ) selected @endif >{{ $road_temp->roadtemp_range  }}</option>
                @endforeach
            </select>
            </div>
        <div class="md:flex">
            <div class="ml-0 ">
                <button type="button" class="w-40 h-8 bg-indigo-500 text-white mr-20 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('my_stint') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">全表示</button>
            </div>
            <div class="flex mt-2 md:mt-0">
            <div class="ml-0 md:ml-4 md:mt-0">
                <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white hover:bg-green-600 rounded" onclick="location.href='{{ route('stint_create') }}'" >Stint登録</button>
            </div>
            <div class="ml-0 ml-2 md:ml-4 md:mt-0">
                <button type="button" class="w-40 h-8 text-sm bg-blue-400 text-white hover:bg-blue-500 rounded" onclick="location.href='{{ route('myStintCSV_download') }}'" >MyStintDataダウンロード</button>
            </div>
            </div>

        </div>
        </form>

        <div class=" max-w-2xl  sm:px-0 lg:px-0 border mt-4 ml-0 rounded">
            @foreach ($num_of_laps as $lap)
            <div class='border bg-gray-100 h-6'>
                Stint　：　{{ ($lap->number_of_laps) }}　回　　　Lap数　：　{{ ($lap->laps) }}　Lap
            </div>
            @endforeach
        </div>


    </x-slot>

    <div class="py-0 border">
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Stint</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Date</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">サーキット</th>
                        <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Tire</th>
                        <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Engine</th>
                        <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">BestTime</th>
                        <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Laps</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($stints as $stint)

                    <tr>
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $stint->stint_id }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($stint->start_date)->format("y/m/d H:i") }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $stint->cir_name }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1  text-center"> {{ $stint->tire_name }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1  text-center"> {{ $stint->engine_name }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('my_stint_show',['stint'=>$stint->stint_id]) }}" > {{$stint->best_time}}</a> </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1  text-center"> {{ $stint->laps }} </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>





        <script>

            const cir = document.getElementById('cir_id')
            cir.addEventListener('change', function(){
            this.form.submit()
            })

            const kart = document.getElementById('kart_id')
            kart.addEventListener('change', function(){
            this.form.submit()
            })

            const tire = document.getElementById('tire_id')
            tire.addEventListener('change', function(){
            this.form.submit()
            })

            const engine = document.getElementById('engine_id')
            engine.addEventListener('change', function(){
            this.form.submit()
            })

            const temp = document.getElementById('temp_id')
            temp.addEventListener('change', function(){
            this.form.submit()
            })

            const road_temp = document.getElementById('road_temp_id')
            road_temp.addEventListener('change', function(){
            this.form.submit()
            })

            const humi = document.getElementById('humi_id')
            humi.addEventListener('change', function(){
            this.form.submit()
            })

            const from_date = document.getElementById('from_date')
            from_date.addEventListener('change', function(){
            this.form.submit()
            })


        </script>

</x-app-layout>
