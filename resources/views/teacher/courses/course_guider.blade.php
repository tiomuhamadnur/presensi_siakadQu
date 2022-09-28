@extends('teacher.layout.base')
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
                    <h5 class="">Mata Pelajaran Kelas {{ $class->name }}</h5>
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
                                <td>{{ $item->teacher ? $item->teacher->name : '-' }}</td>
                                <td>{{ $item->class ? $item->class->name : 'kelas sudah dihapus' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('teacher.course.student.index', ['course_id' => $item->id]) }}">
                                                <i class='bx bxs-user-badge bx-tada'></i> Siswa
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('teacher.course.student.index', ['course_id' => $item->id]) }}">
                                                <i class='bx bxs-user-badge bx-tada'></i> Data Penilaian
                                            </a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdate" data-name="{{ $item->name }}"
                                                data-id="{{ $item->id }}"
                                                data-teacher_id="{{ $item->teacher_id }}"
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
                {{ $courses->links() }}
            </div>
        </div>
    </div>
    <!--/ Contextual Classes -->

    <script>

    </script>
@endsection
