<x-layouts::frontend.app>

    @section('content')
    @section('page_title', 'Search Results')
    <livewire:page-header />
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12">
                    <h1 class="display-4 mb-4">Search Results for: {{ $query }}</h1>
                    <p class="mb-4">Here are the search results for your query. Please refine your search if you don't
                        find what you're looking for.</p>
                    <livewire:search-results :query="$query" />
                </div>
            </div>
        </div>
    </div>
@endsection
</x-layouts::frontend.app>
