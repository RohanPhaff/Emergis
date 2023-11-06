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
            </ul>
        </nav>

        <!-- Top Menu -->
        <nav class="custom-top-menu">
            <ul class="custom-top-menu-ul">
                <li class="custom-top-menu-item">
                    <a class="custom-top-menu-link" href="#">Profile</a>
                </li>
            </ul>
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
</main>