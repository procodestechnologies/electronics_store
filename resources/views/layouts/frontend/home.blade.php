<x-layouts::frontend.app>
    @section('page_title','Home')
    @section('content')
        <!-- Carousel Start -->
        <livewire:carousel />
        <!-- Carousel End -->

        <!-- Searvices Start -->
        <livewire:services />
        <!-- Searvices End -->

        <!-- Products Offer Start -->
        <livewire:products-offer />
        <!-- Products Offer End -->


        <!-- Our Products Start -->
        <livewire:products />
        <!-- Our Products End -->

        <!-- Product Banner Start -->
        <livewire:product-banner />
        <!-- Product Banner End -->

        <!-- Product List Satrt -->
        <livewire:product-list />
        <!-- Product List End -->

        <!-- Bestseller Products Start -->
        <livewire:bestselling-products />
        <!-- Bestseller Products End -->


        <!-- Footer Start -->
        <livewire:footer />
        <!-- Footer End -->
    @endsection
</x-layouts::frontend.app>
