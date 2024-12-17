<div class="sidebar">
    <div class="logo">
        <h2>TrashCo</h2>
    </div>

    <div class="dashboard-title">
        <h3>DASHBOARD</h3>
        <div class="divider"></div>
    </div>

    <nav class="menu">
        <div class="menu-item @if(request()->routeIs('admin.userlist')) active @endif">
            <i class="fas fa-users"></i>
            <span><a href="{{ route('admin.userlist') }}">USER LIST</a></span>
        </div>
        <div class="menu-item @if(request()->routeIs('tps')) active @endif">
            <i class="fas fa-percentage"></i>
            <span><a href="{{ route('admin.tps') }}">TPS</a></span>
        </div>
        <div class="menu-item @if(request()->routeIs('blog')) active @endif">
            <i class="fas fa-blog"></i>
            <span><a href="{{ route('admin.blog') }}">BLOG</a></span>
        </div>
        <div class="menu-item @if(request()->routeIs('market')) active @endif">
            <i class="fas fa-store"></i>
            <span><a href="{{ route('admin.market') }}">MARKET</a></span>
        </div>
    </nav>

    <div class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </span>
    </div>

</div>
