<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="fName" class="mb-3 block text-base text-sm font-medium text-[#07074D]">
                Nome
            </label>
            <input type="text" value="{{ old('name_client', isset($client) ? $client->name_client : '') }}" name="name_client" id="name" class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="lName" class="mb-3 block text-base font-medium text-sm text-[#07074D]">
                Cognome
            </label>
            <input type="text" name="surname_client" value="{{ old('surname_client', isset($client) ? $client->surname_client : '') }}" id="surname" class="w-full rounded-2xl text-sm border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
</div>
<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="date_of_birth" class="mb-3 block text-base font-medium text-sm text-[#07074D]">
                Data di nascita
            </label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', isset($client) ? $client->date_of_birth : '') }}" id="date_of_birth" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="city_of_birth" class="mb-3 block text-base font-medium text-sm text-[#07074D]">
                Città di nascita
            </label>
            <input type="text" name="city_of_birth" id="city_of_birth" value="{{ old('city_of_birth', isset($client) ? $client->city_of_birth : '') }}" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
</div>
<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="address" class="mb-3 block text-sm text-base font-medium text-[#07074D]">
                Indirizzo
            </label>
            <input type="text" name="address" value="{{ old('address', isset($client) ? $client->address : '') }}" id="address" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
    <div class="w-full px-3 sm:w-1/2">
        <div class="mb-5">
            <label for="cap" class="mb-3 text-sm block text-base font-medium text-[#07074D]">
                CAP
            </label>
            <input type="text" name="cap" id="cap" value="{{ old('cap', isset($client) ? $client->cap : '') }}" class="w-full text-sm rounded-2xl border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
    </div>
</div>
<div class="-mx-3 flex flex-wrap">
    <div class="w-full px-3 sm:w-1/2">
        <div class=" me-5" id="fileInput">
            <label for="img_url">ALLEGA FOTO</label>
            <input type="file" name="img_url" id="img_url" class="w-full text-sm py-3 text-base font-medium text-[#6B7280]" />
        </div>
    </div>
     
</div>
