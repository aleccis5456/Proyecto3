@if (is_null($banners))
@elseif (!is_null($banners))
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 2 and $banner->position->category == 'general')
            <div class=" rounded-lg">
                <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
            </div>
            @break
        @endif
    @endforeach
@endif
