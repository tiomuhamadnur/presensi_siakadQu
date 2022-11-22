<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar avatar-lg">
                    @if (\Auth::user()->photo)
                    <img src="{{ asset(\Auth::user()->photo) }}" alt class="w-px-40 h-auto rounded-circle" class="avatar-img rounded-circle" />
                @else
                    <img src="https://w7.pngwing.com/pngs/340/956/png-transparent-profile-user-icon-computer-icons-user-profile-head-ico-miscellaneous-black-desktop-wallpaper.png"
                        alt="" class="avatar-img rounded-circle" />
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
                                <a href="{{ route('admin.profile') }}">
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">My Profile</span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">Setting</span>
                                    </button>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <span class="link-collapse" style="color: #777">Log Out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="/admin">
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
                    <a href="/admin/teacher">
                        <i class="fas fa-user"></i>
                        <p>Guru & Wali Kelas</p>
                        <span class="/#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.class.index') }}" >
                        <i class="fas fa-users"></i>
                        <p>Siswa</p>
                        <span class="#"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
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

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div> --}}