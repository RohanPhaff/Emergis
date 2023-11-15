@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar -->
        <nav id="sidebar" class="custom-sidebar">
            <div class="custom-logo-container">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="custom-logo">
            </div>

            <!-- Sidebar Menu -->
            <ul class="custom-menu">
                <a class="custom-menu-link active" href="/dashboard">
                    <li class="custom-menu-item">

                        <img src="{{ asset('images/dashboard.svg') }}" alt="Dashboard" class="icon">

                    </li>
                </a>
                <a class="custom-menu-link" href="/projects">
                    <li class="custom-menu-item">
                        <img src="{{ asset('images/overzicht.svg') }}" alt="Overzicht" class="icon">
                    </li>
                </a>
                <a class="custom-menu-link" href="#">
                    <li class="custom-menu-item">

                        <img src="{{ asset('images/contacts.svg') }}" alt="Contacts" class="icon">

                    </li>
                </a>
                <a class="custom-menu-link" href="#">
                    <li class="custom-menu-item">

                        <img src="{{ asset('images/calendar.svg') }}" alt="Calendar" class="icon">

                    </li>
                </a>
                @if (Auth::user()->role == 'Admin')
                <a class="custom-menu-link" href="/admin">
                    <li class="custom-menu-item">

                        <img src="{{ asset('images/admin-icon.jpg') }}" alt="Admin" class="icon"> 

                    </li>
                </a>
                @endif
            </ul>
        </nav>

        <!-- Top Menu -->
        <nav class="custom-top-menu">
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4" style="position: relative;">
            <div id="user-name" style="cursor: pointer; color: white;">{{ Auth::user()->name }}</div>
            <div class="mt-3 space-y-1" id="dropdown-menu" style="display: none; position: absolute; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; border-radius: 4px; padding: 8px;">
                <a href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

        <!-- Main Content -->
        <main class="custom-main-content">

            <!-- Content -->
            <div class="custom-dashboard-content">
                @yield('dashboard-content')
            </div>
        </main>
    </div>
</div>


<script>
    var userName = document.getElementById('user-name');
    var dropdownMenu = document.getElementById('dropdown-menu');

    userName.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent the click event from bubbling up

        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block';
        } else {
            dropdownMenu.style.display = 'none';
        }
    });

    // Close the dropdown when clicking anywhere on the page except the name and menu
    document.addEventListener('click', function (e) {
        if (e.target !== userName && e.target !== dropdownMenu) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>
</main>