<x-layouts::frontend.app>
    @section('page_title', 'Track Order')
    @section('content')
        {{-- page header --}}
        <livewire:page-header />
        {{-- page header end --}}

        {{-- shop content --}}
        <livewire:frontend-track-order :order="$orderNumber" />
        {{-- shop content end --}}
    @endsection
</x-layouts::frontend.app>
