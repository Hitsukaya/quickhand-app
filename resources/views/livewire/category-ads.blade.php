<div class="max-w-7xl mx-auto px-4 py-8" wire:poll.1s>
    <h1 class="text-3xl font-bold mb-6">Anunțuri din categoria: {{ $category->name }}</h1>

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
                        <p class="text-sm text-gray-600 mt-1">Categoria:<strong>
                        <a href="{{ route('categories.show', $ad->category->id) }}" class="text-indigo-600 hover:underline">
                            {{ $ad->category->name ?? 'Nedefinită' }}
                        </a></strong></p>
                        <p class="text-sm text-gray-600 mt-1">Locația:<strong>
                        <a href="{{ route('locations.show', $ad->location->id) }}" class="text-indigo-600 hover:underline">
                            {{ $ad->location->name ?? 'Nedefinită' }}
                        </a></strong></p>
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
