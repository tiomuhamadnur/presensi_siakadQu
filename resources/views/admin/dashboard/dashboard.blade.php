@include('admin.layout.base')

<div class="wrapper">
    <div class="main-header">
        @include('admin.layout.navbar')
    </div>
        @include('admin.layout.asside')

        <div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt--2">Dashboard</h2>
								<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body" style="border-bottom: 100px;">
									<div class="card-title">Jumlah Guru</div>
									<a href=""><i class="fas fa-user"></i></a>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div><h1 style="font-size: 80px; color: #000000">10</h1></div>
											<h6 class="fw-bold mt-3 mb-0" style="font-size: 40px;">Guru</h6>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body" style="border-bottom: 100px;">
									<div class="card-title">Jumlah Siswa</div>
									<a href=""><i class="fas fa-users"></i></a>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div><h1 style="font-size: 80px; color: #000000">{{ $countStudent }} </h1></div>
											<h6 class="fw-bold mt-3 mb-0" style="font-size: 40px;">Siswa</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body" style="border-bottom: 100px;">
									<div class="card-title">Jumlah Kelas</div>
									<a href=""><i class="fas fa-database"></i></a>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div><h1 style="font-size: 80px; color: #000000">10</h1></div>
											<h6 class="fw-bold mt-3 mb-0" style="font-size: 40px;">Kelas</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            @include('admin.layout.footer')
		</div>
</div>
