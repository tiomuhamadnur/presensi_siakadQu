
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
								<h2 class="text-white pb-2 fw-bold mt--2">Data Mata Pelajaran</h2>
								<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi Daarul Qur'an</h2>
							</div>
						</div>
					</div>
                <div class="page-inner mt--5">
    <!-- Contextual Classes -->
    <!--/ Contextual Classes -->    
    <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
        <div class="card">
            <div class="row card-header">
                <div class="col-4 d-flex justify-content-start flex-column">
                    <h5 class="">Data Mata Pelajaran</h5>
                </div>
                <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                    <div class="row" style="width: 60%">
                        <div class="col-10">
                            <form action="{{ route('admin.course.index') }}">
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="filter_category" name="class_id"
                                        aria-label="Filter Teacher" style="width: 2rem; height:2rem;">
                                        <option value=""><i class="fa fa-user">Kelas</i></option>
                                        @foreach ($classes as $item)
                                            @if ($class_id)
                                                @if ($class_id == $item->id)
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endif
                                            @else
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>&nbsp;
                                    <select class="form-control" id="filter_category" name="teacher_id"
                                        aria-label="Filter Teacher">
                                        <option value=""><i class="fa fa-users">Guru</i></option>
                                        @foreach ($teachers as $item)
                                            @if ($teacher)
                                                @if ($teacher->id == $item->id)
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endif
                                            @else
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>&nbsp;
                                    <button type="submit" class="form-control btn btn-primary" value="Filter"
                                        id="filter_btn_id"><i class="fa fa-filter"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalStore">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Pengampu</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($courses as $item)
                            <tr class="table-default">
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center"><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td class="text-center">{{ $item->teacher ? $item->teacher->name : 'guru sudah dihapus' }}</td>
                                <td class="text-center">{{ $item->class ? $item->class->name : 'kelas sudah dihapus' }}</td>
                                <td class="text-center">
                                        

                                        <div class="button text-center">
                                            <a class="btn btn-outline-dark" href="javascript:void(0);" data-toggle="modal"
                                                data-target="#modalView" data-name="{{ $item->name }}"
                                                data-id="{{ $item->id }}" data-teachers="{{ $teachers }}"
                                                data-classes="{{ $classes }}"
                                                data-teacher_id="{{ $item->teacher_id }}"
                                                data-class_id="{{ $item->class_id }}">
                                                <i class="fa fa-eye">
                                                </i>
                                            </a>

                                            <a class="btn btn-outline-warning" href="javascript:void(0);" data-toggle="modal"
                                                data-target="#modalUpdate" data-name="{{ $item->name }}"
                                                data-id="{{ $item->id }}" data-teachers="{{ $teachers }}"
                                                data-classes="{{ $classes }}"
                                                data-teacher_id="{{ $item->teacher_id }}"
                                                data-class_id="{{ $item->class_id }}">
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <a class="btn btn-outline-danger" href="javascript:void(0);" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                        
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
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
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.course.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Mata Pelajaran</label>
                                    <input type="text" id="update_name" class="form-control" name="name"
                                        placeholder="Masukan Nama Mata Pelajaran" />
                                    <input type="hidden" id="update_id" class="form-control" name="id" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Guru Pengampu</label>
                                    <select name="teacher_id" class="form-control" id="update_teacher_id">

                                    </select>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Kelas</label>
                                    <select name="class_id" class="form-control" id="update_class_id">

                                    </select>
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
        <!-- View Admin Vertically Centered Modal -->
        <div class="col-lg-4 col-md-6">
            <!-- Modal -->
            <div class="modal fade" id="modalView" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAdminTitle">Pratinjau Data</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.course.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col mb-1">
                                        <label for="" class="form-label">Mata Pelajaran</label>
                                        <input type="text" id="update_name" class="form-control" name="name"
                                            placeholder="Masukan Nama Mata Pelajaran" />
                                        <input type="hidden" id="update_id" class="form-control" name="id" />
                                    </div>
                                    <div class="col mb-1">
                                        <label for="" class="form-label">Guru Pengampu</label>
                                        <select name="teacher_id" class="form-control" id="update_teacher_id">
    
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-1">
                                        <label for="" class="form-label">Kelas</label>
                                        <select name="class_id" class="form-control" id="update_class_id">
    
                                        </select>
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
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.course.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Mata Pelajaran</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Masukan Nama Mata Pelajaran" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Guru Pengampu</label>
                                    <select name="teacher_id" class="form-control" id="teacher_id">
                                        @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Kelas</label>
                                    <select name="class_id" class="form-control" id="class_id">
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
    @include('admin.layout.footer')

    <script>
        $(document).ready(function() {

            $('#modalDelete').on('show.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_id').val(id);
                $('#form_delete_id').attr('action', "{{ route('admin.course.delete') }}");
            });s


            $('#modalUpdate').on('show.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var teacher_id = $(e.relatedTarget).data('teacher_id');
                var class_id = $(e.relatedTarget).data('class_id');

                console.log(name);

                $('#update_id').val(id);
                $('#update_name').val(name);

                var teachers = $(e.relatedTarget).data('teachers');
                teachers.forEach(element => {
                    var optionText = element.name;
                    var optionValue = element.id;
                    if (element.id == teacher_id) {
                        $('#update_teacher_id').append(`<option selected value="${optionValue}">
                                       ${optionText}
                                  </option>`);
                    } else {
                        $('#update_teacher_id').append(`<option value="${optionValue}">
                                       ${optionText}
                                  </option>`);
                    }
                });


                var classes = $(e.relatedTarget).data('classes');

                classes.forEach(element => {
                    var text = element.name;
                    var val = element.id;
                    if (element.id == class_id) {
                        $('#update_class_id').append(`<option selected value="${val}">
                                       ${text}
                                  </option>`);
                    } else {
                        $('#update_class_id').append(`<option value="${val}">
                                       ${text}
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
