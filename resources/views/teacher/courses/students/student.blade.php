@extends('teacher.layout.base')
@php
    $className = $class ? " - " . $class->name : null;
    $title = $course ? $course->name . $className : null
@endphp
@section('title', $title)

@section('custom_css')
    <!-- datatable style -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- bootstrap 4 css  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- css tambahan  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
@endsection

@section('navbar')
    @include('teacher.layout.navbar')
    @include('teacher.layout.toast')
@endsection

@section('content')
    <!-- Contextual Classes -->
    <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
        <div class="card">
            <div class="row card-header">
                <div class="col-4 d-flex justify-content-start flex-column">
                    <h6 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">
                            <a href="{{ route('teacher.class.index') }}">Kelas
                                {{ $class ? $class->name : null }}</a>
                            /
                        </span>
                        <span class="text-muted fw-light"><a href="{{ route('teacher.course.index') }}">Matpel
                                {{ $course ? $course->name : null }}</a>
                            /</span> Siswa
                    </h6>
                </div>
                <div class="col-8 d-flex align-items-end flex-column">
                    <form action="{{ route('teacher.course.student.sync') }}" method="POST">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $class_id }}">
                        <input type="hidden" name="course_id" value="{{ $course_id }}">
                        <button type="submit" class="btn btn-outline-primary"><i class='bx bx-sync'></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama</th>
                            <th>Kelas</th>
                            <th>email</th>
                            <th>Nilai Akhir</th>
                            <th>Presensi</th>
                            @if ($is_editor)
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($transCourse as $item)
                            <tr class="table-default">
                                <td>{{ $no++ }}</td>
                                <td><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>{{ $item->class_name }}</td>
                                <td>{{ $item->email }}</td>
                                @php
                                    $totalScore = 0;
                                    foreach ($item->transScores as $key => $value) {
                                        $totalScore = $totalScore + ($value->score * $value->percent) / 100;
                                    }
                                @endphp
                                <td>{{ $totalScore }}</td>
                                <td>
                                    {{ $item->presents->where('status', 1)->count() }} Hadir |
                                    {{ $item->presents->where('status', 0)->count() }} Absen |
                                    {{ $item->presents->where('status', 3)->count() }} Izin |
                                    {{ $item->presents->whereNotIn('status', [0, 1, 3])->count() }} Sakit
                                    {{-- / --}}
                                    {{-- {{ $item->presents->count() }} Pertemuan --}}
                                </td>
                                @if ($is_editor)
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('teacher.course.student.score.index', ['id' => $item->trans_id]) }}">
                                            <i class='bx bxs-user-badge bx-tada'></i> Detail Nilai
                                        </a>
                                        <a class="btn btn-primary" href="{{route('teacher.present.history.index', ['trans_course_id' => $item->id])}}"><i class='bx bx-history'></i> Kehadiran</a>
                                    </td>
                                @endif
                                {{-- <td>{{ $item->assesment_score }}</td>
                                <td>{{ $item->quiz_score }}</td>
                                <td>{{ $item->mid_score }}</td>
                                <td>{{ $item->final_score }}</td>
                                <td>{{ $item->total_score }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate" data-name="{{ $item->student->name }}"
                                                data-email="{{ $item->student->email }}" data-id="{{ $item->id }}"
                                                data-assesment_score="{{ $item->assesment_score }}"
                                                data-quiz_score="{{ $item->quiz_score }}"
                                                data-mid_score="{{ $item->mid_score }}"
                                                data-final_score="{{ $item->final_score }}"
                                                data-total_score="{{ $item->total_score }}">
                                                <i class="bx bx-edit-alt me-1">
                                                </i>
                                                Edit</a>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transCourse->links() }}
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
                    <form action="{{ route('teacher.course.student.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="text" id="update_id" hidden name="id">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="nameWithTitle" class="form-label">Nama Siswa</label>
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
                                    <label for="nameWithTitle" class="form-label">Nilai Tugas</label>
                                    <input type="text" id="update_assesment_score" name="assesment_score"
                                        class="form-control" placeholder="Masukan Nilai Tugas" />
                                </div>
                                <div class="col mb-1">
                                    <label for="nameWithTitle" class="form-label">Nilai Quiz</label>
                                    <input type="text" id="update_quiz_score" name="quiz_score" class="form-control"
                                        placeholder="Masukan Nilai Tugas" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="nameWithTitle" class="form-label">Nilai UTS</label>
                                    <input type="text" id="update_mid_score" name="mid_score" class="form-control"
                                        placeholder="Masukan Nilai Tugas" />
                                </div>
                                <div class="col mb-1">
                                    <label for="nameWithTitle" class="form-label">Nilai UAS</label>
                                    <input type="text" id="update_final_score" name="final_score" class="form-control"
                                        placeholder="Masukan Nilai Tugas" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="nameWithTitle" class="form-label">Nilai Akhir</label>
                                    <input type="text" id="update_total_score" name="total_score"
                                        class="form-control" placeholder="Masukan Nilai Tugas" />
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
                    <form action="{{ route('teacher.course.student.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-1">
                                    <label for="" class="form-label">Mata Pelajaran</label>
                                    <input type="text" disabled id="" class="form-control"
                                        value="{{ $course ? $course->name : null }}" />
                                    <input type="text" hidden id="" class="form-control" name="class_id"
                                        value="{{ $course ? $course->class_id : null }}" />
                                    <input type="text" hidden id="" class="form-control" name="course_id"
                                        value="{{ $course ? $course->id : null }}" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Mata Pelajaran</label>
                                    <input type="text" disabled id="" class="form-control"
                                        value="{{ $course ? $course->class->name : null }}" />
                                </div>
                                <div class="col mb-1">
                                    <label for="" class="form-label">Pilih Siswa</label>
                                    <select class="form-control" name="student_id" id="">
                                        @foreach ($students as $item)
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

    {{-- Modal Present --}}
    <div class="modal fade" id="modalPresent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="present_title">Siswa ini hadir ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_present_id" action="{{ route('teacher.course.student.present') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="text" name="student_id" id="present_student_id" hidden
                                    class="form-control">
                                <input type="text" name="trans_course_id" id="present_trans_course_id" hidden
                                    class="form-control">
                                <input type="text" name="status" id="present_status" value="1" hidden
                                    class="form-control">
                                <input type="text" name="description" id="present_description" hidden
                                    class="form-control">
                                <input type="datetime" name="on"
                                    value="{{ \Carbon\Carbon::now()->toDateTimeString() }}" id="present_on" hidden
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Hadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL PRESENT --}}

    {{-- Modal Un Present --}}
    <div class="modal fade" id="modalUnPresent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Tidak Hadir ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_unpresent_id" action="{{ route('teacher.course.student.present') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-mb-2">
                                <small class="text-light fw-semibold d-block">Status Kehadiran</small>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="unpresent_id"
                                        value="0">
                                    <label class="form-check-label" for="unpresent_id">Tidak Hadir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="sick_id"
                                        value="2">
                                    <label class="form-check-label" for="sick_id">Sakit</label>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <label for="" class="form-label">Deskripsi</label>
                                <input type="text" name="description" id="unpresent_description"
                                    class="form-control">

                                <input type="text" value="{{ \Carbon\Carbon::now()->toDateTimeString() }}"
                                    name="on" id="unpresent_on" hidden class="form-control">
                                <input type="text" name="student_id" id="unpresent_student_id" hidden
                                    class="form-control">
                                <input type="text" name="trans_course_id" id="unpresent_trans_course_id" hidden
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL UNPRESENT --}}

    <script>
        $(document).ready(function() {

            $('#modalDelete').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_id').val(id);
                $('#form_delete_id').attr('action', "{{ route('teacher.course.student.delete') }}");
            });


            $('#modalUpdate').on('show.bs.modal', function(e) {
                var name = $(e.relatedTarget).data('name');
                var email = $(e.relatedTarget).data('email');
                var id = $(e.relatedTarget).data('id');
                var assesment_score = $(e.relatedTarget).data('assesment_score');
                var quiz_score = $(e.relatedTarget).data('quiz_score');
                var mid_score = $(e.relatedTarget).data('mid_score');
                var final_score = $(e.relatedTarget).data('final_score');
                var total_score = $(e.relatedTarget).data('total_score');

                $('#update_name').val(name);
                $('#update_email').val(email);
                $('#update_id').val(id);
                $('#update_assesment_score').val(assesment_score);
                $('#update_quiz_score').val(quiz_score);
                $('#update_mid_score').val(mid_score);
                $('#update_final_score').val(final_score);
                $('#update_total_score').val(total_score);

            });

            $('#modalPresent').on('show.bs.modal', function(e) {
                var student_id = $(e.relatedTarget).data('student_id');
                var trans_course_id = $(e.relatedTarget).data('id');

                $('#present_student_id').val(student_id);
                $('#present_trans_course_id').val(trans_course_id);


            });

            $('#modalUnPresent').on('show.bs.modal', function(e) {
                var student_id = $(e.relatedTarget).data('student_id');
                var trans_course_id = $(e.relatedTarget).data('id');

                $('#unpresent_student_id').val(student_id);
                $('#unpresent_trans_course_id').val(trans_course_id);


            });

        });
    </script>
@endsection

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
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <!-- fungsi datatable -->
    <script>
        $(document).ready(function() {
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
