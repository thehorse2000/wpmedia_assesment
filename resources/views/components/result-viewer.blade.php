<div class="block mx-auto w-3/4 justify-center mt-10 ">
    <div class="w1/2 border-2 rounded border-cyan-900 p-8 relative">
        <h4 class="text-2xl text-center font-black text-cyan-900">Crawl result</h4>
        <h6 class="text-l font-semibold text-center">{{$result['homepage_url']}}</h6>
        <p class="absolute top-8 right-8 text-right text-sm text-decoration-underline text-cyan-900">{{ $result['date'] }}</p>
        <p><span class="text-cyan-700 font-bold">{{count($result['results'])}}</span> Link found.</p>
        <ul class="list-inside list-decimal w-fit mt-6">
            @foreach($result['results'] as $link)
                <li>{{$link['path']}}</li>
            @endforeach
        </ul>
    </div>

</div>
