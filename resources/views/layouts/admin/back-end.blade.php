<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title> @yield('title') </title>
        <!-- CSS files -->
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
        @stack('styles')
        <style>
            @import url('https://rsms.me/inter/inter.css');

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </head>

    <body>
        <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
        <div class="page">
            <!-- Sidebar -->
            @include('layouts.admin.menu-sidebar')

            <!-- Navbar -->
            <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                aria-label="Open user menu">
                                <span class="avatar avatar-sm"
                                    style="background-image: url(./static/avatars/000m.jpg)"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>Paweł Kuna</div>
                                    <div class="mt-1 small text-secondary">UI Designer</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <a href="#" class="dropdown-item">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="#" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <div class="page-wrapper">
                <!-- Page header -->
                @yield('header')

                <!-- Page body -->
                @yield('content')

                <!-- Footer -->
                <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center">
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        Copyright &copy; 2023
                                        <a href="." class="link-secondary">Tabler</a>.
                                        All rights reserved.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Libs JS -->
        @stack('scripts')
        <!-- Tabler Core -->
        <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
        <script src="{{ asset('dist/js/demo.min.js') }}"></script>
    </body>

</html>
