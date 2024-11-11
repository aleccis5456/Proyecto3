@if (is_null($banners))
@elseif (!is_null($banners))
    @php
        $count = $banners->where('position_id', 2)->where('activo', 1)->count();
        $bannersToUse = $banners->where('position_id', 2)->where('activo', 1);
    @endphp
    
    @if ($count >= 2)
        <div id="controls-carousel" class="relative w-full h-[450px]" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-full overflow-hidden">
                @foreach ($bannersToUse as $index => $banner)                
                    <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                        @if ($banner->url_relation != null)
                            <a href="{{ $banner->url_relation }}">
                                <img src="{{ asset("uploads/banners/$banner->imagen") }}"
                                    class="w-full h-full object-cover" alt="...">
                            </a>           
                        @else
                        <img src="{{ asset("uploads/banners/$banner->imagen") }}"
                        class="w-full h-full object-cover" alt="...">
                        @endif
                                        
                    </div>                
                @endforeach
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    @else
        @foreach ($bannersToUse as $banner)        
            <div class="">
                @if ($banner->url_relation != null)
                    <a href="{{ $banner->url_relation }}">
                        <img class="w-auto h-full" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                    </a>    
                @else
                    <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                @endif                
            </div>        
        @endforeach    
    @endif

    
@endif
