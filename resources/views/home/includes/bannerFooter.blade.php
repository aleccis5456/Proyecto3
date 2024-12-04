@if (is_null($banners))
@elseif (!is_null($banners))
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 28 and $banner->position->category == 'general')
        <div class="px-20">
            @if ($banner->url_relation != null)
                <a href="{{ $banner->url_relation }}">
                    <img src="{{ asset("uploads/banners/$banner->imagen") }}" class="w-full h-full object-cover"
                        alt="...">
                </a>
            @elseif ($banner->producto_id != null)
                <a href="{{ route('producto', ['id' => $banner->producto_id]) }}">
                    <img src="{{ asset("uploads/banners/$banner->imagen") }}" class="w-full h-full object-cover"
                        alt="...">
                </a>
                {{-- @endif        --}}
            @else
                <img src="{{ asset("uploads/banners/$banner->imagen") }}" class="w-full h-full object-cover"
                    alt="...">
            @endif
            {{-- <img class="" src="{{ asset("uploads/banners/$banner->imagen") }}" alt=""> --}}
        </div>
            @break
        @endif
    @endforeach
@endif