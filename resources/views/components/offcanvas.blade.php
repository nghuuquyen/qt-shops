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
            class="bg-white w-1/3 flex flex-col absolute right-0 top-0 bottom-0">
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

                    <p>Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk</p>    
                </div>

                <div>
                    <div class="flex flex-col">
                        <label class="font-bold mb-2">Special instructions</label>
                        <input class="border px-2 py-4" type="text" placeholder="Ex. No opnions please" />
                    </div>

                    <div class="flex flex-row items-center mt-4">
                        <div class="w-1/3 grid grid-cols-3">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M3.75 12a.75.75 0 01.75-.75h15a.75.75 0 010 1.5h-15a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                                </svg>                                      
                            </button>
                            <span class="text-2xl font-bold">2</span>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                </svg>                                      
                            </button>
                        </div>

                        <button class="grow flex bg-green-600 hover:bg-green-700 active:translate-y-1 rounded-lg lg:rounded-2xl text-white px-6 py-2 flex-shrink-0 w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>    
                
                            <span class="ml-2">Checkout 120,000 VND</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>