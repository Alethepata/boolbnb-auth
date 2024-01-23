<aside class="container-fluid">
    <nav class="container">
        {{-- <ul class="d-flex m-0 p-0">
            <li class="mb-3 mx-3"><a href="{{ route('admin.home') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="mb-3 mx-3"><a href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-list"></i> Lista
                    Appartamenti</a></li>
            <li class="mb-3 mx-3"><a href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-folder-plus"></i>
                    Nuovo Appartamento</a></li>
            <li class="mb-3 mx-3"><a href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i>
                    Messaggi</a></li>
            <li class="mb-3 mx-3"><a href="{{ route('admin.sponsors.index') }}"><i class="fa-solid fa-envelope"></i>
                    Sponsor</a></li>
        </ul> --}}

        <div class="row row-cols-5 py-3">
            <div class="col text-center"><a href="{{ route('admin.home') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a></div>
            <div class="col text-center"><a href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-list"></i> Lista
                Appartamenti</a></div>
            <div class="col text-center"><a href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-folder-plus"></i>
                Nuovo Appartamento</a></div>
            <div class="col text-center"><a href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i>
                Messaggi</a></div>
            <div class="col text-center"><a href="{{ route('admin.sponsors.index') }}"><i class="fa-solid fa-star"></i>
                Sponsor</a></div>
        </div>
    </nav>
</aside>
