<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://ajifatur.github.io/assets/spandiv.min.css">
    <link rel="stylesheet" type="text/css" href="https://tes.psikologanda.com/assets/css/style.css">
    @yield('css')
    <title>Psikotes Spandiv</title>	
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand navbar-dark bg-theme-1 fixed-top shadow-sm">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-item" style="visibility:hidden">
                <a class="nav-link text-white fw-bold" href="/"><i class="fa fa-arrow-left"></i> <span class="d-none d-md-inline">Kembali</span></a>
            </li>
        </ul>
        <a class="navbar-brand mx-auto" href="/">
            SpandivTalk
            <!-- <img src="https://tes.psikologanda.com/assets/images/logo-2-white.png" height="40" alt="img"> -->
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white fw-bold btn-logout" href="#"><span class="d-none d-md-inline">Keluar</span> <i class="bi-arrow-right"></i></a>
                <form id="form-logout" class="d-none" method="post" action="{{ route('auth.logout') }}">@csrf</form>
            </li>
        </ul>
    </div>
</nav>    
<section>
    <div class="bg-theme-1" style="padding: 6em 0 2em 0">
        <main class="container text-center text-white">
            <h3 class="text-capitalize"><span id="demo"></span></h3>
            <p>Selamat datang <span class="fw-bold">{{ Auth::user()->name }}</span> di Tes Online Spandiv.</p>
        </main>
    </div>
</section>
<div class="custom-shape-divider-top-1617699401">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
    </svg>
</div>
@yield('content')
<script>
function myFunction() {
    var greeting;
    var time = new Date().getHours();
    if (time < 12) {
        greeting = "Selamat Pagi";
    } else if (time >= 12 && time < 18) {
        greeting = "Selamat Siang";
    } else {
        greeting = "Selamat Malam";
    }
    document.getElementById("demo").innerHTML = greeting;
}
myFunction();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajifatur.github.io/assets/spandiv.min.js"></script>
@yield('js')
</body>
</html>