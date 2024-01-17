<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Dashboard / Clienti / Dettagli') }}
            </h2>
            <a href="{{ route('admin.clients.index') }}" class="flex items-center justify-center  px-5 py-1   text-sm tracking-wide text-white bg-gray-400 rounded-2xl shrink-0 sm:w-auto gap-x-2 hover:bg-gray-500 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Torna ai clienti</span>
            </a>
        </div>
    </x-slot>

    <div class="py-20">
        <!-- component -->
        <div class="flex items-center justify-center ">
            <div class="mx-auto w-full relative bg-white rounded-2xl px-12 py-20 border border-slate-200 max-w-[550px]">
                @if($client->img_url)
                <figure class="absolute top-[-35px] h-[90px] w-[90px]">
                    <img class=" rounded-2xl shadow-lg h-full w-full object-cover" src="{{asset('/storage/'. $client->img_url)}}" alt="img-{{$client->name_client}}_{{$client->surname_client}}">
                </figure>
                @else
                <figure class="absolute top-[-35px] h-[90px] w-[90px]">
                    <img class=" rounded-2xl shadow-lg h-full w-full object-cover" src="https://cdn.vectorstock.com/i/preview-1x/77/30/default-avatar-profile-icon-grey-photo-placeholder-vector-17317730.jpg" alt="placeholder">
                </figure>
                @endif
                <div>
                    <ul>
                        <li>
                            <h2 class="text-3xl mb-10">{{Str::upper($client->name_client)}} {{Str::upper($client->surname_client)}}</h2>
                        </li>
                        <li>
                            <p class=" mb-3">Data di nascita: {{ $client->date_of_birth ?? '-' }} </p>
                        </li>
                        <li>
                            <p class=" mb-3">Città di nascita: {{ $client->city_of_birth ?? '-' }} </p>
                        </li>
                        <li>
                            <p class=" mb-3">Indirizzo: {{ $client->address ?? '-' }} , {{ $client->cap ?? '-' }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
