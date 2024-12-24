<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; font-size: inherit; color: inherit;">
                    <h1>TrashCo</h1>
                </button>
            </form>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ url('tps') }}" class="{{ Request::is('tps*') ? 'active' : '' }}">TPS</a>
            </li>
            <li>
                <a href="{{ url('blog') }}" class="{{ Request::is('blog')  || Request::is('blogsection') ? 'active' : '' }}">Blog</a>
            </li>
            <li>
                <a href="{{ url('shop') }}" class="{{ Request::is('shop') ? 'active' : '' }}">Market</a>
            </li>
            <li>
                <a href="{{ url('profile') }}" class="{{ Request::is('profile') ? 'active' : '' }}">Profile</a>
            </li>
        </ul>
        <!-- Hamburger Menu -->
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>
