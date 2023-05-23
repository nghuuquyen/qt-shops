<div 
    x-data="{ offcanvas: false }" class="z-10 fixed top-0 left-0 right-0 bottom-0" style="display: none;" x-show="offcanvas">
    <div
        class="h-full"
        x-on:offcanvas-ex.window="offcanvas = !offcanvas"
    >
        <div
            x-show="offcanvas"
            x-transition:enter="transition fade-in duration-500"
            x-transition:leave="transition fade-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-50"
            x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0"
            class="bg-zinc-700 opacity-50 w-full h-full" @click="offcanvas = false">
        </div>

        <div
            x-show="offcanvas"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="translate-x-[100%] opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0 opacity-50"
            x-transition:leave-end="translate-x-[100%] opacity-0"
            class="bg-white w-full lg:w-1/3 lg:min-w-[450px] flex flex-col absolute right-0 top-0 bottom-0">
            <div class="flex flex-row mb-3 px-2 py-4 border-b items-end justify-center relative">
                <button class="btn btn-sm btn-primary btn-icon rounded-full absolute left-2" @click="offcanvas = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="35" height="35" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>

                <h2 class="text-2xl text-black">Cappuchino</h2>
            </div>

            <div class="p-4 grow flex flex-col justify-between">
                <div class="grid gird-cols-1 gap-6">
                    <img class="object-cover w-full h-64" src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600" alt="product image" />
                
                    <span class="text-black text-3xl">
                        35,000 VNĐ
                    </span>

                    <p class="overflow-y-auto max-h-32">
                        Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk.
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p> 
                </div>

                <div>
                    <div class="flex flex-col">
                        <label class="font-bold mb-2">Special instructions</label>
                        <input class="border px-2 py-4" type="text" placeholder="Ex. No opnions please" />
                    </div>

                    <div class="flex flex-row items-center mt-4">
                        <div class="w-1/3 grid grid-cols-3">
                            <button class="active:translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M3.75 12a.75.75 0 01.75-.75h15a.75.75 0 010 1.5h-15a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                                </svg>                                      
                            </button>

                            <span class="text-3xl font-bold">2</span>

                            <button class="active:translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                </svg>                                      
                            </button>
                        </div>

                        <x-submit-button class="grow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                
                            <span class="ml-2">Add to basket  70,000 VND</span>
                        </x-submit-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>