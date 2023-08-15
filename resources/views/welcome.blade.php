<x-layout>
    <x-slot:pageTitle>
        Home
    </x-slot:pageTitle>
    <div class="max-w-7xl mx-auto px-7">
        @if(session('downloadXml'))
            <x-success-alert :message="'Sitemap.xml file will be downloaded shortly'"></x-success-alert>
        @endif
        @if(isset($xmlData))
            <div class="mb-4">
                <span class="text-xl font-bold ">Stored Sitemap.xml file</span>
                <a href="{{route('home', ['downloadXml'=>"true"])}}" class="underline text-cyan-800">Download?</a>
            </div>
            <ul class="list-disc">
                @foreach($xmlData as $data)
                    <li class="mb-3">
                        <p>Loc: {{$data->loc}}</p>
                        <p>Lastmod: {{$data->lastmod}}</p>
                        <p>Priority: {{$data->priority}}</p>

                    </li>
                @endforeach
            </ul>
        @else
            <div class="flex justify-center">
                <h2 class="font-semibold">No stored sitemap.xml file</h2>
            </div>
        @endif

    </div>
</x-layout>
