<form {{ $attributes(["class" => "w-3/4  gap-6 rounded-r-lg shadow-slate-800 shadow-xl flex flex-col items-center ", "method" => "GET"]) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>
