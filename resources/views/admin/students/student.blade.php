
@include('admin.layout.base')
@section('custom_js')
    <!-- jquery -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- jquery datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <!-- script tambahan  -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js">
    </script>
    

    <!-- fungsi datatable -->
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable({
                // script untuk membuat export data 
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            })
        });

    </script>
@endsection
@section('custom_css')
    <!-- datatable style -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- bootstrap 4 css  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css tambahan  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    
@endsection

<div class="wrapper">
    <div class="main-header">
        @include('admin.layout.navbar')
    </div>
        @include('admin.layout.asside')
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">
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
								<h2 class="text-white pb-2 fw-bold mt--2">Siswa</h2>
								<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi </h2>
							</div>
						</div>
					</div>
				<div class="page-inner mt--5">
                    <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
                        <div class="card">
                            <div class="row card-header">
                                <div class="col-4 d-flex justify-content-start flex-column">
                                    <h5 class="">Master Data Siswa</h5>
                                </div>
                                <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalStore">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                
                            <div class="table">
                                <table class="table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            {{-- <th>NIK</th> --}}
                                            {{-- <th>TTL</th> --}}
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kelas</th>
                                            {{-- <th>Email</th> --}}
                                            {{-- <th>Status</th> --}}
                                            <th class="text-center">No. HP</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">NISN</th>
                                            {{-- <th>Nama Ayah</th> --}}
                                            <th class="text-center">No. HP Orang Tua</th>
                                            {{-- <th>Alamat</th> --}}
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($students as $item)
                                            <tr class="table-default">
                                                <td class="text-center">{{ $no++ }}</td>
                                                {{-- <td>{{ $item->nik }}</td> --}}
                                                {{-- <td>{{ $item->born_at }},
                                                    {{ \Carbon\Carbon::parse($item->birthday)->isoFormat('DD-MM-YYYY') }}
                                                </td> --}}
                                                <td class="text-center"><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td class="text-center">{{ $item->class ? $item->class->name : null }}</td>
                                                {{-- <td>{{ $item->email }}</td> --}}
                                                {{-- <td>
                                                    @if ($item->deleted_at)
                                                        <span class="badge bg-label-danger me-1">Deleted</span>
                                                    @else
                                                        <span class="badge bg-label-primary me-1">Active</span>
                                                    @endif
                                                </td> --}}
                                                <td class="text-center">{{ $item->phone }}</td>
                                                <td class="text-center">{{ $item->gender }}</td>
                                                <td class="text-center">{{ $item->nisn }}</td>
                                                {{-- <td>{{ $item->father_name }}</td> --}}
                                                <td class="text-center">{{ $item->parent_phone }}</td>
                                                {{-- <td>{{ $item->address }}</td> --}}
                                                <td class="text-center">
                                                            <a type="button" class="btn btn-outline-warning" href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#modalUpdate" data-name="{{ $item->name }}"
                                                                data-email="{{ $item->email }}" data-id="{{ $item->id }}"
                                                                data-status="{{ $item->status }}" data-class_id="{{ $item->class_id }}"
                                                                data-phone="{{ $item->phone }}" data-gender="{{ $item->gender }}"
                                                                data-nisn="{{ $item->nisn }}"
                                                                data-father_name="{{ $item->father_name }}"
                                                                data-parent_phone="{{ $item->parent_phone }}"
                                                                data-address="{{ $item->address }}" data-photo="{{ $item->photo }}"
                                                                data-classes="{{ $classes }}" data-item="{{ $item }}">
                                                                <i class="fa fa-edit">
                                                                </i>
                                                                </a>
                                                            <a type="button" class="btn btn-outline-danger" href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#modalDelete" data-id="{{ $item->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $students->links() }} --}}
                            </div>
                        </div>
                    </div>
				</div>
                    <!-- Update Admin Vertically Centered Modal -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAdminTitle">Edit Data</h5>
                                    </div>
                                    <form action="{{ route('admin.student.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <input type="text" id="update_id" hidden name="id">
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="nameWithTitle" class="form-label">Nama</label>
                                                    <input type="text" id="update_name" name="name" class="form-control"
                                                        placeholder="Masukan Nama" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="text" id="update_email" class="form-control" name="email"
                                                        placeholder="xxxx@xxx.xx" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Hp</label>
                                                    <input type="text" id="update_phone" class="form-control" name="phone"
                                                        placeholder="08xxxxxxxx" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" name="gender" id="update_gender">
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">NISN</label>
                                                    <input type="text" id="update_nisn" class="form-control" name="nisn"
                                                        placeholder="Masukan Nomor Induk Siswa Nasional" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Nama Ayah</label>
                                                    <input type="text" id="update_father_name" class="form-control"
                                                        name="father_name" placeholder="Masukan Nama Ayah Kandung" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">NIK</label>
                                                    <input type="text" id="update_nik" class="form-control" name="nik"
                                                        placeholder="Masukan NIK" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Tempat Lahir</label>
                                                    <input type="text" id="update_born_at" class="form-control" name="born_at"
                                                        placeholder="Masukan Tempat Lahir" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" id="update_birthday" class="form-control" name="birthday" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">HP Orang Tua</label>
                                                    <input type="text" id="update_parent_phone" class="form-control"
                                                        name="parent_phone" placeholder="Masukan Nama Orang Tua" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Alamat</label>
                                                    <textarea id="update_address" class="form-control" name="address" placeholder="Masukan Alamat Siswa"></textarea>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Kelas</label>
                                                    <select class="form-control" name="class_id" id="update_class_id">
                                                    </select>
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Foto</label>
                                                    <input type="file" id="update_photo" class="form-control" name="photo" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                                Tutup
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Admin Vertically Centered Modal -->
                    <div class="col-lg-4 col-md-6">
                        <!-- Modal -->
                        <div class="modal fade" id="modalStore" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAdminTitle">Tambah Data</h5>
                                    </div>
                                    <form action="{{ route('admin.student.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="nameWithTitle" class="form-label">Nama</label>
                                                    <input type="text" id="" name="name" class="form-control"
                                                        placeholder="Masukan Nama" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="text" id="" class="form-control" name="email"
                                                        placeholder="xxxx@xxx.xx" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Hp</label>
                                                    <input type="text" id="" class="form-control" name="phone"
                                                        placeholder="08xxxxxxxx" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="dobWithTitle" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" name="gender" id="">
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">NISN</label>
                                                    <input type="text" id="" class="form-control" name="nisn"
                                                        placeholder="Masukan Nomor Induk Siswa Nasional" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Nama Ayah</label>
                                                    <input type="text" id="" class="form-control" name="father_name"
                                                        placeholder="Masukan Nama Ayah Kandung" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">NIK</label>
                                                    <input type="text" id="" class="form-control" name="nik"
                                                        placeholder="Masukan Nomor Induk Sekolah" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Tempat Lahir</label>
                                                    <input type="text" id="" class="form-control" name="born_at"
                                                        placeholder="Masukan Tempat Lahir" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" id="" class="form-control" name="birthday" />
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">HP Orang Tua</label>
                                                    <input type="text" id="" class="form-control" name="parent_phone"
                                                        placeholder="Masukan Nama Orang Tua" />
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Alamat</label>
                                                    <textarea id="" class="form-control" name="address" placeholder="Masukan Alamat Siswa"></textarea>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Kelas</label>
                                                    <select class="form-control" name="class_id" id="">
                                                        @foreach ($classes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col mb-1">
                                                    <label for="emailWithTitle" class="form-label">Foto</label>
                                                    <input type="file" id="" class="form-control" name="photo" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Tutup
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
            @include('admin.layout.footer')
		</div>
        <script>
            $(document).ready(function() {
    
                $('#modalDelete').on('show.bs.modal', function(e) {
                    var id = $(e.relatedTarget).data('id');
                    $('#delete_id').val(id);
                    $('#form_delete_id').attr('action', "{{ route('admin.student.delete') }}");
                });
    
    
                $('#modalUpdate').on('show.bs.modal', function(e) {
                    var name = $(e.relatedTarget).data('name');
                    var email = $(e.relatedTarget).data('email');
                    var id = $(e.relatedTarget).data('id');
                    var status = $(e.relatedTarget).data('status');
                    var class_id = $(e.relatedTarget).data('class_id');
                    var phone = $(e.relatedTarget).data('phone');
                    var gender = $(e.relatedTarget).data('gender');
                    var nisn = $(e.relatedTarget).data('nisn');
                    var father_name = $(e.relatedTarget).data('father_name');
                    var parent_phone = $(e.relatedTarget).data('parent_phone');
                    var address = $(e.relatedTarget).data('address');
                    var photo = $(e.relatedTarget).data('photo');
                    var data = $(e.relatedTarget).data('item');
    
                    $('#update_name').val(name);
                    $('#update_email').val(email);
                    $('#update_id').val(id);
                    $('#update_status').val(status);
                    $('#update_class_id').val(class_id);
                    $('#update_phone').val(phone);
                    $('#update_gender').val(gender);
                    $('#update_nisn').val(nisn);
                    $('#update_father_name').val(father_name);
                    $('#update_parent_phone').val(parent_phone);
                    $('#update_address').val(address);
                    $('#update_photo').val(photo);
                    $('#update_born_at').val(data.born_at);
                    $('#update_birthday').val(data.birthday);
                    $('#update_nik').val(data.nik);
    
                    const jk = ['Laki-laki', 'Perempuan'];
                    jk.forEach(element => {
                        if (element == gender) {
                            $('#update_gender').append(`<option selected value="${element}">
                                           ${element}
                                      </option>`);
                        } else {
                            $('#update_gender').append(`<option value="${element}">
                                           ${element}
                                      </option>`);
                        }
                    });
    
                    var classes = $(e.relatedTarget).data('classes');
                    console.log(classes);
                    classes.forEach(element => {
                        var optionText = element.name;
                        var optionValue = element.id;
                        if (element.id == class_id) {
                            $('#update_class_id').append(`<option selected value="${optionValue}">
                                           ${optionText}
                                      </option>`);
                        } else {
                            $('#update_class_id').append(`<option value="${optionValue}">
                                           ${optionText}
                                      </option>`);
                        }
                    });
    
                });
            });
        </script>

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
