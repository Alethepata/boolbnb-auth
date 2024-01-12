<header>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button><i class="fa-solid fa-right-from-bracket"></i></button>
    </form>
</header>
