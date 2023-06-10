<div class="flex justify-center rounded-lg">
    <div x-data="{
        open: false,
        toggle() {
            if (this.open) {
                return this.close()
            }
    
            this.$refs.button.focus()
    
            this.open = true
        },
        close(focusAfter) {
            if (!this.open) return
    
            this.open = false
    
            focusAfter && focusAfter.focus()
        }
    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
        <!-- Button -->
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="text-on-surface-600 active:translate-y-1 flex flex-row justify-center items-center bg-surface-800 p-4 rounded">
            @isset($title)
                <span class="mr-2 text-on-surface-100">{{ $title }}</span> 
            @endisset
            <span class="text-on-surface-100">@includeIf('components/icons/' . ($icon ?? ''))</span>
        </button>

        <!-- Panel -->
        <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')" style="display: none;"
            class="absolute right-0 rounded-lg bg-surface-900 shardow-xl w-max shadow-lg z-10 p-3">
            {{ $slot }}
        </div>
    </div>
</div>
