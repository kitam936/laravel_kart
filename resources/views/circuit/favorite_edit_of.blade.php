<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        　ホームコース解除
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-2 mx-auto">
                        <div class="flex flex-col text-center w-full mb-0">
                            <h3 class="sm:text-3xl text-2xl font-medium title-font mb-0 text-red-600">ホームコースを解除しますか？</h3>
                        </div>
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            {{-- <x-input-error2 :messages="$errors->get('email')" class="mt-2" /> --}}

                            <form method="post" action="{{ route('favorite_destroy',['id'=>$favorite->id]) }}">
                            {{-- @method('put') --}}
                            @csrf


                            <div class="p-2 w-full mx-auto">
                                <div class="relative ">
                                <label for="name" class="w-full leading-7 text-sm text-gray-600">サーキット名</label>
                                <div type="text" id="cir_name" name="cir_name" value="{{ $circuit->cir_name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $circuit->cir_name }}
                                </div>
                                <input type="hidden" id="cir_id" name="cir_id" value="{{ $circuit->id }}" />
                                </div>


                                <div class="p-2 w-full mt-2 flex justify-around">
                                <button type="button" onclick="location.href='{{ route('circuit_detail',['circuit'=>$circuit->id]) }}'" class="h-8 w-32 text-black bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-sm">戻る</button>
                                <button type="submit" class="h-8 w-32 text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-sm">解除</button>
                                </div>
                            </div>
                            {{-- </div> --}}
                            </form>
                        </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
