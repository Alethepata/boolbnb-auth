<header class="container-fluid d-flex justify-content-between my-3">

    <div class="logo">
        <h1>BoolBnB</h1>
    </div>

    <div class="logout">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button><i class="fa-solid fa-right-from-bracket"></i></button>
        </form>
    </div>

</header>
