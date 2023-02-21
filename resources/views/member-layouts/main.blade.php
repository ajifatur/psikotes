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
            <li class="nav-item" style="{{ Request::url() == route('member.dashboard') ? 'visibility:hidden' : '' }}">
                <a class="nav-link text-white fw-bold" href="{{ route('member.dashboard') }}"><i class="bi-arrow-left"></i> <span class="d-none d-md-inline">Kembali</span></a>
            </li>
        </ul>
        <a class="navbar-brand mx-auto" href="{{ route('member.dashboard') }}">
            {{ setting('name') }}
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white fw-bold btn-logout" href="#"><span class="d-none d-md-inline">Keluar</span> <i class="bi-arrow-right"></i></a>
                <form id="form-logout" class="d-none" method="post" action="{{ route('auth.logout') }}">@csrf</form>
            </li>
        </ul>
    </div>
</nav>  
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
<script type="text/javascript">
	function j(e){
	    e.preventDefault();
	    e.returnValue = '';
	}
	// Before Unload
	window.addEventListener("beforeunload", j);
	// Unload
	window.addEventListener("unload", function(e){
		console.log("Bye bye");
	});

	// Next form
	$(document).on("click", "#btn-next", function(e){
		e.preventDefault();
		var ask = confirm("Anda ingin melanjutkan ke bagian selanjutnya?");
		if(ask){
			window.removeEventListener("beforeunload", j);
			$("input[name=is_submitted]").val(0);
			$("#form")[0].submit();
		}
	});
	// Submit form
	$(document).on("click", "#btn-submit", function(e){
		e.preventDefault();
		var ask = confirm("Anda yakin ingin mengumpulkan tes yang telah dikerjakan?");
		if(ask){
			window.removeEventListener("beforeunload", j);
			$("#form")[0].submit();
		}
	});
</script>
@yield('js')
</body>
</html>