<div class="bg-white sticky top-0" id="app_navigation">
    <div class="max-w-screen-lg m-auto" 
        x-data="{ 
                activeIndex: 0, 
                navigationHeight: document.querySelector('#app_navigation').getBoundingClientRect().height + 10 }
        ">
        <ul class="flex flex-row w-full items-center justify-center">
            @foreach ($categories as $category)
                <li 
                    class="px-6 py-3 cursor-pointer"
                    x-transition
                    @click="
                        activeIndex = {{ $loop->index }};

                        window.scroll({
                            top: document.querySelector('#category_{{ $category['id'] }}').getBoundingClientRect().top - navigationHeight,
                            behavior: 'smooth'
                        });
                    "
                    @scroll.window="
                        if (document.querySelector('#category_{{ $category['id'] }}').getBoundingClientRect().top - navigationHeight <= 0) {
                            activeIndex = {{ $loop->index }}
                        }
                    "
                    :class="{ 'border-violet-800 border-b-2': activeIndex == {{ $loop->index }} }">
                    <a class="font-normal text-base text-grey hover:text-violet-800">
                        {{ $category['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>