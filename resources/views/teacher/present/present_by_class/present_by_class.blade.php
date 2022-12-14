@extends('teacher.layout.base')

@php
    $courseName = $course ? $course->name : null;
    $title = "Absensi-" . $courseName;
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
                    <h5 class="fw-bold py-3 mb-4">Absensi Matpel {{ $course ? $course->name : null }}</h5>
                </div>
                <div class="col-8 d-flex align-items-end flex-column" style="padding-right: 4%;">
                    <div class="row">
                        <form
                            action="{{ route('teacher.present.by_class.index', ['course_id' => $course_id, 'class_id' => $class_id]) }}"
                            class="col-md-10" id="date_filter">
                            <div class="input-group">
                                <input type="date" value="{{ $schedule }}" name="schedule" class="form-control">
                                <input type="hidden" value="{{ $class_id }}" name="class_id" class="form-control">
                                <input type="hidden" value="{{ $course_id }}" name="course_id" class="form-control">
                                &nbsp;
                                <button form="date_filter" class="btn btn-primary" id="filter_btn_id"><i
                                        class="bx bx-filter-alt"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-start flex-column">
                    <form action="{{ route('teacher.present.by_class.do_present') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select" id="inputGroupSelect04"
                                aria-label="Example select with button addon">
                                <option selected="">Pilih Kehadiran</option>
                                <option value="1">Hadir</option>
                                <option value="0">Tidak Hadir</option>
                                <option value="2">Sakit</option>
                                <option value="3">Izin</option>
                            </select>
                            <input type="hidden" value="{{ $schedule }}" name="schedule">
                            <input type="hidden" value="{{ $course_id }}" name="course_id">
                            <input type="hidden" value="{{ $class_id }}" name="class_id">
                            <div id="new_present_form"></div>
                            <button id="btn_present_form" class="btn btn-outline-primary" type="submit"><i
                                    class='bx bxs-badge-check'></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive text-nowrap table-min-height">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="active">
                                <input type="checkbox" class="select-all checkbox" name="select-all" />
                            </th>
                            <th>nama</th>
                            <th>Kelas</th>
                            <th>Absen</th>
                            <th>Tanggal</th>
                            <th>Riwayat</th>
                        </tr>
                    </thead>

                    <input type="text" name="count_student" value="{{ count($transCourse) }}" hidden>
                    <tbody class="table-border-bottom-0">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($transCourse as $key => $item)
                            <tr class="table-default">
                                <td>{{ $no++ }}</td>
                                <td class="active">
                                    <input type="checkbox" class="select-item checkbox" name="select-item"
                                        value="{{ $item->id }}" />
                                </td>
                                <td><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                    <strong>{{ $item->student->name }}</strong>
                                </td>
                                <td>{{ $item->student->class ? $item->student->class->name : null }}</td>
                                <td>
                                    @if ($item->present)
                                        @if ($item->present->status == 1)
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-toggle="tooltip" id="btn_hadir_id" data-bs-offset="0,4"
                                                data-bs-placement="top" data-bs-html="true" title=""
                                                data-bs-original-title="<span>Hadir</span>">
                                                <i class='bx bxs-badge-check'></i>
                                            </button>
                                        @elseif($item->present->status == 2)
                                            <a href="#" data-item="{{ $item->present }}" data-bs-toggle="modal"
                                                data-bs-target="#modalPresent">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="tooltip" data-toggle="modal" data-target="#modalPresent"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title=""
                                                    data-bs-original-title="<span>Sakit : {{ $item->present->description }}</span>">
                                                    <i class='bx bx-plus-medical'></i>
                                                </button>
                                            </a>
                                        @elseif($item->present->status == 3)
                                            <a href="#" data-item="{{ $item->present }}" data-bs-toggle="modal"
                                                data-bs-target="#modalPresent">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                    data-bs-html="true" title=""
                                                    data-bs-original-title="<span>Izin : {{ $item->present->description }}</span>">
                                                    <i class='bx bxs-envelope'></i>
                                                </button>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true" title=""
                                                data-bs-original-title="<span>Tidak Ada Keterangan </span>">
                                                <i class='bx bx-calendar-x'></i>
                                            </button>
                                        @endif
                                    @else
                                        Belum ada presensi
                                    @endif
                                </td>
                                <td>
                                    @if ($schedule)
                                        {{ $schedule }}
                                    @elseif($item->on)
                                        {{ $item->on }}
                                    @else
                                        {{ \Carbon\Carbon::now()->toDateString() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('teacher.present.history.index', ['trans_course_id' => $item->id])}}"><i class='bx bx-history'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Contextual Classes -->

    {{-- Modal Present --}}
    <div class="modal fade" id="modalPresent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="present_title">Ubah Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_present_id" action="{{ route('teacher.present.by_class.update_present') }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="text" name="id" id="trans_present_id" hidden class="form-control">
                                <textarea name="description" id="trans_present_description_id" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
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
                var item = $(e.relatedTarget).data('item');

                $('#trans_present_id').val(item.id);
                $('#trans_present_description_id').val(item.description);
            });

            $('#modalUnPresent').on('show.bs.modal', function(e) {
                var student_id = $(e.relatedTarget).data('student_id');
                var trans_course_id = $(e.relatedTarget).data('id');

                $('#unpresent_student_id').val(student_id);
                $('#unpresent_trans_course_id').val(trans_course_id);


            });

        });

        $(function() {
            $('#btn_present_form').attr('disabled', true);
            //button select all or cancel
            $("#select-all").click(function() {
                var all = $("input.select-all")[0];
                all.checked = !all.checked
                var checked = all.checked;
                $("input.select-item").each(function(index, item) {
                    item.checked = checked;
                });
            });

            //button select invert
            $("#select-invert").click(function() {
                $("input.select-item").each(function(index, item) {
                    item.checked = !item.checked;
                });
                checkSelected();
            });

            //button get selected info
            $("#selected").click(function() {
                var items = [];
                $("input.select-item:checked:checked").each(function(index, item) {
                    items[index] = item.value;
                });
                if (items.length < 1) {
                    alert("no selected items!!!");
                } else {
                    var values = items.join(',');
                    console.log(values);
                    var html = $("<div></div>");
                    html.html("selected:" + values);
                    html.appendTo("body");
                }
                console.log(items);
            });

            //column checkbox select all or cancel
            $("input.select-all").click(function() {
                var checked = this.checked;
                $("input.select-item").each(function(index, item) {
                    item.checked = checked;
                });
            });

            //check selected items
            $("input.select-item").click(function() {
                var checked = this.checked;
                var items = [];
                if (checked) {
                    $("input.select-item:checked:checked").each(function(index, item) {
                        items[index] = item.value;
                        $("#new_present_form").append('<input type="hidden" name="ids[]" value="' +
                            $(
                                this).val() + '">');
                    });
                } else {
                    var check = $(this).val();
                    $('[name="ids[]"]').each(function() {
                        if ($(this).val() == check) {
                            $(this).remove();
                        }
                    });
                }
                checkSelected();
            });

            //check is all selected
            function checkSelected() {
                var all = $("input.select-all")[0];
                var total = $("input.select-item").length;
                var len = $("input.select-item:checked:checked").length;
                if (len < 1) {
                    $('#btn_present_form').attr('disabled', true);
                } else {
                    $('#btn_present_form').attr('disabled', false);
                }
                console.log("total:" + total);
                console.log("len:" + len);
                all.checked = len === total;
            }
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
                paging: false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            })
        });
    </script>
@endsection
