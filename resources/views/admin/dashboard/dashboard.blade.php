@include('admin.layout.base')

<div class="wrapper">
    <div class="main-header">
        @include('admin.layout.navbar')
    </div>
        @include('admin.layout.asside')
	<div class="bg">
		<ul class="glass">
			<li></li>
			<li></li>
			<li></li>	
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
        <div class="main-panel">
			<div class="content">
						<div class="page-inner py-5">
							<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
								<div>
									<h2 class="text-white pb-2 fw-bold mt--2">Dashboard</h2>
									<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi Daarul Qur'an</h2>
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
</div>

<style>
body{
	background-color: #fff;
}

.bg {
	width: 100%;
	height: 100vh;
	background: linear-gradient(45deg, #043d05 0%, #1e8a20 46%, #026b25 100%);
}

.glass {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	overflow: hidden;
}

.glass li{
	position: absolute;
	display: block;
	list-style: none;
	width: 20px;
	height: 20px;
	background: rgba(255,255,255,0.1);
	border: 1px solid rgba(255,255,255,0.18);
	animation: spin 5s linear infinite;
	bottom: -150px;
}

.glass li:nth-child(1){
	left: 35%;
	width: 150px;
	height: 150px;
	animation-delay: 0s;
}

.glass li:nth-child(2){
	left: 10%;
	width: 20px;
	height: 20px;
	animation-delay: 2s;
	animation-duration: 12s;
}

.glass li:nth-child(3){
	left: 70%;
	width: 20px;
	height: 20px;
	animation-delay: 4s;
}

.glass li:nth-child(4){
	left: 40%;
	width: 60px;
	height: 60px;
	animation-delay: 0s;
	animation-duration: 18s;
}

.glass li:nth-child(5){
	left: 65%;
	width: 20px;
	height: 20px;
	animation-delay: 0s;
}

.glass li:nth-child(6){
	left: 75%;
	width: 110px;
	height: 110px;
	animation-delay: 7s;
}

.glass li:nth-child(7){
	left: 35%;
	width: 150px;
	height: 150px;
	animation-delay: 7s;
}

.glass li:nth-child(8){
	left: 50%;
	width: 25px;
	height: 25px;
	animation-delay: 15s;
	animation-duration: 45s;
}

.glass li:nth-child(9){
	left: 20%;
	width: 15px;
	height: 15px;
	animation-delay: 2s;
	animation-duration: 35s;
}

.glass li:nth-child(10){
	left: 85%;
	width: 150px;
	height: 150px;
	animation-delay: 0s;
	animation-duration: 11s;
}

@keyframes spin{
	0% {
		transform: translateY(0) rotate(0deg);
		opacity: 1;
		border-radius: 10;
	}
	100% {
		transform: translateY(-1000px) rotate(720deg);
		opacity: 0;
		border-radius: 50;
	}
}
</style>