<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;

class AdCreate extends Component
{
    public $title;
    public $category_id;
    public $location_id;
    public $short_description;
    public $full_description;
    public $people_needed = 1;
    public $reward;
    public $job_duration_minutes = 30;
    public $phone_number;

    public $categories = [];
    public $locations = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'location_id' => 'nullable|exists:locations,id',
        'short_description' => 'nullable|string|max:500',
        'full_description' => 'nullable|string',
        'people_needed' => 'required|integer|min:1|max:20',
        'reward' => 'nullable|string|max:100',
        'job_duration_minutes' => 'required|integer|min:10|max:720',
        'phone_number' => 'required|string|max:20',
    ];

    public function mount()
    {
        $this->categories = Category::where('is_active', true)->orderBy('name')->get();
        $this->locations = Location::orderBy('name')->get();
    }

    public function submit()
    {

     if (!auth()->check()) {
        session()->flash('error', 'Trebuie sa fii autentificat pentru a crea un anunt.');
        return redirect()->route('login');
        }
        $this->validate();
        
        $duration = (int) $this->job_duration_minutes;

        $ad = Ad::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'short_description' => $this->short_description,
            'full_description' => $this->full_description,
            'people_needed' => $this->people_needed,
            'reward' => $this->reward,
            'job_duration_minutes' => $this->job_duration_minutes,
            //'expires_at' => now()->addMinutes($this->job_duration_minutes),
            //'expires_at' => now()->addMinutes((int) $this->job_duration_minutes),
            'expires_at' => now()->addMinutes($duration),
            'phone_number' => $this->phone_number,
            'posted_at' => now(),
        ]);

        session()->flash('message', 'Anuntul a fost creat cu succes!');

        $this->reset(['title', 'category_id', 'location_id', 'short_description', 'full_description', 'people_needed', 'reward', 'job_duration_minutes', 'phone_number']);
    }

    public function render()
    {
        return view('livewire.ad-create');
    }
}
