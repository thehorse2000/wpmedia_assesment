<x-layout>
    <x-slot:title>Admin page</x-slot:title>
    <div class="mt-6">
        <form action="/crawl" method="GET">
            <div class="md:flex justify-center mb-6">
                <h3 class="font-black text-xl text-center">Crawl your homepage.</h3>
            </div>
            <div class="md:flex justify-center md:items-center gap-2">
                <div class="md:w-auto">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Page url
                    </label>
                </div>
                <div class="md:w-1/3">
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 focus:bg-white focus:border-cyan-950"
                        id="inline-full-name" type="text" placeholder="https://www.google.com" name="homepage_url">
                </div>
                <div class="md:w-auto">
                    <button class="btn-primary" type="submit">
                        Start
                    </button>
                </div>
                <div class="md:w-auto">
                    <a href="{{route('results')}}" class="btn-primary-lighter" type="button">
                        View previous results
                    </a>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <x-error-alert :title="'Form validation error'" :message="$error"></x-error-alert>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>
        @if (session('success'))
            <x-success-alert :message="'Homepage crawled successfully'"></x-success-alert>
        @elseif(session('error'))
            <x-error-alert :title="'Failed to crawl the url.'" :message="session('error')"></x-error-alert>
        @endif
        @if(session('result'))
            <x-result-viewer :result="session('result')"></x-result-viewer>
        @endif
    </div>
</x-layout>
