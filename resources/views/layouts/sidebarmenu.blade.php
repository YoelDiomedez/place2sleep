<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-accordion-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item start
                {{    
                    request()->is('home')
                    ? 'active open' : '' 
                }}
            ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-screen-desktop "></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow 
                        {{   
                            request()->is('home')
                            ? 'open' : '' 
                        }}
                    "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ request()->is('home') ? 'active open' : '' }}">
                        <a href="{{ route('home') }}" class="nav-link ">
                            <span class="title">Inicio</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item
                {{    
                    request()->is('period') ||
                    request()->is('cemetery') ||
                    request()->is('deceased') ||
                    request()->is('relative') ||
                    request()->is('price')
                    ? 'active open' : '' 
                }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">System</span>
                    <span class="arrow"></span>
                    <span class="arrow 
                    {{   
                        request()->is('period') ||
                        request()->is('cemetery') ||
                        request()->is('deceased') ||
                        request()->is('relative') ||
                        request()->is('price')
                         ? 'open' : '' 
                    }}">
                </a>
                <ul class="sub-menu">  
                    <li class="nav-item {{ request()->is('price') ? 'active open' : '' }}">
                        <a href="{{ route('price.index') }}" class="nav-link">
                            <span class="title">Precios</span>
                        </a>
                    </li>              
                    <li class="nav-item {{ request()->is('deceased') ? 'active open' : '' }}">
                        <a href="{{ route('deceased.index') }}" class="nav-link">
                            <span class="title">Difuntos</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('period') ? 'active open' : '' }}">
                        <a href="{{ route('period.index') }}" class="nav-link">
                            <span class="title">Periodos</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('relative') ? 'active open' : '' }}">
                        <a href="{{ route('relative.index') }}" class="nav-link">
                            <span class="title">Familiares</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('cemetery') ? 'active open' : '' }}">
                        <a href="{{ route('cemetery.index') }}" class="nav-link">
                            <span class="title">Cementerios</span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->