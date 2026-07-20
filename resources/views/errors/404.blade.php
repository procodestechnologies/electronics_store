<x-layouts::frontend.app>

    @section('content')
    @section('page_title', $exception->getMessage())
    <div class="container py-5 text-center">
        <h1 class="display-4 mb-3">404</h1>
        <p class="text-muted">
            {{ $exception->getMessage() ?: 'The page you are looking for could not be found.' }}
        </p>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">
            Back to Home
        </a>
    </div>
@endsection

</x-layouts::frontend.app>
