<x-layouts::frontend.app>
    @section('page_title','Checkout')
    @section('content')
        {{-- page header --}}
        <livewire:page-header />
        {{-- page header end --}}

        {{-- checkout content --}}
        <livewire:checkout />
        {{-- checkout content end --}}
    @endsection
</x-layouts::frontend.app>
