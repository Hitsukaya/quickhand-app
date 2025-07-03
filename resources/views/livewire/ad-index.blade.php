<div wire:poll.1s>
    <div class="relative">
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1470&q=80"
             alt="Background"
             class="w-full h-72 object-cover opacity-70" />
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
            <h1 class="text-white text-4xl font-extrabold drop-shadow-lg mb-3 max-w-3xl w-full">
                Caută anunțuri de ajutor
            </h1>
            <p class="text-white text-lg drop-shadow-md mb-6 max-w-2xl w-full">
                Găsește rapid și ușor anunțuri utile pentru tine
            </p>

            <input input type="text" wire:model.debounce.500ms="search" wire:keyup="$refresh" placeholder="Caută anunțuri" class="w-full max-w-3xl px-6 py-3 text-center rounded-lg border border-white bg-white bg-opacity-90 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />

            <div class="flex space-x-4 mt-4 w-full max-w-3xl">
                <div class="relative w-1/2">
                    <select wire:model="filterCategory" wire:change="$refresh" id="filterCategory"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Toate categoriile</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <div class="relative w-1/2">
                    <select wire:model="filterLocation" wire:change="$refresh" id="filterLocation"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 pr-10 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Toate locațiile</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="z-20 relative px-4 py-8 max-w-7xl mx-auto">
        @if ($ads->count())
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-2 sm:gap-x-2 md:gap-x-2 lg:gap-x-2">
                @foreach ($ads as $ad)
                    <li class="border border-gray-200 bg-white p-5 rounded shadow hover:shadow-lg transition">
                        <a href="{{ route('ads.show', $ad->slug) }}" class="text-blue-700 text-lg font-semibold hover:underline">
                            {{ $ad->title }}

                            @if ($ad->is_resolved)
                                <span class="ml-2 inline-block bg-green-200 text-green-800 px-2 py-1 rounded text-xs">✅ Rezolvat</span>
                            @elseif($ad->is_expired)
                                <span class="ml-2 inline-block bg-red-200 text-red-800 px-2 py-1 rounded text-xs">⏰ Expirat</span>
                            @else
                                <span class="ml-2 inline-block bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">🟢 Activ</span>
                            @endif
                        </a>

                        <div>
                            @if ($ad->expires_at && !$ad->is_expired)
                            <p class="text-sm text-red-600 mt-1">
                                Expiră în: {{ \Carbon\Carbon::now()->diffForHumans($ad->expires_at, ['short' => true, 'parts' => 2]) }}
                            </p>
                            @endif
                        </div>

                        <div class="inline-flex gap-x-2">
                        <p class="text-sm text-gray-500 mt-1 inline-flex gap-x-2">
                            <svg class="w-4 h-4" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none"><g transform="translate(16 16)"><circle cx="80" cy="80" r="74" style="fill:none;stroke:#000000;stroke-width:12;stroke-linejoin:round;stroke-opacity:1"/><path d="M80 30v50l40 32" style="fill:none;stroke:#000000;stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-opacity:1"/></g></svg>
                            {{ $ad->posted_at->format('d-m-Y') }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1">Postat de: <strong>{{ $ad->user->name ?? 'Utilizator necunoscut' }}</strong></p>
                        </div>

                        <p class="text-gray-700 mt-2">{{ $ad->short_description }}</p>
                        <div class="inline-flex gap-x-2">
                        <p class="text-sm text-gray-600 mt-1">Categoria: <strong>{{ $ad->category->name ?? 'Nedefinită' }}</strong></p>
                        <p class="text-sm text-gray-600 mt-1">Locația: <strong>{{ $ad->location->name ?? 'Nedefinită' }}</strong></p>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-8">
                {{ $ads->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 mt-10 text-lg">Nu există anunțuri care să corespundă căutării.</p>
        @endif
    </div>
</div>

