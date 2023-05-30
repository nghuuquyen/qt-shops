<div class="flex justify-center absolute right-12 top-4 z-50 rounded-lg">
    <div
        x-data="{
            open: false,
            selectedTheme: @entangle('theme'),
            selectedLocale: @entangle('locale'),
            toggle() {
                if (this.open) {
                    return this.close()
                }
 
                this.$refs.button.focus()
 
                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return
 
                this.open = false
 
                focusAfter && focusAfter.focus()
            },
            async setLocale(locale) {
                await $wire.setLocale(locale)

                location.reload()
            },
            async setTheme(targetTheme) {
                await $wire.setTheme(targetTheme)
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative"
    >
        <!-- Button -->
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="text-on-surface-600 active:translate-y-1"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>              
        </button>
 
        <!-- Panel -->
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute right-0 rounded-lg bg-surface shardow-xl w-52 shadow-lg"
        >
            <div class="text-on-surface-500 p-3">
                {{ __('Themes') }}
            </div>

            <a @click="setTheme('theme-light')" :class="selectedTheme == 'theme-light' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                </svg>
                  
                <span class="ml-4">{{ __('Light') }}</span>
            </a>
    
            <a @click="setTheme('theme-dark')" :class="selectedTheme == 'theme-dark' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                </svg>
              
                <span class="ml-4">{{ __('Dark') }}</span>
            </a>

            <a @click="setTheme('auto')" :class="selectedTheme == 'auto' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

                <span class="ml-4">{{ __('System') }}</span>
            </a>

            <div class="text-on-surface-500 p-3">
                {{ __('Languages') }}
            </div>

            <a @click="setLocale('en')" :class="selectedLocale == 'en' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <span class="fi fi-gb"></span>

                <span class="ml-4">{{ __('English') }}</span>
            </a>

            <a @click="setLocale('vi')" :class="selectedLocale == 'vi' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <span class="fi fi-vn"></span>

                <span class="ml-4">{{ __('Vietnamese') }}</span>
            </a>

            <a @click="setLocale('ja')" :class="selectedLocale == 'ja' ? 'bg-primary-600 text-on-primary-50' : 'bg-surface text-on-surface-500'" class="cursor-pointer flex items-center gap-1 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-10 py-2 text-left text-base hover:bg-primary-600 hover:text-on-primary-50 disabled:text-gray-500">
                <span class="fi fi-jp"></span>

                <span class="ml-4">{{ __('Japanese') }}</span>
            </a>
        </div>
    </div>
</div>