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
                    <h5 class="">Data Penilaian Mata Pelajaran {{ $course ? $course->name : null }} </h5>
                </div>
                <div class="col-8 d-flex align-items-end flex-column">
                    <div class="row">
                        <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#modalStore">
                            <i class="bx bx-plus me-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penilaian</th>
                            <th>Persentase</th>
                            <th>Deskripsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($scores as $item)
                            <tr class="table-default">
                                <td>{{ $no++ }}</td>
                                <td><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>{{ $item->percent }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate" data-item="{{ $item }}">
                                                <i class="bx bx-edit-alt me-1">
                                                </i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete" data-id="{{ $item->id }}">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate" data-name="{{ $item->name }}"
                                                data-id="{{ $item->id }}" data-admins="{{ $admins }}"
                                                data-classes="{{ $classes }}"
                                                data-admin_id="{{ $item->admin_id }}"
                                                data-class_id="{{ $item->class_id }}">
                                                <i class="bx bx-edit-alt me-1">
                                                </i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete" data-id="{{ $item->id }}">
                                                <i class="bx bx-trash me-1"></i>Delete
                                            </a> --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $scores->links() }}
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
                    <form action="{{ route('admin.course.scoring.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <input type="hidden" name="id" id="update_id">
                                    <label for="" class="form-label">Nama Penilaian</label>
                                    <input type="text" id="update_name" class="form-control" name="name"
                                        placeholder="Masukan Nama Penilaian" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Persentase</label>
                                    <input type="number" id="update_percent" class="form-control" name="percent"
                                        placeholder="10%" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" id="update_description" class="form-control" name="description"
                                        placeholder="" />
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
                    <form action="{{ route('admin.course.scoring.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <input type="hidden" name="tbl_course_id" value="{{ $course->id }}" id="id">
                                    <label for="" class="form-label">Nama Penilaian</label>
                                    <input type="text" id="update_name" class="form-control" name="name"
                                        placeholder="Masukan Nama Penilaian" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Persentase</label>
                                    <input type="number" id="update_percent" class="form-control" name="percent"
                                        placeholder="10%" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" id="update_description" class="form-control"
                                        name="description" placeholder="" />
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
                $('#form_delete_id').attr('action', "{{ route('admin.course.scoring.delete') }}");
            });


            $('#modalUpdate').on('show.bs.modal', function(e) {
                var data = $(e.relatedTarget).data('item');

                $('#update_id').val(data.id);
                $('#update_name').val(data.name);
                $('#update_percent').val(data.percent);
                $('#update_description').val(data.description);

            });
        });
    </script>
@endsection
