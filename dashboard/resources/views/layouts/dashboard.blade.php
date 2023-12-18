@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="custom-sidebar">
            <div class="custom-logo-container">
                <a class="logoLink" href="/">
                    <img src="{{ asset('images/emergis.png') }}" alt="Logo" class="custom-logo-text">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="custom-logo">
                </a>
            </div>

            <ul class="custom-menu">
                <a class="custom-menu-link" href="/">
                    <li class="custom-menu-item">
                        <img src="{{ asset('images/dashboard.svg') }}" alt="Dashboard" class="icon">
                        <span class="menu-text">Dashboard</span>
                    </li>
                </a>
                <a class="custom-menu-link" href="/projects">
                    <li class="custom-menu-item">
                        <img src="{{ asset('images/overzicht.svg') }}" alt="Overzicht" class="icon">
                        <span class="menu-text">Projecten</span>
                    </li>
                </a>
                <a class="custom-menu-link" href="/programs">
                    <li class="custom-menu-item">
                        <img src="{{ asset('images/programs.png') }}" alt="Programs" class="icon">
                        <span class="menu-text">Programma's</span>
                    </li>
                </a>
                @if (Auth::user()->role == 'Admin')
                <a class="custom-menu-link" href="/admin">
                    <li class="custom-menu-item">

                        <img src="{{ asset('images/admin.png') }}" style="width: 27px;" alt="Admin" class="icon">
                        <span class="menu-text">Admin</span>

                    </li>
                </a>
                @endif
            </ul>
        </nav>

        <nav class="custom-top-menu">
            <div style="margin-right: 1em;">
                <a class="custom-menu-link" href="/invite">
                    <li class="custom-menu-item">
                        <img src="{{ asset('images/invite.png') }}" alt="Invite" class="icon">
                    </li>
                </a>
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4" style="position: relative;">
                    <div id="user-name" style="cursor: pointer; color: white;">{{ Auth::user()->name }}</div>
                    <div class="mt-3 space-y-1" id="dropdown-menu" style="z-index: 5; display: none; position: absolute; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; border-radius: 4px; padding: 8px;">
                        <a href="{{ route('profile.edit') }}">
                            {{ __('Profiel') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Uit') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="custom-main-content">
            <div class="custom-dashboard-content">
                @yield('dashboard-content')
            </div>
        </main>
    </div>
</div>


<script>
    var userName = document.getElementById('user-name');
    var dropdownMenu = document.getElementById('dropdown-menu');

    const menuLinks = document.querySelectorAll('.custom-menu-link');
    const sidebar = document.querySelector('.sidebar');

    userName.addEventListener('click', function(e) {
        e.stopPropagation();

        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block';
        } else {
            dropdownMenu.style.display = 'none';
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target !== userName && e.target !== dropdownMenu) {
            dropdownMenu.style.display = 'none';
        }
    });

    const currentPath = window.location.pathname;

    menuLinks.forEach(item => {
        const href = item.getAttribute('href');

        if (href === currentPath) {
            item.classList.add('active');
        }
    });
</script>
</main>