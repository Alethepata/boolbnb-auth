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

        <div class="row row-content">
            <div class="col text-center"><a href="{{ route('admin.apartments.index') }}"> Lista
                    Appartamenti</a></div>
            <div class="col text-center"><a href="{{ route('admin.apartments.create') }}">
                    Nuovo Appartamento</a></div>
            <div class="col text-center"><a href="{{ route('admin.messages.index') }}">
                    Messaggi</a></div>
            <div class="col text-center"><a href="{{ route('admin.sponsors.index') }}">
                    Sponsor</a></div>
        </div>
    </nav>
</aside>
