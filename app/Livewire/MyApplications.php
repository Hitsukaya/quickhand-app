<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AdApplication;
use Illuminate\Support\Facades\Auth;

class MyApplications extends Component
{
    public function render()
    {
        $applications = AdApplication::with('ad')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.my-applications', compact('applications'));
    }
}
