<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="" style="height: 45px; width=45px;">
            </span>
            <span class="app-brand-text menu-text fw-bolder ms-2">PRESENSI</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('teacher.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Mata Pelajaran</span></li>
        <li class="menu-item">
            <a href="{{ route('teacher.course.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-book-reader'></i>
                <div data-i18n="Perfect Scrollbar">Mata Pelajaran Diampu</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Kelas</span></li>
        <li class="menu-item">
            <a href="{{ route('teacher.class.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-book-reader'></i>
                <div data-i18n="Perfect Scrollbar">Wali Kelas</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Absensi</span></li>
        <li class="menu-item">
            <a href="{{ route('teacher.present.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Absensi</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Nilai</span></li>
        <li class="menu-item">
            <a href="{{ route('teacher.course.index') }}" class="menu-link">
                <i class='menu-icon tf-icon bx bx-edit-alt'></i>
                <div data-i18n="Extended UI">Input Nilai</div>
            </a>
        </li>
    </ul>
</aside>
