<header>
    <div class="logo-search">
        <div class="logo">
            <i class="fab fa-facebook"></i>
        </div>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <form action="{{ route('search') }}" method="GET">
                @csrf
                <input type="text" name="query" placeholder="Search Facebook" value="{{ request('query') }}">
            </form>
        </div>
    </div>

    <div class="nav-icons">
        <div class="nav-icon active">
            <i class="fas fa-home" onclick="window.location.href='{{ route('hompage') }}'" title="home"></i>
        </div>
        <div class="nav-icon">
            <i class="fa-brands fa-facebook-messenger" onclick="window.location.href='{{ route('messages.index') }}'" title="messages"></i>
        </div>
        <div class="nav-icon">
            <i class="fas fa-user-group" onclick="window.location.href='{{ route('friends.index') }}'" title="friends"></i>
        </div>
    </div>

    <div class="user-profile" id="dropdownMenuButton">
        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
        <span>{{ auth()->user()->surname }}</span>
        <i class="fas fa-caret-down" ></i>

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a>
            <form action="{{ route('logout') }}" method="GET">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>
</header>
<script>
    const dropdownButton = document.getElementById('dropdownMenuButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // Outside click এ বন্ধ হবে
    window.addEventListener('click', (e) => {
        if (!e.target.closest('.user-profile')) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>

