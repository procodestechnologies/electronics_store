<x-layouts::frontend.app>
    @section('page_title','Cart')
    @section('content')
        {{-- page header --}}
        <livewire:page-header />
        {{-- page header end --}}

        {{-- cart content --}}
        <livewire:cart />
        {{-- cart content end --}}
    @endsection
</x-layouts::frontend.app>
