<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;
use App\Models\Ad;

class LocationAds extends Component
{
    use WithPagination;

    public $location;

    protected $paginationTheme = 'tailwind';

    public function mount(Location $location)
    {
        $this->location = $location;
    }

    public function render()
    {
        $ads = Ad::where('location_id', $this->location->id)
                 ->orderBy('posted_at', 'desc')
                 ->paginate(10);

        return view('livewire.location-ads', [
            'ads' => $ads,
            'location' => $this->location,
        ]);
    }
}
