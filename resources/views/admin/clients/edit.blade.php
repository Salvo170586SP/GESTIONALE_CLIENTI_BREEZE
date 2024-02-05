<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Dashboard / Clienti / Modifica Cliente') }}
            </h2>
            <a href="{{ route('admin.clients.index') }}" class="flex items-center justify-center  px-5 py-2   text-sm tracking-wide text-white bg-gray-400 rounded-xl shrink-0 sm:w-auto gap-x-2 hover:bg-gray-500 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Torna ai clienti</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center justify-center ">
            <div class="mx-auto w-full bg-white rounded-2xl p-7 border border-slate-200 max-w-[550px]">
                <div class="my-3">
                    @include('admin.partials.errors')
                </div>
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('admin.clients.form')
                    <div class="text-end">
                        <button class="hover:bg-blue-600 rounded-xl bg-blue-500 py-2 text-sm px-5 text-center text-base font-semibold text-white outline-none">
                            modifica
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
