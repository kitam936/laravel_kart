<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 leading-tight">
            My Chassis List
        </h2>
        <div class="flex">
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >My_Kart</button>
            </div>
            <div class="ml-2 md:ml-2">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white hover:bg-indigo-600 rounded" onclick="location.href='{{ route('maker_index') }}'" >Maker_List</button>
            </div>
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 bg-green-500 text-white ml-0 hover:bg-green-600 rounded" onclick="location.href='{{ route('chassis_create') }}'" >新規登録</button>
            </div>
        </div>
        <br>
        <div class="ml-4 md:ml-13 text-indigo-500">
            ※”No”・”Maker”をクリックすると詳細の確認ができます。
        </div>


    </x-slot>

    <div class="py-0 border">
        <x-flash-message status="session('status')"/>
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">No</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Maker</th>
                        <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Model_Year</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($karts as $kart)

                    <tr>
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('chassis_show',['chassis'=>$kart->kart_id]) }}" >{{ $kart->kart_id }} </a></td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($kart->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('maker_show',['maker'=>$kart->maker_id]) }}" > {{$kart->maker_name}}</a> </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1  text-center"> {{ $kart->model_year }} </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>



</x-app-layout>
