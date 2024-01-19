<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard / Clienti') }}
        </h2>
    </x-slot>

    <div class="py-5">

        <!-- component -->
        <section class="container   mx-auto">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <span class="bg-slate-200 rounded-2xl border border-slate-300 px-5 py-1 text-sm">{{ count($clients) }} clienti</span>
                    </div>
                </div>
                

                <div class="flex items-center mt-4 gap-x-3">
                    <a href="{{ route('admin.clients.create') }}" class="flex items-center justify-center w-1/2 px-5 py-1  tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-2xl shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Aggiungi Cliente</span>
                    </a>
                </div>
            </div>
            <div class="my-3 h-[50px]">
                @include('admin.partials.messages')
            </div>

            <div class="mt-6 md:flex md:items-center md:justify-between">
                <div class="flex items-center">
                    <form action="{{ route('admin.clients.index') }}" method="get">
                        @csrf
                        <div class="relative flex items-center mt-4 md:mt-0">
                            <span class="absolute">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>

                            <input type="text" placeholder="Cerca cliente per nome" name="search" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-2xl md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5  focus:border-slate-300 focus:ring-blue-200">
                            <button type="submit" class="font-bold text-white rounded-2xl px-5 py-1 bg-gray-500 ms-2 hover:bg-gray-600">cerca</button>
                        </div>
                    </form>
                    <a href="{{ route('admin.clients.index') }}" class="font-bold text-white rounded-2xl px-5 py-1 bg-red-500 ms-2 hover:bg-red-600" type="submit">Reset</a>
                </div>
            </div>

            @if(count($clients) > 0)
            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 md:rounded-2xl bg-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">

                                        </th>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Nome
                                        </th>
                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Cognome
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Data di nascita
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">Città di nascita</th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">Indirizzo</th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">Cap</th>
                                        
                                        <th scope="col" class="relative py-3.5 px-4">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($clients as $client)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                            <form action="{{ route('admin.clients.changeClientPosition', $client->id)}}" method="get">
                                                @csrf
                                                <input type="number" value="{{$client->position}}" class="rounded-2xl py-1 border border-slate-300" max="{{count($clients)}}" min="1" name="new_position">
                                                <button class="bg-gray-600 rounded-2xl py-1 px-5 text-white">sposta</button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                            {{Str::upper($client->name_client)}}
                                        </td>
                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            {{Str::upper($client->surname_client)}}
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            {{ $client->date_of_birth ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            {{ $client->city_of_birth ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            {{ $client->address ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            {{ $client->cap ?? '-' }}
                                        </td>
                                          
 
                                        <td class="px-4 py-4  whitespace-nowrap">
                                            <div class="flex ">
                                                <a class="bg-slate-600 flex items-center  me-2 justify-between px-4 py-1 text-white rounded-2xl" href="{{ route('admin.files.index', [$client->id] )}}">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                        </svg>
                                                        <small class="mx-2">
                                                            allegati
                                                        </small>
                                                    </div>
                                                    <small class="bg-slate-500 border border-slate-300   text-black rounded-full flex items-center justify-center  h-[20px] w-[20px] text-slate-100 ">{{ count($client->files)}}</small>
                                                </a>
                                      
                                                <a class="bg-slate-600 flex items-center me-2 justify-between px-4 py-1 text-white rounded-2xl" href="{{route('admin.notes.index', $client->id)}}">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        <small class="mx-2">
                                                            note
                                                        </small>
                                                    </div>
                                                    <small class="bg-slate-500 border border-slate-300  text-black rounded-full flex items-center justify-center  h-[20px] w-[20px] text-slate-100 ">{{ count($client->notes)}}</small>
                                                </a>
                                                <a href="{{ route('admin.clients.show', $client->id) }}" class="px-4 py-1 me-2 flex items-center bg-blue-600 text-white transition-colors duration-200 rounded-2xl  hover:bg-blue-500 focus:bg-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <span class="ms-1">dettagli</span>
                                                </a>
                                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="px-4 py-1 me-2 flex items-center bg-gray-600 text-white transition-colors duration-200 rounded-2xl  hover:bg-gray-500 focus:bg-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                    <span class="ms-1">modifica</span>
                                                </a>
                                                <div x-data="{ showModal{{ $client->id }}: false }">
                                                    <!-- Button to open the modal -->
                                                    <button @click="showModal{{ $client->id }} = true" class="px-4 py-1 flex items-center  bg-red-600 text-white transition-colors duration-200 rounded-2xl  hover:bg-red-500 focus:bg-blue-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                        <span class="ms-1">elimina</span>
                                                    </button>
                                                    <!-- Background overlay -->
                                                    <div x-cloak style="display: none" x-show="showModal{{ $client->id }}" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal{{ $client->id }} = false">
                                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div x-cloak style="display: none" x-show="showModal{{ $client->id }}" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
                                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                            <!-- Modal panel -->
                                                            <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                    <!-- Modal content -->
                                                                    <div class="sm:flex sm:items-start">
                                                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                            <!-- Heroicon name: outline/exclamation -->
                                                                            <svg width="64px" height="64px" class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#ef4444" stroke-width="0.45600000000000007">
                                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="#ef4444"></path>
                                                                                    <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#ef4444"></path>
                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.2944 4.47643C9.36631 3.11493 10.5018 2.25 12 2.25C13.4981 2.25 14.6336 3.11493 15.7056 4.47643C16.7598 5.81544 17.8769 7.79622 19.3063 10.3305L19.7418 11.1027C20.9234 13.1976 21.8566 14.8523 22.3468 16.1804C22.8478 17.5376 22.9668 18.7699 22.209 19.8569C21.4736 20.9118 20.2466 21.3434 18.6991 21.5471C17.1576 21.75 15.0845 21.75 12.4248 21.75H11.5752C8.91552 21.75 6.84239 21.75 5.30082 21.5471C3.75331 21.3434 2.52637 20.9118 1.79099 19.8569C1.03318 18.7699 1.15218 17.5376 1.65314 16.1804C2.14334 14.8523 3.07658 13.1977 4.25818 11.1027L4.69361 10.3307C6.123 7.79629 7.24019 5.81547 8.2944 4.47643ZM9.47297 5.40432C8.49896 6.64148 7.43704 8.51988 5.96495 11.1299L5.60129 11.7747C4.37507 13.9488 3.50368 15.4986 3.06034 16.6998C2.6227 17.8855 2.68338 18.5141 3.02148 18.9991C3.38202 19.5163 4.05873 19.8706 5.49659 20.0599C6.92858 20.2484 8.9026 20.25 11.6363 20.25H12.3636C15.0974 20.25 17.0714 20.2484 18.5034 20.0599C19.9412 19.8706 20.6179 19.5163 20.9785 18.9991C21.3166 18.5141 21.3773 17.8855 20.9396 16.6998C20.4963 15.4986 19.6249 13.9488 18.3987 11.7747L18.035 11.1299C16.5629 8.51987 15.501 6.64148 14.527 5.40431C13.562 4.17865 12.8126 3.75 12 3.75C11.1874 3.75 10.4379 4.17865 9.47297 5.40432Z" fill="#ef4444"></path>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Attenzione </h3>
                                                                            <div class="mt-2">
                                                                                <p class="text-sm text-gray-500"> Sei sicuro di eliminare {{Str::upper($client->name_client)}} {{Str::upper($client->surname_client)}}?</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('delete')

                                                                        <button class="px-5 py-1 flex items-center  bg-red-600 text-white transition-colors duration-200 rounded-2xl hover:bg-red-500 focus:bg-blue-800">
                                                                            <span class="me-2">elimina</span>
                                                                        </button>
                                                                    </form>
                                                                    <button @click="showModal{{ $client->id }} = false" type="button" class="mt-3 me-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> cancel </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                @if($clients instanceof \Illuminate\Pagination\LengthAwarePaginator && $clients->hasPages())
                {{ $clients->links() }}
                @else

                @endif
            </div>
            @else
            <div class="w-full my-10 text-center">Non ci sono clienti in lista</div>
            @endif

            {{-- <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span>
                </div>

                <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                    <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>

                        <span>
                            previous
                        </span>
                    </a>

                    <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                        <span>
                            Next
                        </span>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div> --}}
        </section>

    </div>
</x-app-layout>
