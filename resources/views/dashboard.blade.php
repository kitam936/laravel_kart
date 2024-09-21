<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="ml-00 mt-2 md:ml-4 md:mt-0">
            <button type="button" class="w-40 h-8 text-sm bg-green-500 text-white ml-12 md:ml-40 hover:bg-green-600 rounded" onclick="location.href='{{ route('manual_download') }}'" >マニュアルＤＬ</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-indigo-600 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="text-indigo-600">
                Kart Meeting にようこそ！
                <br>
                <br>
                上部タブからMenu選択してください。
                </div>
                <br>
                <br>
                <br>
                <div class="bg-white text-red-600 text-sm">
                ※居住エリア・自己紹介等のコメント・画像等の登録はお済みでしょうか？<br>
                　まだの方は　MyAccount⇒編集　から登録をお願いします。
                </div>
        </div>
                <br>
                <br>
                <div class="bg-white text-sm">
                このサイトに関するお問い合わせは　kart_meeting@ktm936.com　までお願いします。
                </div>
    </div>
</x-app-layout>
