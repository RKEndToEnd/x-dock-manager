                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                    <meta name="description" content="" />
                    <meta name="author" content="" />
                    <title>{{ config('app.name') }}</title>
                    <!-- Fonts -->
                    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
                    <!-- Core theme CSS (includes Bootstrap)-->
                    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

                </head>
                <body id="page-top">
                <!-- Navigation-->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                    <div class="container px-4">
                        <a class="navbar-brand" href="#page-top">{{ config('app.name') }}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item"><a class="nav-link" href="#about">O aplikacji</a></li>
                                    @if (Route::has('login'))
                                        @auth
                                            <li class="nav-item">
                                            <a  class="nav-link" href="{{ url('/tower') }}">Home</a>
                                            </li>
                                            @else
                                                <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">Zaloguj si??</a>
                                                </li>
                                            @if (Route::has('register'))
                                                 <li class="nav-item">
                                                 <a  class="nav-link" href="{{ route('register') }}">Rejestracja</a>
                                                 </li>
                                            @endif
                                        @endauth
                                    @endif
                            </ul>
                        </div>
                    </div>
                </nav>--}}
                <!-- Header-->
                <header   class="bg-primary bg-gradient text-white vh-100 )">
                    <div class="container px-4 text-center" >
                        <h1 class="fw-bolder">xDockManager</h1>
                        <p class="lead">Efektywane zarz??dzanie procesami w magazynie</p>
                        <a class="btn btn btn-outline-light" href="#about">Dowiedz si?? wi??cej</a>
                    </div>
                </header>
                <!-- About section-->
                <section id="about">
                    <div class="container px-4">
                        <div class="row gx-4 justify-content-center">
                            <div class="col-lg-8">
                                <h2>xDockManager</h2>
                                <p class="lead">Automatyzacja proces??w jest nieod????czym elementem budwania przewagi konkurencyjnej na rynku. Aplikacja xDockManager posiada szereg rozwi??za??, kt??re pomoga zoptymalizowa?? i monitorowa?? procesy w Twoim magazynie:</p>
                                <ul>
                                    <li>Zarz??dzanie rampami: podstawienia, statusy ramp - w tym mo??liwo???? nadawania w??asnych status??w</li>
                                    <li>Zarz??dzanie pracownikami: przypisywanie zada??, zarz??dzanie upranieniami dost??pu</li>
                                    <li>Monitorowanie procesu: czasy prze??adunk??w, terminowo???? podstawie?? i wyjazd??w</li>
                                    <li>Monitoring KPI - eksport raportu z prze??adunk??w do Excela</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; RK EndToEnd 2022</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="js/welcome.js"></script>
                </body>
                </html>
