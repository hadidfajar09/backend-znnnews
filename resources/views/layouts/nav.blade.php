<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>ACTION</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home <span class="fa fa-chevron"></span></a>
                
            </li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Users <span class="fa fa-chevron"></span></a>
                
            </li>
            <li><a href="{{ route('category.index') }}"><i class="fa fa-table"></i> Kategori <span class="fa fa-chevron"></span></a>
                
            </li>
            <li><a href="{{ route('news.index') }}"><i class="fa fa-bar-chart-o"></i> Berita <span class="fa fa-chevron"></span></a>
                
            </li>



            <li>
                <a class="nav-link" onclick="document.getElementById('logout').submit()">
                    <span class="glyphicon glyphicon-off">
                     `Logout

                
            </span>
        </a>
                <form action="{{ route('logout') }}" method="post" id="logout">

                    @csrf



                </form>
            </li>






        </ul>
    </div>


</div>