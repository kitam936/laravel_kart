<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Engine Category詳細
        </h2>

        <div class="flex">
        <form>
            <div class="md:flex md:ml-20">
            <x-input type="hidden" id="category_id" name="category_id" value="{{ $category->id }}"/>

            <div class="ml-2 ">
                <button type="button" class="w-32 h-8 text-sm bg-indigo-500 text-white ml-0 hover:bg-indigo-600 rounded" onclick="location.href='{{ route('category_index') }}'" >Category List</button>
            </div>

            </div>
        </form>
        <div class="flex ">
            <div class=" w-1/2 mt-0 flex md:ml-60">
                <div class="md:ml-2 md:ml-4">
                    <button type="button" class="w-32 h-8 text-sm bg-green-500 text-white ml-2 hover:bg-green-600 rounded" onclick="location.href='{{ route('eg_category_edit',['category'=>$category->id])}}'" >編集</button>
                </div>
            <form id="delete_{{$category->id}}" method="POST" action="{{ route('eg_category_destroy',['category'=>$category->id]) }}">

                @csrf
                <div class="ml-0 mt-0 md:ml-4 md:mt-0">
                    <div class="w-32 h-8 bg-red-500  text-sm text-white pt-1 ml-2 hover:bg-red-600 rounded text-center">
                    <a href="#" data-id="{{ $category->id }}" onclick="deletePost(this)" >削除</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">

            <div CLASS="mb-2 max-w-2xl mx-auto">

                <x-validation-errors class="mb-4" />

            {{-- @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif --}}

            <x-flash-message status="session('status')"/>

            <div class="">
                <div>
                    <div class="relative w-24 ml-2 ">
                        <x-label for="id" value="カテゴリーID" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="id" name="id"  value="{{ $category->id }}">{{ $category->id  }}
                        </div>
                    </div>
                    <div class="relative w-full md:w-2/3 ml-2 ">
                        <x-label for="maint_name" value="カテゴリー名" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="maint_name" name="maint_name"  value="{{ $category->eg_maint_name }}">{{ $category->eg_maint_name  }}
                        </div>
                    </div>
                    <div class="relative w-full md:w-2/3 ml-2 ">
                        <x-label for="category_info" value="カテゴリー情報" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="category_info" name="category_info"  value="{{ $category->eg_maint_category_info }}">{{ $category->eg_maint_category_info  }}
                        </div>
                    </div>
                    <div class="relative w-24 ml-2 ">
                        <x-label for="sort_order" value="並び順" class="mt-1"/>
                        <div class="pl-2 w-full h-6 text-sm items-center bg-gray-100 border rounded" id="sort_order" name="sort_order"  value="{{ $category->sort_order }}">{{ $category->sort_order  }}
                        </div>
                    </div>

                </div>

            </div>

            </div>


            </form>
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

