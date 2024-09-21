<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl mb-4 text-gray-800 dark:text-gray-200 leading-tight">
        <div>
            アカウント情報
        </div>
        </h2>
        <div class="md:flex ml-8 ">

        {{-- @if($login_user == $user->id) --}}
        <div class="md:ml-4 ml-0 mt-2 md:mt-0 md:ml-4">
            <button type="button" onclick="location.href='{{ route('ac_info_edit',['user'=>$user->id])}}'" class="w-32 h-8 text-center text-sm text-white bg-indigo-500 border-0 py-1 px-2 focus:outline-none hover:bg-indigo-600 rounded ">編集</button>
        </div>
        {{-- @endif --}}

        </div>
        <x-flash-message status="session('status')"/>
    </x-slot>

    <div class="py-4">
        <div class="md:w-2/3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">

                    <form method="get" action=""  enctype="multipart/form-data">

                        <div class="-m-2">
                            <div class="p-2 mx-auto">

                                <div class="p-2 w-full mx-auto">
                                    <div class="flex mx-auto">
                                        <div class="relative mr-2">
                                            <label for="id" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">No</label>
                                            <div  id="id" name="id" value="{{$user->id}}" class="pl-2 w-12 h-6 text-sm items-center bg-gray-100 border rounded">{{$user->id}}
                                            </div>
                                        </div>
                                        @if(!empty($user2->area_name))
                                        <div class="relative">
                                            <label for="area_name" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">エリア</label>
                                            <div  id="area_name" name="area_name" value="{{$user2->area_name}}" class="pl-2 w-48  h-6 text-sm items-center bg-gray-100 border rounded">{{$user2->area_name}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="relative">
                                        <label for="area_name" class="leading-7 text-sm  text-red-800 dark:text-gray-200 leading-tight">エリア</label>
                                        <div  id="area_name" name="area_name" value="{{$user->area_name}}" class="pl-2 h-6 text-sm w-48 items-center bg-red-100 border rounded"><span class="text-red-500">未登録です</span>
                                        </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="relative ">
                                    <label for="user_name" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">ネーム</label>
                                    <div  id="user_name" name="user_name" value="{{$user->name}}" class="pl-2  w-60 h-6 text-sm items-center bg-gray-100 border rounded">{{$user->name}}
                                    </div>
                                    </div>
                                    @if(!empty($user->name_kana))
                                    <div class="relative">
                                    <label for="user_name_kana" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">ネーム(カナ)</label>
                                    <div  id="user_name_kana" name="user_name_kana" value="{{$user->name_kana}}" class="pl-2  w-60 h-6 text-sm items-center bg-gray-100 border rounded">{{$user->name_kana}}
                                    </div>
                                    @else
                                    <div class="relative">
                                        <label for="user_name_kana" class="leading-7 text-sm  text-red-500 dark:text-gray-200 leading-tight">ネーム(カナ)</label>
                                        <div  id="user_name_kana" name="user_name_kana" value="{{$user->name_kana}}" class="pl-2 h-6 text-sm  w-60 bg-red-100 border rounded"><span class="text-red-500">未入力です</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">Mail　※本人のみ表示・公開されません</label>
                                        <div  id="email" name="email" value="{{$user->email}}" class="pl-2 w-60 h-6 text-sm items-center bg-gray-100 border rounded">{{$user->email}}
                                        </div>
                                    </div>
                                    @if(!empty($user->user_info))
                                    <div class="relative">
                                        <label for="user_info" class="leading-7 text-sm  text-gray-800 dark:text-gray-200 leading-tight">コメント</label>
                                        <div  id="user_info" name="user_info" value="{!! nl2br(e($user->user_info)) !!}" row="5" class="pl-2 text-sm w-full md:w-2/3 bg-gray-100 border rounded">{!! nl2br(e($user->user_info)) !!}
                                        </div>
                                    </div>
                                    @else
                                    <div class="relative">
                                        <label for="user_info" class="leading-7 text-sm  text-red-500 dark:text-gray-200 leading-tight">コメント</label>
                                        <div  id="user_info" name="user_info" value="{!! nl2br(e($user->user_info)) !!}" row="5" class="pl-2 text-sm w-full md:w-2/3 bg-red-100 border rounded"><span class="text-red-500">未入力です</span>
                                        </div>
                                    </div>
                                    @endif
                                    </div>
                            </div>


                                <div class="md:flex ml-1 px-2 mx-auto">
                                    <div class="w-full mb-1">
                                        <span class=" text-sm ">画像1</span>
                                        @if(!empty($user->photo1))
                                        <img src="{{ asset('storage/user/'.$user->photo1) }}">
                                        @else
                                        <div  id="photo1" name="photo1" class="pl-2 h-6 text-sm w-full bg-red-100 border rounded"><span class="text-red-500">未登録です</span></div>
                                        @endif
                                        {{-- <img src="{{ asset('storage/users/'.$user->photo1) }}"> --}}
                                    </div>
                                    <div class="w-full mb-1 ml-1">
                                        <span class=" text-sm ">画像2</span>
                                        @if(!empty($user->photo2))
                                        <img src="{{ asset('storage/user/'.$user->photo2) }}">
                                        @else
                                        <div  id="photo2" name="photo2" class="pl-2 h-6 text-sm w-full bg-red-100 border rounded"><span class="text-red-500">未登録です</span></div>
                                        @endif
                                        {{-- <img src="{{ asset('storage/users/'.$user->photo2) }}"> --}}
                                    </div>
                                </div>

                                {{-- @endforeach --}}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-0 border">
        <div class="max-w-7xl sm:px-6 lg:w-2/3 px-0">
            ホームコース
            <table class="md:w-full bg-white table-auto w-full text-center whitespace-no-wrap">
                <thead>
                    <tr>
                        <th class="w-2/6 md:2/6 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">エリア</th>
                        <th class="w-4/6 md:4/6 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">サーキット名</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($favorites as $favorite)
                    <tr>
                        <td class="w-2/6 md:2/6 text-sm md:px-4 py-1 text-center"> {{ $favorite->area_name }} </td>
                        <td class="w-4/6 md:4/6 text-sm md:px-4 py-1 text-center text-indigo-500"><a href="{{ route('circuit_detail',['circuit'=>$favorite->cir_id]) }}" >{{ $favorite->cir_name }}</a></td>

                        {{--  <td class="w-2/12 md:2/12 text-sm md:px-4 py-1 text-center"><a href="{{ route('member_detail',['user'=>$user->id]) }}" class="w-20 h-8 text-indigo-500 ml-2 "  >詳細</a></td>  --}}
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {{  $favorites->links()}}
        </div>
    </div>

</x-app-layout>
