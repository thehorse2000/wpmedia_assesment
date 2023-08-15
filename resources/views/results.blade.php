<x-layout>
    <x-slot:pageTitle>
        Results
    </x-slot:pageTitle>
    <div class="p-8 pt-0">
        <h4 class="text-xl font-bold text-center">Previous crawl results</h4>
        @if(isset($results))
            @foreach($results as $result)
                <div class="block w-2/3 mx-auto justify-center mt-4 ">
                    <div class="border-2 rounded border-cyan-900 p-8 relative">
                        <h6 class="text-l font-semibold text-left">{{$result->homepage_url}}</h6>
                        <div class="absolute top-8 right-8 text-right ">
                            <p class="text-sm text-cyan-900 mb-3">{{ $result->date }}</p>
                            <a href="{{route('results:view',['homepage_url'=> $result->homepage_url])}}"
                               class="btn-primary">View</a>
                        </div>
                        <p><span class="text-cyan-700 font-bold">{{count($result->results)}}</span> Link found.</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="mt-4 text-gray-700">No results to show.</p>
        @endif

    </div>
</x-layout>
