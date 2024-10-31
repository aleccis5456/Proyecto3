@if (is_null($banners))
@elseif (!is_null($banners))
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 3 and $banner->position->category == 'general')
            <div class="px-20">
                <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
            </div>
            @break
        @endif
    @endforeach
@endif