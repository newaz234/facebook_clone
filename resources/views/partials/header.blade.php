<header>
        <div class="logo-search">
            <div class="logo">
                <i class="fab fa-facebook"></i>
            </div>
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search Facebook">
            </div>
        </div>
        
        <div class="nav-icons">
            <div class="nav-icon active">
                <i class="fas fa-home" onclick="window.location.href='{{ route('hompage') }}'"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-store"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-user-group" onclick="window.location.href='{{ route('friends.index') }}'"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-gamepad"></i>
            </div>
        </div>
        
        <div class="user-profile">
            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
            <span>{{$user->surname}}</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </header>
    