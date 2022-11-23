
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

        <div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold mt--2">Guru & Wali Kelas</h2>
								<h2 class="text-white op-9 mb-2">Sistem Administrasi Akademi Daarul Qur'an</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="page-inner py-5">
                        <!-- Contextual Classes -->
                        <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
                            <div class="card mt--4">
                                <div class="row card-header">
                                    <div class="col-4 d-flex justify-content-start flex-column">
                                        <h5 class="">Data Guru</h5>
                                    </div>
                                    <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalStore">
                                            +<span class="tf-icons bx bx-plus"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive text-nowrap table-min-height">
                                    <table class="table table-head-bg-success mb-3" id="table_id">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIP</th>
                                                {{-- <th>Wali Kelas</th> --}}
                                                <th class="text-center">Email</th>
                                                {{-- <th>Status</th> --}}
                                                <th class="text-center">Kontak</th>
                                                {{-- <th>Kelamin</th> --}}
                                                {{-- <th>Alamat</th>   --}}
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($teachers as $item)
                                                <tr class="table-default">
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td class="text-center"><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                                        <strong>{{ $item->name }}</strong>
                                                    </td class="text-center">
                                                    <td class="text-center">{{ $item->nip }}</td>
                                                    {{-- <td>{{ $item->classGuiding ? $item->classGuiding->name : '-' }}</td> --}}
                                                    <td class="text-center">{{ $item->email }}</td>
                                                    {{-- <td>
                                                        @if ($item->deleted_at)
                                                            <span class="badge bg-label-danger me-1">Deleted</span>
                                                        @else
                                                            <span class="badge bg-label-primary me-1">Active</span>
                                                        @endif
                                                    </td> --}}
                                                    <td class="text-center">{{ $item->phone }}</td>
                                                    {{-- <td>{{ $item->gender }}</td> --}}
                                                    {{-- <td>{{ $item->address }}</td> --}}
                                                    <td class="text-center">
                                                                <a type="button" class="btn btn-outline-secondary" href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#modalDelete" data-id="{{ $item->id }}">
                                                                <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a type="button" class="btn btn-outline-warning" href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#modalUpdate" data-name="{{ $item->name }}"
                                                                    data-email="{{ $item->email }}" data-id="{{ $item->id }}"
                                                                    data-status="{{ $item->status }}"
                                                                    data-class_id="{{ $item->class_id }}" data-phone="{{ $item->phone }}"
                                                                    data-gender="{{ $item->gender }}" data-nisn="{{ $item->nisn }}"
                                                                    data-father_name="{{ $item->father_name }}"
                                                                    data-parent_phone="{{ $item->parent_phone }}"
                                                                    data-address="{{ $item->address }}" data-photo="{{ $item->photo }}"
                                                                    data-classes="{{ $classes }}"
                                                                    data-nip="{{ $item->nip }}"
                                                                    data-class_guiding="{{ $item->classGuiding ? $item->classGuiding->id : null }}">
                                                                    <i class="fa fa-edit">
                                                                    </i>
                                                                    </a>
                                                                <a type="button" class="btn btn-outline-danger" href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#modalDelete" data-id="{{ $item->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $teachers->links() }} --}}
                                </div>
                            </div>
                        </div>
    <!--/ Contextual Classes -->


    <!-- Update Admin Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <!-- Modal -->
        <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAdminTitle">Pratinjau Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.teacher.update') }}" method="POST">
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
                                    <label for="nameWithTitle" class="form-label">NIP</label>
                                    <input type="number" id="update_nip" name="nip" class="form-control"
                                        placeholder="Masukan NIP" />
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
                                    </select>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="emailWithTitle" class="form-label">Kelas</label>
                                    <select class="form-control" name="class_id" id="update_class_id">
                                    </select>
                                </div>
                                <div class="col mb-1">
                                    <label for="emailWithTitle" class="form-label">Alamat</label>
                                    <textarea id="update_address" class="form-control" name="address" placeholder="Masukan Alamat"></textarea>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="emailWithTitle" class="form-label">Foto</label>
                                    <input type="file" id="update_photo" class="form-control" name="photo" />
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

    <!-- Add Admin Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
        <!-- Modal -->
        <div class="modal fade" id="modalStore" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAdminTitle">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.teacher.store') }}" method="POST">
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
                                    <label for="nameWithTitle" class="form-label">NIP</label>
                                    <input type="number" id="" name="nip" class="form-control"
                                        placeholder="Masukan NIP" />
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
                                    <input type="text" id="" class="form-control" name="phone" placeholder="08xxxxxxxx" />
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
                                    <label for="emailWithTitle" class="form-label">Wali Kelas</label>
                                    <select class="form-control" name="class_id" id="">
                                        <option value="">Bukan Wali Kelas</option>
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col mb-1">
                                    <label for="emailWithTitle" class="form-label">Alamat</label>
                                    <textarea id="" class="form-control" name="address" placeholder="Masukan Alamat"></textarea>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="emailWithTitle" class="form-label">Foto</label>
                                    <input type="file" id="" class="form-control" name="photo" />
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

    <script>
        $(document).ready(function() {

            $('#modalDelete').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_id').val(id);
                $('#form_delete_id').attr('action', "{{ route('admin.teacher.delete') }}");
            });


            $('#modalUpdate').on('show.bs.modal', function(e) {
                var name = $(e.relatedTarget).data('name');
                var email = $(e.relatedTarget).data('email');
                var id = $(e.relatedTarget).data('id');
                var status = $(e.relatedTarget).data('status');
                var class_id = $(e.relatedTarget).data('class_id');
                var class_guiding = $(e.relatedTarget).data('class_guiding');
                var phone = $(e.relatedTarget).data('phone');
                var gender = $(e.relatedTarget).data('gender');
                var nisn = $(e.relatedTarget).data('nisn');
                var father_name = $(e.relatedTarget).data('father_name');
                var parent_phone = $(e.relatedTarget).data('parent_phone');
                var address = $(e.relatedTarget).data('address');
                var photo = $(e.relatedTarget).data('photo');

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
                $('#update_nip').val($(e.relatedTarget).data('nip'));

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
                classes.forEach(element => {
                    var optionText = element.name;
                    var optionValue = element.id;
                    if (element.id == class_guiding) {
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
                </div>
			</div>
            @include('admin.layout.footer')
		</div>
</div>
