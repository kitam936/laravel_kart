<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            参加者リスト



        </h2>
        <div class="ml-2 mb-2 flex md:ml-20">
            <div class="ml-0 mt-2 md:mt-0 md:ml-20">
                <button type="button" class="w-40 h-8 bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('eventlist') }}'" >イベントリスト</button>
            </div>

            <div class="ml-00 mt-2 md:ml-4 md:mt-0">

                <button type="button" class="w-40 h-8 bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('event_detail',['event'=>$event->id]) }}'" >イベント詳細</button>

            </div>
        </div>

        <input type="hidden" id="evt_id" name="evt_id" value="{{ $event->id }}"/>
        <span class="items-center text-sm mt-2 text-gray-800 dark:text-gray-200 leading-tight" >※メーカー・車種を選択してください　　　</span>

        <form method="get" action="{{ route('reservation_list',['event'=>$event->id ])}}" class="mt-1">
            <x-flash-message status="session('status')"/>
            <div class="flex">
            <select class="w-32 h-8 rounded text-sm pt-1 border mb-2 mr-2 " id="primary_id" name="primary_id" type="text" >
                <option value="" @if(\Request::get('primary_id') == '0') selected @endif >全メーカー</option>
                @foreach ($primaries as $primary)
                    <option value="{{ $primary->id }}" @if(\Request::get('primary_id') == $primary->id ) selected @endif >{{ $primary->primary_name  }}</option>
                @endforeach
            </select>
            <select class="w-32 h-8 rounded text-sm pt-1 boder" id="secondary_id" name="secondary_id" type="text">
                <option value="" @if(\Request::get('secondary_id') == '0') selected @endif >全車</option>
                @foreach ($secondaries as $secondary)
                    <option value="{{ $secondary->id }}" @if(\Request::get('secondary_id') == $secondary->id) selected @endif >{{ $secondary->secondary_name }}</option>
                @endforeach
            </select>


            <div class="ml-2 md:ml-4">
                <button type="button" class="w-20 h-8 bg-indigo-500 text-white ml-2 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('reservation_list',['event'=>$event->id]) }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">全表示</button>
            </div>
            </div>
        </form>


        <div class=" max-w-2xl  sm:px-0 lg:px-0 border mt-4 ml-0 rounded">
            @foreach ($number_of_resv as $resv)
            <div class='border bg-gray-100 h-6'>
                　参加数　：　{{ ($resv->number_of_main) }}台　　　参加者　：　{{ ($resv->number_of_main) + ($resv->number_of_sub) }}人　
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
                        <th class="w-2/14 md:1/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
                        <th class="w-1/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">エリア</th>
                        <th class="w-1/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メーカー</th>
                        <th class="w-2/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">車種</th>
                        <th class="w-1/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Col</th>
                        <th class="w-2/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Status</th>
                        <th class="w-3/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">info</th>
                        <th class="w-2/14 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)

                    <tr>
                        {{-- <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-left"> {{ $user->pivot->event_id }} </td> --}}
                        <td class="w-2/14 md:1/12 text-sm md:px-4 py-1 text-left"> {{ $user->name }} </td>
                        <td class="w-1/14 md:1/12 text-sm md:px-4 py-1 text-left"> {{$user->area_name}} </td>
                        <td class="w-1/14 md:1/12 text-sm md:px-4 py-1 text-left"> {{ $user->primary_name }} </td>
                        <td class="w-2/14 md:1/12 text-sm md:px-4 py-1 text-left"> {{ $user->secondary_name }} </td>
                        <td class="w-1/14 md:1/12 text-sm md:px-4 py-1 text-left"> {{ $user->sub_name }} </td>
                        <td class="w-2/14 md:2/12 text-sm md:px-4 py-1 text-left">{{ $user->status }}</td>
                        <td class="w-3/14 md:2/12 text-sm md:px-4 py-1 text-left">{{ Str::limit($user->resv_info,50) }}</td>
                        <td class="w-2/14 md:2/12 text-sm md:px-4 py-1 text-center"><a href="{{ route('resv_member_detail',['user'=>$user->user_id]) }}" class="w-20 h-8 text-indigo-500 ml-2 "  >詳細</a></td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{-- {{  $users->links()}} --}}
        </div>
    </div>





        <script>

            const primary = document.getElementById('primary_id')
            primary.addEventListener('change', function(){
            this.form.submit()
            })

            const secondary = document.getElementById('secondary_id')
            secondary.addEventListener('change', function(){
            this.form.submit()
            })


        </script>

</x-app-layout>
