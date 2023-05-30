<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\BrowserEvent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SettingDropdown extends Component
{
    public $theme;

    public $locale;

    public function mount()
    {
        $this->theme = Session::get('theme', 'auto');

        $this->locale = App::currentLocale();
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;

        Session::put('locale', $locale);
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;

        Session::put('theme', $theme);

        $this->dispatchBrowserEvent(BrowserEvent::THEME_CHANGED, [ 'theme' => $theme ]);
    }

    public function render()
    {
        return view('livewire.setting-dropdown');
    }
}
