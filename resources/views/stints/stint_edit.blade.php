<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            参加申込変更
        </h2>

        <div class="ml-2 md:ml-4">
            <input type="hidden" id="resv_id" name="resv_id" value="{{ $resv_id }}"/>
            <button type="button" class="w-32 h-8 bg-indigo-500 text-white ml-60 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('my_reservation_show',['resv'=>$resv_id]) }}'" >予約詳細</button>
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

            <form method="POST" action="{{ route('reservation_update',['resv'=>$resv_id]) }}">
                @csrf

                <div>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $resv->user_id }}" />
                    <input type="hidden" id="event_id" name="event_id" value="{{ $resv->event_id }}"/>
                </div>
            <div class="md:flex">
                <div class="flex mt-1">
                    <div class="relative w-40 mr-2">
                        {{-- <label for="category" class="leading-7 text-sm text-gray-600">車種</label> --}}
                        <x-label for="category" value="車種" class="mt-1"/>
                        <select name="category" required  autofocus id="category" class="bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="{{ $resv->secondary_category_id }}" @if(\Request::get('category') == '0') selected @endif >{{ $resv->secondary_name }}</option>
                            @foreach($categories as $category)
                            <optgroup label="{{ $category->primary_name }}">
                                @foreach($category->secondary as $secondary)
                                    <option value="{{ $secondary->id}}" >
                                    {{ $secondary->secondary_name }}
                                    {{-- {{ $resv->secondary_name }} --}}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-2 ">
                    <x-label for="sub_category" value="Col" class="mt-1"/>
                    <select required class="w-32 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="sub_category" name="sub_category" type="text" >
                        <option value="{{ $resv->sub_category_id }}" @if(\Request::get('sub_category') == '0') selected @endif >{{ $resv->sub_name }}</option>
                        @foreach ($sub_categories as $sub_category)
                            <option value="{{ $sub_category->id }}" @if(\Request::get('sub_category') == $sub_category->id ) selected @endif >{{ $sub_category->sub_name  }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>


                <div class="md:ml-2">
                    <x-label for="number" value="ナンバープレートの4桁数字　※公開されません" class="mt-1"/>
                    <x-input id="number" class="bg-gray-100 block mt-1 w-40" type="text" name="number" value="{{ $resv->number }}" required />
                </div>
            </div>
            <div class="md:flex">
                <div>
                    <x-label for="real_name" value="本名　※公開されません" class="mt-1"/>
                    <x-input id="real_name" class="bg-gray-100 block mt-1 w-full" type="text" name="real_name" value="{{ $resv->real_name }}" required autofocus />
                </div>
                <div class="md:ml-2">
                    <x-label for="real_name_kana" value="本名（カナ）※公開されません" class="mt-1"/>
                    <x-input id="real_name_kana" class="bg-gray-100 block mt-1 w-full" type="text" name="real_name_kana" value="{{ $resv->real_name_kana }}" required autofocus />
                </div>

            </div>
            <div>
                <x-label for="resv_info" value="自己紹介等のコメント" class="mt-1"/>
                <x-textarea row="5" id="resv_info" class="bg-gray-100 block mt-1 w-full" type="text" name="resv_info" required>{{ $resv->resv_info }}</x-textarea>
            </div>
            <div class="flex justify-between">
                {{-- <div>
                    <x-label for="number_of_main" value="予約" />
                    <x-input id="number_of_main" class="block mt-1 w-full" id="number_of_main" type="text" name="event_date" :value="old('number_of_main')" required  />
                </div> --}}

                <div class="flex">
                    <div class="ml-0">
                    <x-label for="number_of_sub" value="同伴者数" class="mt-1"/>
                    {{-- <select name="number_of_sub" class="w-16 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                        <option value="{{ $resv->number_of_sub }}" @if(\Request::get('number_of_sub') == '0') selected @endif >{{ $resv->number_of_sub }}</option>
                        @for($i = 0; $i <= 4; $i++)
                        <option value="{{$i}}" @if(\Request::get('number_of_sub') == $i ) selected @endif >{{$i}}</option>
                        @endfor
                    </select> --}}
                    <select name="number_of_sub" class="w-16 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text">
                        <option value="{{ $resv->number_of_sub }}" @if(\Request::get('number_of_sub') == '0') selected @endif >{{ $resv->number_of_sub }}</option>
                        <option value="0" @if(\Request::get('number_of_sub') == '0' ) selected @endif >0</option>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                    </select>
                    </div>

                </div>


            </div>



                <div class="md:flex justify-between">

                <div>
                    <x-label for="main_fee" value="参加費" class="mt-1"/>
                    <div class="flex">
                    <div id="main_fee" class="h-10 block mt-1 w-24 text-left text-gray-800 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="main_fee" type="text" name="main_fee" value="{{ $resv->main_fee }}"  >{{ $resv->main_fee }}円</div>
                    <div id="number_of_main" class="h-10 block mt-1 ml-2 w-18 text-gray-800 text-left border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="number_of_main" type="text" name="number_of_main" value="{{ $resv->number_of_main }}"  >1台</div>
                    <div id="main_fee_total" class="h-10 block mt-1 ml-2 w-32 text-gray-800 text-left border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="main_fee_total" type="text" name="main_fee_total" value="{{ $resv->main_fee * 1 }}"  >{{ $resv->main_fee * 1 }}円</div>
                    </div>
                </div>

                <div>
                    <x-label for="sub_fee" value="同伴参加費" class="mt-1"/>
                    <div class="flex">
                        <div id="sub_fee" class="h-10 block mt-1 w-24 text-left text-gray-800 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="sub_fee" type="text" name="sub_fee" value="{{ $resv->sub_fee }}"  >{{ $resv->sub_fee }}円</div>
                        <div id="number_of_sub" class="h-10 block mt-1 ml-2 w-18 text-gray-800 text-left border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="number_of_sub" type="text" name="number_of_sub" value="{{ $resv->number_of_sub}}"  >{{ $resv->number_of_sub}}人</div>
                        <div id="sub_fee_total" class="h-10 block mt-1 ml-2 w-32 text-gray-800 text-left border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="sub_fee_total" type="text" name="sub_fee_total" value="{{ $resv->number_of_sub * $resv->sub_fee }}"  >{{ $resv->number_of_sub * $resv->sub_fee}} 円</div>
                    </div>
                </div>

            </div>
                <div>
                    <x-label for="fee_total" value="参加費合計" class="mt-1"/>
                    <div id="fee_total" class="h-10 text-gray-800 block mt-1 w-48 text-left border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="fee_total" type="text" name="fee_total" value="{{ $resv->main_fee * 1 + $resv->number_of_sub * $resv->sub_fee}}"  >{{ $resv->main_fee * 1 + $resv->number_of_sub * $resv->sub_fee}} 円</div>
                </div>


                <div class="flex justify-between">

                <div class="p-2 w-1/2 mx-auto flex">
                    <div class="ml-2 md:ml-4">
                        {{-- <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('reservation_check',['event'=>$event->id]) }}'" >料金確認</button> --}}
                    </div>
                    <div class="p-2 w-full mt-2 flex justify-around">
                        <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">変更</button>
                    </div>

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

