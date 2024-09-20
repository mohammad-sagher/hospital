 <!-- PRE LOADER -->
 <section class="preloader">
    <div class="spinner">

         <span class="spinner-rotate"></span>
         
    </div>
</section>


<!-- HEADER -->
<header>
    <div class="container">
         <div class="row">

              <div class="col-md-4 col-sm-5">
                   <p>Welcome to a Professional Health Care</p>
              </div>
                   
              <div class="col-md-8 col-sm-7 text-align-right">
                   <span class="phone-icon"><i class="fa fa-phone"></i> 010-060-0160</span>
                   <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 10:00 PM (Mon-Fri)</span>
                   <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">info@company.com</a></span>
              </div>

         </div>
    </div>
</header>


<!-- MENU -->
<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

         <div class="navbar-header">
              <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
              </button>

              <!-- lOGO TEXT HERE -->
              <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
         </div>

         <!-- MENU LINKS -->
         <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">


                    
             
               <li><a href="{{route('health.home')}}" class="smoothScroll">Home</a></li>
               <li><a href="{{route('health.about')}}" class="smoothScroll">About Us</a></li>
               <li><a href="{{route('health.doctor')}}" class="smoothScroll">Doctors</a></li>
               <li><a href="{{route('health.new')}}" class="smoothScroll">News</a></li>
               <li><a href="{{route('health.gogle')}}" class="smoothScroll">Contact</a></li>
                   
              
              @auth
              
                   <li>
                    <a href="#" class="smoothScroll"
                       onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                        LogOut
                    </a>
            
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                   
                    <li><a href="{{route('create.NewPatients')}}" class="smoothScroll">Make an appointment</a></li>
                </li>
                @else
              
                <li><a href="{{route('login')}}" class="smoothScroll">Login</a></li>
                  
                <li><a href="{{route('register')}}" class="smoothScroll">Register</a></li>
                @endauth

                  @auth
              
              @if(Auth::user()->isAdmin())
                    
                <li><a href="{{route('dashboard.index')}}" class="smoothScroll">dashboard</a></li> 
                @endauth 
              @endif
                   
                
              </ul>
         </div>

    </div>
</section>

