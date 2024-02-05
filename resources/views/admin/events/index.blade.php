<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard / Clienti / Appuntamenti') }} {{ $client->name_client}} {{ $client->surname_client}}
            </h2>
            <a href="{{ route('admin.clients.index') }}"
                class="flex items-center justify-center  px-5 py-2   text-sm tracking-wide text-white bg-gray-400 rounded-xl shrink-0 sm:w-auto gap-x-2 hover:bg-gray-500 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Torna ai clienti</span>
            </a>
        </div>
    </x-slot>

    <div class="py-5">
        <!-- component -->

        @foreach($client->events as $event)
        {{-- MODAL EDIT --}}
        <!-- Background overlay -->
        <div x-cloak style="display: none" id="editModalEventOverlay{{$event->id}}" x-show="showModal"
            class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div x-cloak style="display: none" id="editModalEvent{{$event->id}}" x-show="editModalEvent"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Modal panel -->
                <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal content -->
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline"> Modifica
                                    Appuntamento </h3>
                                <div class="my-5 w-full">
                                    <div class="mt-3">
                                        <label for="title"
                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Titolo</label>
                                        <input type="text" id="title{{$event->id}}" value="{{$event->title}}"
                                            name="title"
                                            class=" title w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    </div>
                                    <div class="mt-3">
                                        <label for="start"
                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Inizio</label>
                                        <input type="datetime-local" name="start"
                                            value="{{$event->start}}" id="start{{$event->id}}"
                                            class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                    </div>
                                    <div class="mt-3">
                                        <label for="end"
                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Fine</label>
                                        <input type="datetime-local" name="end"
                                            value="{{$event->end}}" id="end{{$event->id}}"
                                            class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                    </div>
                                    <div class="pt-5 text-end">
                                        <button id="editModalEventBtnSubmit{{$event->id}}"
                                            class=" mt-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-slate-500 text-base font-medium text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Crea </button>
                                        <button type="button" id="editModalEventBtn{{$event->id}}"
                                            class="mt-3 me-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            cancel </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <section class="container px-12 mx-auto">

            <div class="flex justify-between mb-10">
                <div x-data="{ showModal: false }">
                    <!-- Button to open the modal -->
                    <button @click="showModal = true"
                        class="px-4 py-2 flex items-center  bg-slate-600 text-white transition-colors duration-200 rounded-2xl  hover:bg-slate-500 focus:bg-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        <span class="ms-1">Crea appuntamento</span>
                    </button>
                    <!-- Background overlay -->
                    <div x-cloak style="display: none" x-show="showModal" class="fixed inset-0 transition-opacity"
                        aria-hidden="true" @click="showModal = false">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <!-- Modal -->
                    <div x-cloak style="display: none" x-show="showModal"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="fixed z-10 inset-0 overflow-y-auto" x-cloak>
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Modal panel -->
                            <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <!-- Modal content -->
                                    <div class="sm:flex sm:items-start">
                                        <div
                                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                                Crea Appuntamento </h3>
                                            <div class="my-5 w-full">
                                                <form action="{{route('admin.events.store', $client->id)}}"
                                                    method="POST" class="w-full  ">
                                                    @csrf

                                                    <div class="mt-3">
                                                        <label for="title"
                                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Titolo</label>
                                                        <input type="text" name="title"
                                                            class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="start"
                                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Inizio</label>
                                                        <input type="datetime-local" name="start"
                                                            value='{{ now()->toDateTimeString() }}' id="start"
                                                            class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="end"
                                                            class="mb-2 block text-base text-sm font-medium text-[#07074D]">Fine</label>
                                                        <input type="datetime-local" name="end"
                                                            value='{{ now()->toDateTimeString() }}' id="end"
                                                            class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                                    </div>

                                                    <div class="pt-5 text-end">
                                                        <button type="submit"
                                                            class="mt-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-slate-500 text-base font-medium text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            Crea </button>
                                                        <button @click="showModal = false" type="button"
                                                            class="mt-3 me-3 w-full inline-flex justify-center rounded-2xl border border-gray-300 shadow-sm px-5 py-1 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            cancel </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="text" id="searchInput" placeholder="cerca appuntamento"
                        class="rounded-xl border border-slate-300 text-gray">
                    <button id="searchButton"
                        class="bg-slate-500 hover:bg-slate-600 px-3 py-2 rounded-xl border border-slate-200 hover:border-slate-400 text-white">cerca</button>
                    <button id="reset"
                        class="bg-slate-400 hover:bg-slate-500 px-3 py-2 rounded-xl border border-slate-100 hover:border-slate-400 text-white">reset</button>
                </div>
            </div>

            <div id="calendar" class="text-slate-500" style="z-index: -5"></div>
        </section>
    </div>
</x-app-layout>






<script>
    $.ajaxSetup({
        headers: {
            /*  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), */
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    const calendarEl = document.getElementById('calendar');
    const events = [];
    const client = "<?php echo json_encode($client->id) ?>";

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
        , timeZone: 'UTC'
        , events: `/dashboard/events/${client}/getEvents`
        , dayMaxEvents: true
        , editable: true
        , selectable: true
        , eventResizableFromStart: true
        , locale: 'it',



        eventContent: function(info) {
            let eventTitle = info.event.title;
            const eventElement = document.createElement('div');
            eventElement.style.display = 'inline-flex';
            eventElement.style.width = '100%';
            eventElement.style.justifyContent = 'space-between';
            eventElement.style.border = '1px solid lightgrey';
            eventElement.style.borderRadius = '5px';
            eventElement.style.backgroundColor = '#c4cbd4';
            eventElement.innerHTML = `<span>
                ${eventTitle.slice(0, 10)}...
            </span>
            <div class="flex">
                <span class="spanDelete" title="elimina">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 bg-red-500 text-white p-1  rounded-xl ms-1 border border-slate-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </span>
                <span class="editDelete" title="modifica">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6  bg-blue-500 text-white p-1  rounded-xl ms-1 border border-slate-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </span>
                <span class="editInfo" title="dettagli">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6  bg-blue-500 text-white p-1  rounded-xl ms-1 border border-slate-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
            
                </span>
            </div>`;

            //delete                        
            eventElement.querySelector('.spanDelete').addEventListener('click', function() {
                if (confirm("sei sicuro di eliminare l'evento " + eventTitle + "?")) {

                    const event = info.event.id;
                    console.log(client, event);

                    $.ajax({
                        method: 'DELETE'
                        , url: `/dashboard/events/${client}/${event}/deleteEvent`
                        , success: function(response) {
                            console.log('event eliminato');
                            calendar.refetchEvents();
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });

            //edit
            eventElement.querySelector('.editDelete').addEventListener('click', function() {

                const eventId = info.event.id;
                const editModalEvent = document.getElementById('editModalEvent' + eventId);
                const editModalEventOverlay = document.getElementById('editModalEventOverlay' + eventId);
                const editModalEventBtnClose = document.getElementById('editModalEventBtn' + +eventId);
                const editModalEventBtnSubmits = document.getElementById('editModalEventBtnSubmit' + eventId);

                editModalEventOverlay.style.display = 'block';
                editModalEvent.style.display = 'block';

                /* close modal */
                editModalEventBtnClose.addEventListener('click', function() {
                    editModalEventOverlay.style.display = 'none';
                    editModalEvent.style.display = 'none';
                })

                const titleValue = document.getElementById('title' + eventId);
                const startValue = document.getElementById('start' + eventId);
                const endValue = document.getElementById('end' + eventId);


                editModalEventBtnSubmits.addEventListener('click', function() {

                    $.ajax({
                        method: 'PUT'
                        , url: `/dashboard/events/${client}/${eventId}/updateContent`
                        , data: {
                            title: titleValue.value,
                            start: startValue.value,
                            end: endValue.value
                        }
                        , success: function(response) {
                            editModalEventOverlay.style.display = 'none';
                            editModalEvent.style.display = 'none';
                            calendar.refetchEvents();
                            console.log('titolo aggiornato con successo');
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });

            //info
            eventElement.querySelector('.editInfo').addEventListener('click', function() {
                confirm(eventTitle)
            });

            return {
                domNodes: [eventElement]
            };
        },


        //drag e drop events (update date event)
        eventDrop: function(info) {
            var eventId = info.event.id;
            var newStartDate = info.event.start;
            var newEndDate = info.event.end || newStartDate;
            var newStartDateUTC = newStartDate.toISOString().slice(0, 10);
            var newEndDateUTC = newEndDate.toISOString().slice(0, 10);
            console.log(newStartDateUTC);
            console.log(newEndDateUTC);
            $.ajax({
                method: 'PUT'
                , url: `/dashboard/events/${client}/${eventId}/dateUpdate`
                , data: {
                    start: newStartDateUTC
                    , end: newEndDateUTC
                , }
                , success: function(response) {
                    console.log('spostato con successo');
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    calendar.render();


    /* SEARCH */
    //search events
    document.getElementById('searchButton').addEventListener('click', function() {
        var searchKeyword = document.getElementById('searchInput').value.toLowerCase();
        filterAndDisplayEvent(searchKeyword);
    });
    //search reset
    document.getElementById('reset').addEventListener('click', function() {
        window.location.reload();
    });

    function filterAndDisplayEvent(searchKeyword) {
        $.ajax({
            method: 'GET'
            , url: `/dashboard/events/${client}/search?title=${searchKeyword}`
            , success: function(response) {
                calendar.removeAllEvents();
                console.log('cercato');
                calendar.addEventSource(response);
            }
            , error: function(error) {
                console.log('errore nella ricerca:' + error);
            }
        });
    }

</script>
