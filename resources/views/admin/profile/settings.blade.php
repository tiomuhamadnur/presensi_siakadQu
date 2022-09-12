@extends('admin.layout.base')

@section('navbar')
    @include('admin.layout.navbar')
    @include('admin.layout.toast')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
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
                                <img src="{{ $photo }}" alt="user-avatar" class="d-block rounded" height="100"
                                    width="100" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="photo" class="account-file-input" accept="image/png, image/jpeg">
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
                                    <textarea id="" class="form-control" name="address" placeholder="Masukan Alamat Siswa">{{ $profile->address }}</textarea>
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
@endsection
