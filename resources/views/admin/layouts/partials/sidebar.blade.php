<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-solid fa-magnifying-glass-chart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Analisis Sentimen</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item -->
    <li class="nav-item {{ request()->routeIs('datasets.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('datasets.index') }}">
            <i class="fas fa-fw fa-solid fa-database"></i>
            <span>Data Tweet</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('preprocessings.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Preprocessings</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item {{ request()->routeIs('preprocessings.cleansing-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.cleansing-index') }}">Cleansing</a>
                <a class="collapse-item {{ request()->routeIs('preprocessings.case-folding-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.case-folding-index') }}">Case Folding</a>
                <a class="collapse-item {{ request()->routeIs('preprocessings.tokenizing-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.tokenizing-index') }}">Tokenizing</a>
                <a class="collapse-item {{ request()->routeIs('preprocessings.normalization-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.normalization-index') }}">Normalization</a>
                <a class="collapse-item {{ request()->routeIs('preprocessings.stopword-removal-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.stopword-removal-index') }}">Stopword Removal</a>
                <a class="collapse-item {{ request()->routeIs('preprocessings.stemming-index') ? 'active' : '' }}"
                    href="{{ route('preprocessings.stemming-index') }}">Stemming</a>
            </div>
        </div>
    </li>

    <!-- Nav Item -->
    <li class="nav-item {{ request()->routeIs('tfidf.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tfidf.index') }}">
            <i class="fas fa-fw fa-solid fa-database"></i>
            <span>Pembobotan TF-IDF</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('data.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-solid fa-hourglass-half"></i>
            <span>Data</span>
        </a>
        <div id="collapseMenu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item {{ request()->routeIs('data.train') ? 'active' : '' }}" href="{{ route('data.train') }}">Data Latih</a>
                <a class="collapse-item {{ request()->routeIs('data.test') ? 'active' : '' }}" href="{{ route('data.test') }}">Data Uji</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-solid fa-hourglass-half"></i>
            <span>Pemodelan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('naive-bayes.index') }}">Naive Bayes</a>
                <a class="collapse-item" href="utilities-border.html">Support Vector Machine</a>
            </div>
        </div>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-solid fa-chart-simple"></i>
            <span>Evaluasi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
