<x-layout>
    <x-slot:pageTitle>
        Result page
    </x-slot:pageTitle>
    <div class="p-8">
        <a href="{{route('results')}}" class="cursor-pointer underline">Back</a>
        @if(isset($result))
            <x-result-viewer :result="$result"></x-result-viewer>
        @else
            <p class="text-gray-500 mt-6">No result found</p>
        @endif
    </div>
</x-layout>
