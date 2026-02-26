<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        aside {
            background-color: #212529;
            min-height: 100vh;
            transition: width 0.3s ease;
        }
        aside nav a.nav-link {
            color: #adb5bd;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        aside nav a.nav-link:hover {
            background-color: #343a40;
            color: #fff;
            text-decoration: none;
        }
        aside nav a.nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
        }
        aside nav a.nav-link.active i {
            color: #fff;
        }
        header.bg-white {
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            z-index: 10;
        }
        form.position-relative input.form-control:focus {
            box-shadow: 0 0 5px 2px rgba(13, 110, 253, 0.5);
            border-color: #0d6efd;
        }
        header .btn-link.text-secondary:hover {
            color: #0d6efd !important;
        }
        /* Notifications badge */
        .badge-notify {
            position: absolute;
            top: 6px;
            right: 6px;
            font-size: 0.6rem;
            padding: 3px 5px;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <aside class="d-flex flex-column flex-shrink-0 p-3" style="width: 18rem;">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-gear-fill fs-3 text-primary me-2"></i>
            <span class="fs-4 fw-semibold text-white">GESTION CHARROI</span>
        </div>
        <nav class="nav nav-pills flex-column mb-auto">
            <a href="{{route('dashboard')}}" class="nav-link active" aria-current="page">
                <i class="bi bi-speedometer2 fs-5"></i> Dashboard
            </a>
             <a href="{{ route('vehicules.index') }} " class="nav-link" aria-current="page">
                <i class="bi bi-people-fill fs-5"></i> Employés
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-truck fs-5"></i> Véhicules
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-folder2-open fs-5"></i> Projects
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-arrow-left-right fs-5"></i> Déplacements
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-person-circle fs-5"></i> Users
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-grow-1 d-flex flex-column min-vh-100">

        <!-- Topbar -->
        <header class="bg-white d-flex justify-content-between align-items-center px-4 py-3 sticky-top">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link text-secondary p-0 fs-4" aria-label="Toggle menu">
                    <i class="bi bi-list"></i>
                </button>

                <form class="position-relative mb-0" style="width: 350px; min-width: 200px;">
                    <input
                        type="search"
                        class="form-control ps-4 pe-5"
                        placeholder="Type to search"
                        aria-label="Search"
                        autocomplete="off"
                    />
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-3 text-muted"></i>
                </form>
            </div>

            <div class="d-flex align-items-center gap-4 fs-5 text-secondary">

                <a href="https://github.com" target="_blank" class="text-secondary" title="GitHub">
                    <i class="bi bi-github"></i>
                </a>

                <button type="button" class="btn btn-link position-relative p-0 text-secondary" title="Notifications" aria-label="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge rounded-pill bg-danger badge-notify">4</span>
                </button>

                <!-- Profile dropdown -->
                <div class="dropdown">
                    <button
                        class="btn btn-link text-secondary p-0 fs-5 d-flex align-items-center gap-2"
                        id="dropdownProfile"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-haspopup="true"
                        aria-label="User profile menu"
                    >
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <i class="bi bi-caret-down-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownProfile">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i> Voir le profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-grow-1 overflow-auto p-4 bg-white shadow-sm">
            @if (isset($header))
                <header class="mb-4">
                    {{ $header }}
                </header>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>