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
                    <h5 class="">Absensi</h5>
                </div>
                <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                    <div class="row" style="width: 40%">
                        <div class="col-10">
                            {{-- <form action="{{ route('teacher.present.index') }}">
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="filter_category" name="teacher_id"
                                        aria-label="Filter Teacher">
                                        <option value="" selected>All</option>
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
                            </form> --}}
                        </div>
                        {{-- <div class="col-2">
                            <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#modalStore">
                                <span class="tf-icons bx bx-plus"></span>
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Pengampu</th>
                            <th>Kelas</th>
                            {{-- <th>Jadwal</th> --}}
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
                                <td>{{ $item->class->name }}</td>
                                {{-- @php
                                    $presentController = new \App\Http\Controllers\Admin\Present\PresentController();
                                    $scheduleDay = $presentController->getDayString($item->schedule);
                                @endphp --}}
                                {{-- <td>{{ $scheduleDay }}, {{ $item->start_time }} - {{ $item->end_time }}</td> --}}
                                <td>
                                    <a class="btn rounded-pill btn-primary"
                                        href="{{ route('teacher.present.by_class.index', ['course_id' => $item->id, 'class_id' => $item->class_id]) }}">
                                        <i class='bx bxs-user-badge bx-tada'></i> Absensi
                                    </a>
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
@endsection
