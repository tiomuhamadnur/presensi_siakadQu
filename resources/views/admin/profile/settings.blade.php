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
								<h2 class="text-white pb-2 fw-bold mt--2">Pengaturan Profil</h2>
								<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi Daarul Qur'an</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="page-inner py-5">
                    <div class="row mt--2">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Detail Profil</h5>
                                <!-- Account -->
                                <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            @php
                                                $photo = asset('images/admin-icon.png');
                                                if ($profile) {
                                                    if ($profile->photo) {
                                                        $photo = asset($profile->photo);
                                                    }
                                                }
                                            @endphp
                                            <img src="{{ $photo }}" alt="#" class="avatar avatar-xl" style="width: 6rem; height: 6rem; border-raidus: 50%" id="uploadedAvatar">
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary m-4" tabindex="0">
                                                    <span class="d-none d-sm-block" style="color: black">Unggah Foto Baru</span>
                                                    <i class="bx bx-upload d-block d-sm-none m-3"></i>
                                                    <input type="file" id="upload" name="photo" class="account-file-input" accept="image/png, image/jpeg" style="color: black">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body">
            
                                        <div class="row">
                                            <div class="col-md-4 mb-1">
                                                <label for="nameWithTitle" class="form-label">Nama</label>
                                                <input type="text" id="" name="name" class="form-control"
                                                    placeholder="Masukan Nama" value="{{ $profile->name }}" />
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="nameWithTitle" class="form-label">NIP</label>
                                                <input type="number" id="" name="nip" class="form-control"
                                                    placeholder="Masukan NIP" value="{{ $profile->nip }}" />
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="" class="form-label">Email</label>
                                                <input type="text" id="" class="form-control" name="email"
                                                    placeholder="xxxx@xxx.xx" value="{{ $profile->email }}" />
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="emailWithTitle" class="form-label">Hp</label>
                                                <input type="text" id="" class="form-control" name="phone"
                                                    placeholder="08xxxxxxxx" value="{{ $profile->phone }}" />
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
                                                <select class="form-control" name="gender" id="">
                                                    @if ($profile->gender == 'Laki-laki')
                                                        <option value="Laki-laki" selected>Laki-laki</option>
                                                    @else
                                                        <option value="Perempuan" selected>Perempuan</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-1">
                                                <label for="emailWithTitle" class="form-label">Alamat</label>
                                                <textarea id="" class="form-control" name="address" placeholder="Masukan Alamat">{{ $profile->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /Account -->
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            @include('admin.layout.footer')
		</div>
</div>
