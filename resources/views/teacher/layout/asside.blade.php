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
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Layouts">Data Siswa</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.student.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Siswa</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Guru & Wali Kelas</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-brightness"></i>
                <div data-i18n="Account Settings">Guru & Wali Kelas</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.teacher.index') }}" class="menu-link">
                        <div data-i18n="Account">Guru & Wali Kelas</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Atur Postingan -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Kelas</span></li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Kelas</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.class.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Kelas</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Atur Postingan -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Mata Pelajaran</span></li>
        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Mata Pelajaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Mata Pelajaran</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
