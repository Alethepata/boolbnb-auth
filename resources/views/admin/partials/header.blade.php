<header>
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <a href="http://localhost:5174/">
                <img src="{{ asset('images/assets/Boolbnb_logo.webp') }}" alt="logo">
            </a>
        </div>

        <!-- Versione desktop  -->
        <div class="logout">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="log-out-button">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
        <!-- Fine Versione desktop  -->

        <!-- Versione Mobile  -->
        <div class="hamburger-menu">
            <a type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"><span class="navbar-toggler-icon">&#9776;</span></a>

            <div div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
                    <a type="button" class="btnx" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa-regular fa-circle-xmark"></i></a>
                </div>
                <div class="offcanvas-body">
                    <ul>
                        <li><a href="{{ route('admin.home') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                        </li>
                        <li><a href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-list"></i> Lista
                                Appartamenti</a></li>
                        <li><a href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-folder-plus"></i>
                                Nuovo Appartamento</a></li>
                        <li><a href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i>
                                Messaggi</a></li>
                        <li><a href="{{ route('admin.sponsors.index') }}"><i class="fa-solid fa-star"></i>
                                Sponsor</a></li>
                    </ul>
                    <hr>
                    <div class="ham-canvas">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btncanvas">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Fine Versione Mobile  -->

    </div>
</header>
