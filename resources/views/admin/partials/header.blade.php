<header class="container-fluid d-flex justify-content-between my-3">

    <div class="logo-header">
        <img  src="{{ asset('images/assets/Boolbnb-logo.png') }}" alt="">
    </div>

    <div class="logout">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="log-out-button">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
        </form>
    </div>

</header>
