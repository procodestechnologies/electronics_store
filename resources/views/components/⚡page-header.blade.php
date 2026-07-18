<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">@yield('page_title')</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a>Pages</a></li>
        <li class="breadcrumb-item active text-white">@yield('page_title')</li>
    </ol>
</div>
