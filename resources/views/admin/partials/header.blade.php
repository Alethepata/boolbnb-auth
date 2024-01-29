
<header>
    <div class="container d-flex justify-content-between">
            <div class="logo">
                <a href="http://localhost:5174/">
                    <img src="{{ asset('images/assets/Boolbnb_logo.webp') }}"  alt="logo">
                </a>
            </div>

                    <div class="logout">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="log-out-button">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
                        </form>
                    </div>
    </div>
</header>
