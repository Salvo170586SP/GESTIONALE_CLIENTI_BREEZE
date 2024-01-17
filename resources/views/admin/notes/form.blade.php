<div class="-mx-3 flex flex-wrap ">
    <div class="w-full px-3  ">
        <div class="mb-5 w-full">
            <label for="title" class="mb-3 block text-base text-sm font-medium text-[#07074D]">
                Titolo
            </label>
            <input type="text" value="{{ old('title', isset($note) ? $note->title : '') }}" name="title" id="title" class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
</div>

<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3  ">
        <div class="mb-5">
            <label for="description" class="mb-3 text-sm block text-base font-medium text-[#07074D]">
                Descrizione
            </label>
            <textarea type="text" name="description" id="description" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ old('cap', isset($note) ? $note->description : '') }}</textarea>
        </div>
    </div>
</div>
<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3">
        <div class="mb-3">
            Prenota per:
        </div>
        <div class="mb-5 flex flex-wrap">
            @foreach($months as $m)
            <div class="flex mb-4">
                 <input type="checkbox" value="{{ $m->id }}" name="months[]" id="month_id-{{ $m->id }}" class="month cursor-pointer border border-slate-300 text-base font-medium rounded-2xl" @if(isset($current_month) && in_array($m->id, $current_month)) checked @endif />
                <label for="month_id-{{ $m->id }}" class="ms-2 me-7 block cursor-pointer text-base font-medium text-sm">
                    {{ $m->name_month }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>