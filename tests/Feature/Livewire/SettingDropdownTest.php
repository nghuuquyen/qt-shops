<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\SettingDropdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SettingDropdownTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SettingDropdown::class);

        $component->assertStatus(200);
    }
}
