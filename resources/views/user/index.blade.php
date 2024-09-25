<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold mb-2 text-xl text-gray-800 leading-tight">
            Memberリスト

        </h2>


        <form method="get" action="{{ route('memberlist')}}" class="mt-4">
            <x-flash-message status="session('status')"/>
            <span class="items-center text-sm mt-2 text-gray-800 leading-tight" >※エリア・Nameで検索できます　　　</span>
            <div class="md:flex">
            <div class="flex" >
                <div class="mb-2 ml-00 md:flex mb-4">
                    {{--  <label class="items-center text-sm mt-2 text-gray-800 leading-tight" >エリア　</label>  --}}
                    <select class="w-40 h-8 rounded text-sm pt-1" id="ar_id" name="ar_id"  class="border" >
                    <option value="" @if(\Request::get('ar_id') == '0') selected @endif >全エリア</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" @if(\Request::get('ar_id') == $area->id) selected @endif >{{ $area->area_name }}</option>
                    @endforeach
                    </select>
                </div>

                </div>
                <div class="flex mb-2 md:flex mb-4">
                         {{-- <label class="items-center ml-2 mr-1 text-sm mt-2 text-gray-800 leading-tight" >検索</label> --}}
                        <input class="w-40 h-8 ml-0 md:ml-4 rounded text-sm pt-1" id="user_name" placeholder="Name検索" name="user_name"  class="border">

                <div class="ml-2 md:ml-4">
                    <button type="button" class="w-20 h-8 text-sm  bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('memberlist') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">全表示</button>
                </div>
                @if($login_user->role_id == 1)
                <div class="ml-2 md:ml-4">
                    <button type="button" class="w-20 h-8 text-sm  bg-green-500 text-white ml-0 hover:bg-green-600 rounded" onclick="location.href='{{ route('role_list') }}'" class="mb-2 ml-2 text-right text-black bg-indigo-300 border-0 py-0 px-2 focus:outline-none hover:bg-indigo-300 rounded ">Role</button>
                </div>
                @endif


            </div>
            </div>
        </form>
    </x-slot>

    <div class="py-0 border">
        <div class="md:w-2/3 sm:px-4 lg:px-4 border ">
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-1/10 md:1/10 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">No</th>
                        <th class="w-2/10 md:2/10 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">エリア</th>
                        <th class="w-3/10 md:3/10 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ネーム</th>
                        <th class="w-4/10 md:4/10 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">コメント</th>
                        {{--  <th class="w-2/12 md:2/12 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>  --}}

                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="w-1/12 md:1/12 text-sm md:px-4 py-1 text-center"> {{ $user->id }} </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-center"> {{ $user->area_name }} </td>
                        <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-center text-indigo-500"><a href="{{ route('member_detail',['user'=>$user->id]) }}" >{{ Str::limit($user->name,30) }}</a></td>
                        <td class="w-3/12 md:3/12 text-xs md:px-4 py-1 text-center">{{ Str::limit($user->user_info,28) }}</td>
                        {{--  <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-center"><a href="{{ route('member_detail',['user'=>$user->id]) }}" class="w-20 h-8 text-indigo-500 ml-2 "  >詳細</a></td>  --}}
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{  $users->appends([
                'ar_id'=>\Request::get('ar_id'),
                'role_id'=>\Request::get('role_id'),
                'user_name'=>\Request::get('user_name'),
            ])->links()}}
        </div>
    </div>





        <script>
            const role = document.getElementById('role_id')
            role.addEventListener('change', function(){
            this.form.submit()
            })

            const area = document.getElementById('ar_id')
            area.addEventListener('change', function(){
            this.form.submit()
            })

            const user_name = document.getElementById('user_name')
            user_name.addEventListener('change', function(){
            this.form.submit()
            })


        </script>

</x-app-layout>
