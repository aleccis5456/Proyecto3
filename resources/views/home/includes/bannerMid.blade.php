@if (is_null($banners))
@elseif (!is_null($banners))
@php
    $count = $banners->where('position_id', 2)->where('activo', 1)->count()
@endphp
@dd($count)
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 2)
            <div class=" rounded-lg">
                @if ($banner->url_relation != null)
                    <a href="{{ $banner->url_relation }}">
                        <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                    </a>    
                @else
                    <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                @endif                
            </div>
            @break
        @endif
    @endforeach
@endif
