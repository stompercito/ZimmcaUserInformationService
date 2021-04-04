          <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/partner/dashboard" class="site_title">
                <i class="glyphicon glyphicon-user"></i>
                <span><small>DHIZO.com | Socios</small></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/user.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            @if(Auth::user()->estado != 0)
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="/partner/dashboard"><i class="fa fa-home"></i> Inicio </a></li>
                  <li><a href="/partner/sales"><i class="fa fa-usd"></i> Ventas </a></li>
                  <li><a href="/partner/buy-tickets"><i class="fa fa-shopping-cart"></i> Comprar Boletos </a></li>
                  <li><a href="/partner/tickets"><i class="fa fa-ticket"></i> Mis Boletos </a></li>
                  <li><a href="/partner/balance"><i class="fa fa-bank"></i> Saldos </a></li>
                  <li><a href="/partner/my-account"><i class="fa fa-user"></i> Mi perfil </a></li>
                  <li><a href="/partner/help"><i class="fa fa-question"></i> Ayuda</a></li>
                </ul>
              </div>
            @else
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="/partner/dashboard"><i class="fa fa-home"></i> Inicio </a></li>
                  <li><a href="/partner/my-account"><i class="fa fa-user"></i> Mi perfil </a></li>
                </ul>
              </div>
            @endif

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="/partner/help" data-toggle="tooltip" data-placement="top" title="Ayuda">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="{{ route('logout') }}" 
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                 </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>




