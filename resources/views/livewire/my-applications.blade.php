<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-bold mb-4">Aplicațiile mele</h2>

    @if($applications->isEmpty())
        <p class="text-gray-600">Nu ai aplicat la niciun anunț încă.</p>
    @else
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Titlu Anunț</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Data aplicării</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('ads.show', $app->ad->slug) }}" class="text-blue-600 hover:underline">
                                {{ $app->ad->title }}
                            </a>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $app->created_at->format('d.m.Y H:i') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Poți pune alte butoane, ex: anulare aplicare -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
