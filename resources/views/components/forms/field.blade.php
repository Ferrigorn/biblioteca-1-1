@props(['label', 'name'])

<div class="flex flex-col items-center gap-2 w-full"> <!-- Centrem els elements i ajustem l'espai -->
    @if ($label)
        <x-forms.label :$name :$label class="text-center" /> <!-- Centrem el text del label -->
    @endif

    <div class="mt-1 w-full">
        {{ $slot }}

        <x-forms.error :error="$errors->first($name)" />
    </div>
</div>
