<?php

namespace App\Livewire;

use App\Models\Ad;
use App\Models\AdApplication;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class AdShow extends Component
{
    public $ad;
    public $categories = [];
    public $locations = [];
    public $category_id;
    public $location_id;
    public $title;
    public $job_duration_minutes;
    public $people_needed;
    public $reward;
    public $phone_number;
    public $short_description;
    public $full_description;

    public bool $editMode = false;
    public bool $hasApplied = false;

    public function mount($slug)
    {

        $this->ad = Ad::with(['category', 'location', 'applications', 'user'])->where('slug', $slug)->firstOrFail();

        if (Auth::check()) {
            $this->hasApplied = $this->ad->applications->contains('user_id', Auth::id());
        }

        $this->categories = Category::where('is_active', true)->orderBy('name')->get();
        $this->locations = Location::orderBy('name')->get();

        $this->loadCategoriesAndLocations();

        $this->fill([
            'title' => $this->ad->title,
            'category_id' => $this->ad->category_id,
            'location_id' => $this->ad->location_id,
            'short_description' => $this->ad->short_description,
            'full_description' => $this->ad->full_description,
            'people_needed' => $this->ad->people_needed,
            'reward' => $this->ad->reward,
            'job_duration_minutes' => $this->ad->job_duration_minutes,
            'phone_number' => $this->ad->phone_number,
        ]);
    }

    protected function loadCategoriesAndLocations()
    {
        $this->categories = Category::where('is_active', true)->orderBy('name')->get();
        $this->locations = Location::orderBy('name')->get();
    }


    public function apply()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Trebuie sa fii autentificat pentru a aplica.');
            return redirect()->route('login');
        }

        $alreadyApplied = AdApplication::where('ad_id', $this->ad->id)
                        ->where('user_id', Auth::id())
                        ->exists();

        if ($alreadyApplied) {
            session()->flash('message', 'Ai aplicat deja la acest anunt.');
            return;
        }

        AdApplication::create([
            'ad_id' => $this->ad->id,
            'user_id' => Auth::id(),
        ]);

        $this->hasApplied = true;

        $this->ad = $this->ad->fresh('applications');

        session()->flash('message', 'Aplicarea a fost inregistrata cu succes!');

        return redirect('sms:' . $this->ad->phone_number);


    }

    public function toggleResolved()
    {
        if (Auth::id() !== $this->ad->user_id) {
            abort(403, 'Nu ai permisiunea să modifici acest anunț.');
        }

        $this->ad->is_resolved = !$this->ad->is_resolved;
        $this->ad->save();

        session()->flash('message', 'Starea anunțului a fost actualizată.');
    }

    public function toggleEditMode()
    {
        $this->editMode = !$this->editMode;

        if (!$this->editMode) {
            $this->resetEditFields();
        }
    }

    protected function resetEditFields()
    {
        $this->title = $this->ad->title;
        $this->category_id = $this->ad->category_id;
        $this->location_id = $this->ad->location_id;
        $this->job_duration_minutes = $this->ad->job_duration_minutes;
        $this->people_needed = $this->ad->people_needed;
        $this->reward = $this->ad->reward;
        $this->phone_number = $this->ad->phone_number;
        $this->short_description = $this->ad->short_description;
        $this->full_description = $this->ad->full_description;
    }

    public function saveEdit()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'job_duration_minutes' => 'nullable|integer|min:1',
            'people_needed' => 'required|integer|min:1',
            'reward' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
        ]);

        if (Auth::id() !== $this->ad->user_id) {
            abort(403, 'Nu ai permisiunea să editezi acest anunț.');
        }

        $newDuration = (int) $this->job_duration_minutes;

        $this->ad->update([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'location_id' => $this->location_id,
            'job_duration_minutes' => $newDuration,
            'people_needed' => $this->people_needed,
            'reward' => $this->reward,
            'phone_number' => $this->phone_number,
            'short_description' => $this->short_description,
            'full_description' => $this->full_description,
            'expires_at' => now()->addMinutes($newDuration),
        ]);

        $this->ad = $this->ad->fresh();
        $this->editMode = false;

        session()->flash('message', 'Anunțul a fost actualizat cu succes!');
    }


    protected $listeners = ['adUpdated' => 'refreshAd'];

    public function refreshAd()
    {
        $this->ad = $this->ad->fresh();
    }


    public function render()
    {
        $this->loadCategoriesAndLocations();
        return view('livewire.ad-show', ['ad' => $this->ad] );
    }
}
