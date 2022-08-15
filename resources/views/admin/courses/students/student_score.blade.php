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
                    <h5 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light"><a href="{{ route('admin.course.score.index') }}">Matpel
                                {{ $transScore ? $transScore->name : null }}</a>/</span>
                        @php
                            $transCourse = null;
                            if($transScore) {
                                $transScore->transCourse;
                            }
                            $classId = null;
                            if($transCourse) {
                                $class = $transCourse->class;
                                if($class) {
                                    $classId = $class->id;
                                }
                            }
                        @endphp
                        <span class="text-muted fw-light"><a href="{{ route('admin.course.student.index', ['class_id' => $classId]) }}">Siswa
                                {{ $transScore ? $transScore->name : null }}</a>/</span> Input Nilai
                    </h5>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penilaian</th>
                            <th>Nilai</th>
                            <th>Persentase</th>
                            <th>Deskripsi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($transScores as $item)
                            <tr class="table-default">
                                <td>{{ $no++ }}</td>
                                <td>
                                    <i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>
                                    <i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->score }}</strong>
                                </td>
                                <td>{{ $item->percent }} %</td>
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
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    <form action="{{ route('admin.course.student.score.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <input type="hidden" name="id" id="update_id">
                                    <label for="" class="form-label">Nama Penilaian</label>
                                    <input type="text" disabled id="update_name" class="form-control" name="name"
                                        placeholder="Masukan Nama Penilaian" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Persentase</label>
                                    <input type="number" disabled id="update_percent" class="form-control" name="percent"
                                        placeholder="10%" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Nilai</label>
                                    <input type="number" id="update_score" class="form-control" name="score"
                                        placeholder="90" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" disabled id="update_description" class="form-control"
                                        name="description" placeholder="" />
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
            $('#modalUpdate').on('show.bs.modal', function(e) {
                var data = $(e.relatedTarget).data('item');

                $('#update_id').val(data.id);
                $('#update_name').val(data.name);
                $('#update_percent').val(data.percent);
                $('#update_description').val(data.description);
                $('#update_score').val(data.score);

            });

        });
    </script>
@endsection
