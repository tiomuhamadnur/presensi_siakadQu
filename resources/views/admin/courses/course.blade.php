@extends('admin.layout.base')
@section('navbar')
    @include('admin.layout.navbar')
    @include('admin.layout.toast')
@endsection

@section('content')
    <!-- Contextual Classes -->
    <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
        <div class="card">
            <div class="row card-header">
                <div class="col-4 d-flex justify-content-start flex-column">
                    <h5 class="">Data Mata Pelajaran</h5>
                </div>
                <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                    <div class="row" style="width: 40%">
                        <div class="col-10">
                            <form action="{{ route('admin.course.index') }}">
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="filter_category" name="class_id"
                                        aria-label="Filter Teacher">
                                        <option value="">Kelas</option>
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
                                        <option value="">Guru</option>
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
                                        id="filter_btn_id"><i class="bx bx-filter-alt"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#modalStore">
                                <span class="tf-icons bx bx-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pengampu</th>
                            <th>Kelas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($courses as $item)
                            <tr class="table-default">
                                <td>{{ $no++ }}</td>
                                <td><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>{{ $item->teacher ? $item->teacher->name : 'guru sudah dihapus' }}</td>
                                <td>{{ $item->class ? $item->class->name : 'kelas sudah dihapus' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.course.student.index', ['course_id' => $item->id]) }}">
                                                <i class='bx bxs-user-badge bx-tada'></i> Siswa
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate" data-name="{{ $item->name }}"
                                                data-id="{{ $item->id }}" data-teachers="{{ $teachers }}"
                                                data-classes="{{ $classes }}"
                                                data-teacher_id="{{ $item->teacher_id }}"
                                                data-class_id="{{ $item->class_id }}">
                                                <i class="bx bx-edit-alt me-1">
                                                </i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete" data-id="{{ $item->id }}">
                                                <i class="bx bx-trash me-1"></i>Delete
                                            </a>
                                        </div>
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
                    <form action="{{ route('admin.course.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Nama Matpel</label>
                                    <input type="text" id="update_name" class="form-control" name="name"
                                        placeholder="Masukan Nama Mata Pelajaran" />
                                        <input type="hidden" id="update_id" class="form-control" name="id"/>
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Pengampu</label>
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
                    <form action="{{ route('admin.course.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Nama Matpel</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Masukan Nama Mata Pelajaran" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Pengampu</label>
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

    <script>
        $(document).ready(function() {

            $('#modalDelete').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_id').val(id);
                $('#form_delete_id').attr('action', "{{ route('admin.course.delete') }}");
            });


            $('#modalUpdate').on('show.bs.modal', function(e) {
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
@endsection
