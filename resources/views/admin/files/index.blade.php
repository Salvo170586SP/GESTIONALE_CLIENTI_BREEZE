<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Dashboard / Clienti / Allegati') }}
            </h2>
            <a href="{{ route('admin.clients.index') }}" class="flex items-center justify-center  px-5 py-1   text-sm tracking-wide text-white bg-gray-400 rounded-2xl shrink-0 sm:w-auto gap-x-2 hover:bg-gray-500 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Torna ai clienti</span>
            </a>
        </div>
    </x-slot>


    <!-- component -->
    <section class="container px-4 mx-auto">
        <div class="my-5 flex">
            <h2 class="text-xl me-2">
                File Cliente: {{ Str::upper($client->name_client) }} {{ Str::upper($client->surname_client) }}
            </h2>
            <span class="bg-slate-200 rounded-2xl border border-slate-300 px-5 py-1 text-sm">{{ count($client->files) }} files</span>
        </div>
        <div class="h-[40px]">
            @include('admin.partials.messages')
        </div>
        <div class="py-1">
            @include('admin.partials.errors')
            <form action="{{route('admin.files.store', $client->id)}}" enctype="multipart/form-data" method="post" class="h-[150px] flex items-center  mb-5">
                @csrf
                <div class=" me-5" id="fileInput">
                    <label for="url_file">ALLEGA FILES</label>
                    <input type="file" name="url_file" id="url_file" class="w-full text-sm py-3 text-base font-medium text-[#6B7280]" />
                </div>

                <div style="display: none" id="fileName">
                    <label for="name_file" class="mb-3 block text-base font-medium text-sm">
                        Nome del file
                    </label>
                    <small>(*) campo obbligatorio</small>
                    <input type="text" name="name_file" id="name_file" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    <button class="bg-slate-500 hover:bg-slate-600 text-white px-5 my-2 py-1 rounded-2xl">allega</button>
                </div>
            </form>


            <div class=" flex flex-col  bg-white rounded-2xl p-5 border border-slate-200 shadow">
                <div class="mb-1 flex justify-end">
                    @if(count($client->files) > 1 )




                    <div x-data="{ deleteAllFile: false }">
                        <button @click="deleteAllFile = true" class="px-5 py-1 flex items-center  bg-red-500 text-white transition-colors duration-200 rounded-2xl  hover:bg-red-600 focus:bg-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ms-1">elimina tutti</span>
                        </button>
                        <div x-cloak style="display: none; z-index: 2" x-show="deleteAllFile" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="deleteAllFile = false">
                            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                        </div>
                        <div x-cloak style="display:  none" x-show="deleteAllFile" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
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
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">ATTENZIONE</h3>
                                                <p class="mt-2">QUESTA OPERAZIONE SARA' IRREVERSIBILE. <br>
                                                    SEI SICURO DI ELIMINARE TUTTI I FILE?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                        <form action="{{route('admin.clients.delete_Allfile',$client->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="bg-red-500 text-sm hover:bg-red-600 text-white px-5 py-1 rounded-2xl">elimina tutti</button>
                                        </form>

                                        <button @click="deleteAllFile = false" type="button" class="mt-3 me-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>







                    @endif
                </div>
                <div class="flex ">
                    @forelse($files as $file)
                    <div class="flex flex-col items-center  me-4 ">
                        <div class="flex flex-col items-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <small>{{ $file->name_file }}</small>
                            <small>{{ $file->updated_at }}</small>
                        </div>

                        <form action="{{ route('admin.clients.downloadFile', [$client->id, $file->id]) }}" method="get" class="mb-1">
                            <button class="flex items-center bg-gray-500 text-white rounded-2xl px-5 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </button>
                        </form>

                        <div x-data="{ showModal{{ $file->id }}: false }">
                            <!-- Button to open the modal -->
                            <button @click="showModal{{ $file->id }} = true" class="flex items-center  bg-red-500 text-white rounded-2xl px-5 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            <!-- Background overlay -->
                            <div x-cloak style="display: none" x-show="showModal{{ $file->id }}" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal{{ $file->id }} = false">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <!-- Modal -->
                            <div x-cloak style="display: none" x-show="showModal{{ $file->id }}" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
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
                                                        <p class="text-sm text-gray-500"> Sei sicuro di eliminare il file {{ $file->name_file }}?</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('admin.clients.delete_file', [$client->id, $file->id]) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button class="px-5 py-1 flex items-center  bg-red-600 text-white transition-colors duration-200 rounded-2xl hover:bg-red-500 focus:bg-blue-800">
                                                    <span class="me-2">elimina</span>
                                                </button>
                                            </form>
                                            <button @click="showModal{{ $file->id }} = false" type="button" class="mt-3 me-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> cancel </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-slate-500 w-full">non ci sono allegati</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-app-layout>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlFile = document.getElementById('url_file');
        urlFile.addEventListener('input', function(e) {
            const nameFIle = document.getElementById('fileName');
            const file = urlFile.value;
            console.log(file);
            trueDis = urlFile.disabled = false;
            nameFIle.style.display = file !== '' ? 'block' : 'none';
        });
    })

</script>
