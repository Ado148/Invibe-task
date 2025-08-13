<nav style="background:#fff; border-bottom:1px solid #ccc; padding:10px;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
        <a href="/" style="font-weight:bold; font-size:20px; text-decoration:none; color:#333;">Laravel 12</a>
        <ul style="list-style:none; margin:0; padding:0;">
            <x-navbar-link href="/" :active="request()->is('/')">Domov</x-navbar-link>
            <x-navbar-link href="/admin" :active="request()->is('admin*')">Admin</x-navbar-link>
        </ul>
    </div>
</nav>