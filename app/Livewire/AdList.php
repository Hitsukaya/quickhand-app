<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Location;

class AdList extends Component
{
    use WithPagination;

    public $filterCategory = '';
    public $filterLocation = '';
    public $search = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterLocation() { $this->resetPage(); }


    protected $paginationTheme = 'tailwind';

    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }
    // public function updatingFilterCategory()
    // {
    //     $this->resetPage();
    // }
    // public function updatingFilterLocation()
    // {
    //     $this->resetPage();
    // }

    public function render()
    {
        $categories = Category::all();
        $locations = Location::all();

        $query = Ad::query();
        $query = Ad::with('user');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        if ($this->filterLocation) {
            $query->where('location_id', $this->filterLocation);
        }

        $ads = $query->orderBy('posted_at', 'desc')->paginate(10);

        return view('livewire.ad-list', compact('ads', 'categories', 'locations'));
    }
}
