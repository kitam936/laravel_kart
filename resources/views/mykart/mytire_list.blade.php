<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 leading-tight">
            My Tire List
        </h2>
        <div class="flex">
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('mykart.index') }}'" >MyKart</button>
            </div>
            <div class="ml-2 md:ml-2">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white hover:bg-indigo-600 rounded" onclick="location.href='{{ route('tire_index') }}'" >Tire List</button>
            </div>
            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 bg-green-500 text-white ml-0 hover:bg-green-600 rounded" onclick="location.href='{{ route('mytire_create') }}'" >新規登録</button>
            </div>
        </div>
        <br>
        <div class="ml-4 md:ml-13 text-indigo-500">
            ※”Tire No”・”Name”をクリックすると詳細の確認ができます。
        </div>


    </x-slot>

    <div class="py-0 border">
        <x-flash-message status="session('status')"/>
        <div class=" mx-auto sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Tire No</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Laps</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">距離</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- @foreach ($tires as $tire)

                    <tr>
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('mytire_show',['tire'=>$tire->my_tire_id]) }}" >{{ $tire->my_tire_id }} </a></td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($tire->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('tire_show',['tire'=>$tire->tire_id]) }}" > {{$tire->tire_name}}</a> </td>

                    @endforeach --}}

                    @foreach ($tires2 as $tire)

                    <tr>
                        @if(!Empty($tire->laps))
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-indigo-500 text-center"> <a href="{{ route('mytire_show',['tire'=>$tire->id]) }}" >{{ $tire->id }} </a></td>
                        @else
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $tire->id }} </td>
                        @endif
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ \Carbon\Carbon::parse($tire->purchase_date)->format("y/m/d") }} </td>
                        <td class="w-2/13 md:2/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('tire_show',['tire'=>$tire->tire_id]) }}" > {{$tire->tire_name}}</a> </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $tire->laps }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $tire->distance }} </td>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>



</x-app-layout>
