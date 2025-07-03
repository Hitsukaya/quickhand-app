<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Ad;

class CategoryAds extends Component
{
    use WithPagination;

    public $category;

    protected $paginationTheme = 'tailwind';

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $ads = Ad::where('category_id', $this->category->id)
                 ->orderBy('posted_at', 'desc')
                 ->paginate(10);

        return view('livewire.category-ads', [
            'ads' => $ads,
            'category' => $this->category,
        ]);
    }
}
