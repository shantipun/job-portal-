<div>
   <a href="{{ route('home') }}" class="flex items-center">
    @if(file_exists(public_path('images/logo.png')))
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
    @else
        <span class="font-bold text-xl text-gray-800">JobPortal</span>
    @endif
</a>

</div>