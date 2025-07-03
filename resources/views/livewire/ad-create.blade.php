<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow-md sm:max-w-md md:max-w-5xl">
   <h1 class="text-2xl font-bold text-gray-900 mb-2">Publica un anunt de ajutor</h1>
    <p class="text-gray-600 mb-6">Completeaza detaliile pentru a-ti posta anuntul rapid si usor.</p>
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="bg-green-100 text-green-800 p-3 rounded mb-6" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label for="title" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-newspaper class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                 Titlu
            </label>
            <input wire:model.defer="title" id="title" type="text" placeholder="Ex: Ajutor la curatenie" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500  transition duration-200 ease-in-out" />
            @error('title') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="category_id" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-tag class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Categorie
            </label>
            <select wire:model.defer="category_id" id="category_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500  transition duration-200 ease-in-out">
                <option value="">Selecteaza categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="location_id" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-map-pin class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Locatie
            </label>
            <select wire:model.defer="location_id" id="location_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                <option value="">Selecteaza locatia</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
            @error('location_id') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="short_description" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-document-text class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Descriere scurta
            </label>
            <textarea wire:model.defer="short_description" id="short_description" rows="2" placeholder="Ex: Ajutor rapid la curatenie"  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"></textarea>
            @error('short_description') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="full_description" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-document-text class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Descriere completa
            </label>
            <textarea wire:model.defer="full_description" id="full_description" rows="4" placeholder="Ex: Am nevoie de ajutor pentru curatenie generala..." class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"></textarea>
            @error('full_description') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="people_needed" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-user-plus class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Numar persoane necesare
            </label>
            <select wire:model.defer="people_needed" id="people_needed" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('people_needed') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="reward" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-face-smile class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Recompensa
            </label>
            <input wire:model.defer="reward" id="reward" type="text" placeholder="ex: 50 lei/o cafea" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" />
            @error('reward') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="job_duration_minutes" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-clock class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Durata estimata
            </label>
            <select wire:model.defer="job_duration_minutes" id="job_duration_minutes" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            @for ($minutes = 30; $minutes <= 240; $minutes += 30)
                <option value="{{ $minutes }}">
                    @if ($minutes < 60)
                        {{ $minutes }} minute
                    @else
                        {{ intdiv($minutes, 60) }} {{ intdiv($minutes, 60) == 1 ? 'ora' : 'ore' }}
                        @php
                            $remaining = $minutes % 60;
                        @endphp
                        @if ($remaining > 0)
                            {{ ' ' . $remaining . ' min' }}
                        @endif
                    @endif
                </option>
            @endfor
            </select>
            @error('job_duration_minutes') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="phone_number" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-device-phone-mobile class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Telefon
            </label>
            <input wire:model.defer="phone_number" id="phone_number" type="text" placeholder="ex: +40742123456" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" />
            @error('phone_number') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center items-center">
        <button type="submit" class="relative bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-4 py-2 rounded-2xl transition duration-150 flex items-center justify-center">
             <x-heroicon-s-plus class="w-5 h-5 mr-2" />
            <span wire:loading.remove>Publica anuntul</span>
            <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </button>
    </div>
    </form>
</div>
