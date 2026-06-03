<nav class="navbar navbar-expand-lg bg-body-tertiary">
 <div class="container-fluid">
   <a class="navbar-brand" href="#">Regular Map</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
         <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="{{ route('peta') }}">Map</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="{{ route('tabel') }}">Table</a>
       </li>
     </ul>
     <form class="d-flex me-2" role="search">
       <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
       <button class="btn btn-outline-success" type="submit">Search</button>
     </form>
     <div class="d-flex align-items-center gap-2">
         @guest
             @if (Route::has('login'))
                 <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Login</a>
             @endif
             @if (Route::has('register'))
                 <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
             @endif
         @else
             <span class="navbar-text me-2">Hello, {{ auth()->user()->name }}</span>
             <form method="POST" action="{{ route('logout') }}" class="m-0">
                 @csrf
                 <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
             </form>
         @endguest
     </div>
   </div>
 </div>
</nav>
