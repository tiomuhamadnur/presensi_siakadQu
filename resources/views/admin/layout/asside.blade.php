<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar avatar-lg" >
                    @if (\Auth::user()->photo)
                    <img src="{{ asset(\Auth::user()->photo) }}" alt class="#" class="avatar-img rounded-circle" style="width: 3rem; height: 3rem; border-radius: 50%"/>
                @else
                    <img src="https://w7.pngwing.com/pngs/340/956/png-transparent-profile-user-icon-computer-icons-user-profile-head-ico-miscellaneous-black-desktop-wallpaper.png"
                        alt="" class="" />
                @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ \Auth::user()->name }}
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('admin.profile') }}" data-toggle="modal" data-target="#exampleModalCenter">
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">Profile Saya</span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">Pengaturan</span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">Keluar</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class=""></span>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Navigasi Utama</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.teacher.index') }}" class="menu-link">
                        <i class="fas fa-user"></i>
                        <p>Guru & Wali Kelas</p>
                        <span class="/#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.student.index') }}" >
                        <i class="fas fa-users"></i>
                        <p>Siswa</p>
                        <span class="#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" >
                        <i class="fas fa-bars"></i>
                        <p>Kelas (On Progress)</p>
                        <span class="#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.course.index') }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Mata Pelajaran</p>
                        <span class="#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-check"></i>
                        <p>Absensi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-cog"></i>
                        <p>Manajemen User</p>
                        <span class="#"></span>
                    </a>
                    <div class="collapse" id="maps">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Profile Saya
                </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>