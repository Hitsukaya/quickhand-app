<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-3xl font-bold mb-4">
        @if($editMode)
                    <label for="title" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-newspaper class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                 Titlu
            </label>
            <input
                type="text"
                wire:model.defer="title"
                class="w-full border rounded px-3 py-2"
                placeholder="Titlu anunț"
            />
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        @else
            {{ $ad->title }}
        @endif

        @if ($ad->is_resolved)
            <span class="inline-block bg-green-200 text-green-800 px-2 py-1 rounded text-xs">✅ Rezolvat</span>
        @elseif($ad->is_expired)
            <span class="inline-block bg-red-200 text-red-800 px-2 py-1 rounded text-xs">⏰ Expirat/Nerezolvat</span>
        @else
            <span class="inline-block bg-green-200 text-green-800 px-2 py-1 rounded text-xs">🟢 Activ</span>
        @endif
    </h1>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($editMode)
        <div class="mb-4">
            <label for="category_id" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-tag class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Categorie
            </label>
            <select wire:model.defer="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Selectează categorie</option>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        </div>

        <div class="mb-4">
            <label for="location_id" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-map-pin class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Locatie
            </label>
              <select wire:model.defer="location_id" class="w-full border rounded px-3 py-2">
                <option value="">Nespecificată</option>
                @foreach(\App\Models\Location::all() as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
            @error('location_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        </div>

        <div class="mb-4">
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

        <div class="mb-4">
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

        <div class="mb-4">
            <label for="reward" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-face-smile class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Recompensa
            </label>
            <input wire:model.defer="reward" id="reward" type="text" placeholder="ex: 50 lei/o cafea" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" />
            @error('reward') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-device-phone-mobile class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Telefon
            </label>
            <input wire:model.defer="phone_number" id="phone_number" type="text" placeholder="ex: +40742123456" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" />
            @error('phone_number') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="short_description" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-document-text class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Descriere scurta
            </label>
            <textarea wire:model.defer="short_description" id="short_description" rows="2" placeholder="Ex: Ajutor rapid la curatenie"  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"></textarea>
            @error('short_description') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="full_description" class="block font-medium text-gray-700 mb-1">
                <x-heroicon-o-document-text class="w-5 h-5 mr-1 text-gray-400 inline-flex" />
                Descriere completa
            </label>
            <textarea wire:model.defer="full_description" id="full_description" rows="4" placeholder="Ex: Am nevoie de ajutor pentru curatenie generala..." class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"></textarea>
            @error('full_description') <span class="text-red-600 text-xs italic mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button wire:click="saveEdit" class="relative bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-4 py-2 rounded-2xl transition duration-150 flex items-center justify-center">
            <x-heroicon-s-plus class="w-5 h-5 mr-2" />
            <span wire:loading.remove>Salvează modificările</span>
              <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            </button>

            <button wire:click="toggleEditMode" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Anulează
            </button>
        </div>

    @else

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 font-sans space-y-5">
  <div class="flex items-center space-x-3 text-gray-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <rect x="3" y="4" width="18" height="16" rx="2" ry="2" />
      <path d="M3 10h18" />
    </svg>
    <span class="font-semibold">Categorie:</span>
    <span class="text-gray-600">
        <a href="{{ route('categories.show', $ad->category->id) }}" class="text-indigo-600 hover:underline">
            {{ $ad->category->name ?? 'Nedefinită' }}
        </a>
    </span>
  </div>

  <div class="flex items-center space-x-3 text-gray-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linejoin="round" stroke-linecap="round" d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z"/>
      <path stroke-linejoin="round" stroke-linecap="round" d="M12 22s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/>
    </svg>
    <span class="font-semibold">Locație:</span>
    <span class="text-gray-600">
        <a href="{{ route('locations.show', $ad->location->id) }}" class="text-indigo-600 hover:underline">
            {{ $ad->location->name ?? 'Nedefinită' }}
        </a>
    </span>
  </div>

  <div class="flex items-center space-x-3 text-gray-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="12" r="10" />
      <path stroke-linejoin="round" stroke-linecap="round" d="M12 6v6l4 2" />
    </svg>
    <span class="font-semibold">Durata estimată:</span>
    <span id="countdown" class="text-gray-600 font-mono"></span>
            <script>
                const expiresAt = new Date("{{ $ad->expires_at->toISOString() }}").getTime();

                function updateCountdown() {
                    const now = Date.now();
                    const distance = expiresAt - now;
                    const countdownEl = document.getElementById('countdown');

                    if (distance <= 0) {
                    countdownEl.innerText = 'Anunț expirat';
                    clearInterval(timerInterval);
                    return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    let timeStr = '';
                    if (days > 0) timeStr += `${days} zi${days > 1 ? 'e' : ''} `;
                    if (hours > 0) timeStr += `${hours} oră${hours > 1 ? 'e' : ''} `;
                    if (minutes > 0) timeStr += `${minutes} minut${minutes > 1 ? 'e' : ''} `;
                    timeStr += `${seconds} secund${seconds > 1 ? 'e' : 'ă'}`;

                    countdownEl.innerText = timeStr;
                }

                updateCountdown();
                const timerInterval = setInterval(updateCountdown, 1000);
        </script>
  </div>

  <div class="flex items-center space-x-3 text-gray-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M17 20h5v-2a4 4 0 0 0-3-3.87" />
      <path d="M9 20H4v-2a4 4 0 0 1 3-3.87" />
      <circle cx="12" cy="7" r="4" />
    </svg>
    <span class="font-semibold">Persoane necesare:</span>
    <span class="text-gray-600">{{ $ad->people_needed }}</span>
  </div>

  <div class="flex items-center space-x-3 text-gray-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M12 8c-1.1 0-2 .9-2 2 0 1.104.9 2 2 2s2-.896 2-2-.9-2-2-2z" />
      <path d="M12 2v3m0 14v3m9-9h-3m-14 0H2m15.364-7.364l-2.121 2.121M6.757 17.243l-2.121 2.121m12.02 0l2.121-2.121M6.757 6.757l2.121-2.121" />
    </svg>
    <span class="font-semibold">Recompensă:</span>
    <span class="text-gray-600">{{ $ad->reward ?? 'Nespecificată' }}</span>
  </div>

  <div class="border-t pt-4 text-gray-700 whitespace-pre-line">
    <h4 class="text-lg font-semibold mb-2 text-gray-900">Descriere completă</h4>
    <p>{!! nl2br(e($ad->full_description)) !!}</p>
  </div>

  <button
    wire:click="apply"
    @if ($hasApplied || $ad->isFull())
      disabled class="opacity-50 cursor-not-allowed"
    @endif
    class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition"
  >
    @if ($hasApplied)
      Ai aplicat deja
    @elseif ($ad->isFull())
      Număr maxim atins
    @else
      Aplică la acest anunț
    @endif
  </button>
<br>
<div class="inline-flex gap-x-2">
    <p class="text-sm text-gray-500 mt-1 inline-flex gap-x-2">
    <svg class="w-4 h-4" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none"><g transform="translate(16 16)"><circle cx="80" cy="80" r="74" style="fill:none;stroke:#000000;stroke-width:12;stroke-linejoin:round;stroke-opacity:1"/><path d="M80 30v50l40 32" style="fill:none;stroke:#000000;stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1"/></g></svg>
    {{ $ad->posted_at->format('d-m-Y') }}
    </p>
    <p class="text-sm text-gray-600 mt-1 inline-flex">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.674 0 5.151.77 7.121 2.076M12 12a5 5 0 100-10 5 5 0 000 10z" />
    </svg>
    <strong>{{ $ad->user->name ?? 'Utilizator necunoscut' }}</strong></p>
</div>
<br>

  <a href="{{ route('ads.index') }}" class="inline-block mt-2 text-blue-600 hover:underline font-semibold">
    &larr; Înapoi la lista de anunțuri
  </a>

  @if(auth()->id() === $ad->user_id)
<div class="mt-6 flex gap-3">
  <button wire:click="toggleResolved" class="flex items-center gap-2 px-4 py-2 rounded-xl font-semibold transition
      {{ $ad->is_resolved
          ? 'bg-gray-600 hover:bg-gray-700 text-white'
          : 'bg-green-600 hover:bg-green-700 text-white' }}">
    @if ($ad->is_resolved)
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
      </svg>
      Marchează ca nerezolvat
    @else
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5 13l4 4L19 7" />
      </svg>
      Marchează ca rezolvat
    @endif
  </button>

  <button wire:click="toggleEditMode" class="flex items-center gap-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-semibold transition">
    <x-heroicon-s-pencil-square class="w-5 h-5 mr-2" />
    <span wire:loading.remove>Editează anunț</span>
    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
  </button>
</div>

  @endif
</div>
    @endif
</div>
