<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\BrowserEvent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SettingDropdown extends Component
{
    public function render()
    {
        return view('livewire.setting-dropdown');
    }

    public function setLanguage($locale)
    {
        Session::put('locale', $locale);
    }
}
