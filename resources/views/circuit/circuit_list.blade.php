<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 leading-tight">
            Circuit_List
        </h2>
        <div class="ml-4 md:ml-13 text-indigo-500">
            ※サーキット名をクリックして詳細表示ができます。
        </div>

        <form method="get" action="{{ route('circuit_list')}}" class="mt-1">
            <x-flash-message status="session('status')"/>
            <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※エリア・サーキット名で検索できます　　　</span>
            <div class="md:flex">
            <select class="w-52 h-8 rounded text-sm pt-1 border mr-2 mb-2" id="area_id" name="area_id" type="text" >
                <option value="" @if(\Request::get('area_id') == '0') selected @endif >エリア検索</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->area_id }}" @if(\Request::get('area_id') == $area->area_id ) selected @endif >{{ $area->area_name  }}</option>
                @endforeach
            </select>

            <div class="mb-2 flex">
                <div>
                {{-- <label class="items-center ml-2 mr-1 text-sm mt-2 text-gray-800 leading-tight" >検索</label> --}}
               <input class="w-52 h-8 ml-0 md:ml-2 rounded text-sm pt-1" id="cir_name" placeholder="サーキット名検索（部分OK）" name="cir_name"  class="border">
                </div>
            <div>
                <div class="ml-2 ">
                    <button type="button" class="w-20 h-8 bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('circuit_list') }}'" >全表示</button>
                </div>
            </div>
            <div>
                <div class="ml-2 ">
                    <button type="button" class="w-20 h-8 bg-green-500 text-white ml-0 hover:bg-green-600 rounded" onclick="location.href='{{ route('circuit_create') }}'" >新規登録</button>
                </div>
            </div>
            </div>
        </div>
        </form>


        {{-- <x-flash-message status="session('status')"/> --}}
    </x-slot>

    <div class="py-0 border">
        <div class="md:w-2/3 sm:px-4 lg:px-4 border ">
            {{-- <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/> --}}
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">No</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Area</th>
                        <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">サーキット</th>
                        {{--  <th class="w-2/13 md:2/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>  --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($circuits as $circuit)

                    <tr>
                        <td class="w-1/13 md:1/13 text-sm md:px-4 py-1 text-center"> {{ $circuit->cir_id }} </td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-center"> {{ $circuit->area_name }} </a></td>
                        <td class="w-3/13 md:3/13 text-sm md:px-4 py-1 text-indigo-500 text-center"><a href="{{ route('circuit_detail',['circuit'=>$circuit->cir_id]) }}" > {{ $circuit->cir_name }} </a></td>


                        {{--  <td class="w-2/13 md:2/13 text-sm text-indigo-500 md:px-4 py-1 text-center"><a href="{{ route('my_reservation_show',['resv'=>$reservation->id]) }}" >詳細</a></td>  --}}
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>





        <script>

            const area = document.getElementById('area_id')
            area.addEventListener('change', function(){
            this.form.submit()
            })

            const cir_name = document.getElementById('cir_name')
            cir_name.addEventListener('change', function(){
            this.form.submit()
            })

        </script>

</x-app-layout>
