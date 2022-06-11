@extends('layout.base')
@section('navbar')
    @include('layout.navbar')
    @include('layout.toast')
@endsection

@section('content')
    <style>
        .text-area {
            height: 500px;
        }

    </style>
    <!-- Contextual Classes -->
    <div class="container-xxl flex-grow-1 container-p-y" style="min-height: 400px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Pengaturan Umum</h5>
                    <form action="{{ route('admin.general.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" hidden value="{{ $data ? $data->id : 0 }}" name="id">
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password32">Tentang</label>
                                <div class="input-group input-group-merge">
                                    <textarea disabled name="about" class="form-control text-area" id="about_id"
                                        aria-label="With textarea">{{ $data ? $data->about : 0 }}</textarea>
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password32">Kebijakan</label>
                                <div class="input-group input-group-merge">
                                    <textarea disabled name="policy" class="form-control text-area" id="policy_id"
                                        aria-label="With textarea">{{ $data ? $data->policy : 0 }}</textarea>
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password32">Transparansi</label>
                                <div class="input-group input-group-merge">
                                    <textarea disabled name="transparent" class="form-control text-area" id="transparent_id"
                                        aria-label="With textarea">{{ $data ? $data->transparent : 0 }}</textarea>
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-password32">Slider</label>
                                        <div class="input-group input-group-merge">
                                            <select name="section_1" id="" class="form-control">
                                                @foreach ($post_categories as $item)
                                                    @if ($item->id == ($data ? (int) $data->section_1 : 0))
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-password32">Program Spesial</label>
                                        <div class="input-group input-group-merge">
                                            <select name="section_2" id="" class="form-control">
                                                @foreach ($post_categories as $item)
                                                    @if ($item->id == ($data ? (int) $data->section_2 : 0))
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-password32">Doa Orang Baik</label>
                                        <div class="input-group input-group-merge">
                                            <select name="section_3" id="" class="form-control">
                                                @foreach ($post_categories as $item)
                                                    @if ($item->id == ($data ? (int) $data->section_3 : 0))
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <a class="btn rounded-pill btn-info" id="btn_edit_id" type="a">Edit</a>&nbsp;
                                    <a class="btn rounded-pill btn-danger" id="btn_cancel_id" type="a">Batal</a>&nbsp;
                                    <button type="submit" id="btn_submit_id"
                                        class="btn rounded-pill btn-primary">Simpan</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#btn_submit_id').hide();
            $('#btn_cancel_id').hide();

            var about = $("#about_id").val();
            var policy = $("#policy_id").val();
            var transparent = $("#transparent_id").val();

            $('#btn_edit_id').on('click', function(e) {
                $('#btn_edit_id').hide();
                $('#btn_cancel_id').show();
                $('#btn_submit_id').show();
                $('.text-area').prop('disabled', false);

                $("#about_id").hide();
                $("#policy_id").hide();
                $("#transparent_id").hide();

                $("#cke_about_id").show();
                $("#cke_policy_id").show();
                $("#cke_transparent_id").show();

                var about = document.getElementById("about_id");
                CKEDITOR.replace(about, {
                    language: 'en-gb'
                });
                var policy = document.getElementById("policy_id");
                CKEDITOR.replace(policy, {
                    language: 'en-gb'
                });
                var transparent = document.getElementById("transparent_id");
                CKEDITOR.replace(transparent, {
                    language: 'en-gb'
                });
                CKEDITOR.config.allowedContent = true;
            });

            $('#btn_cancel_id').on('click', function(e) {
                $('#btn_cancel_id').hide();
                $('#btn_submit_id').hide();
                $('.text-area').prop('disabled', true);
                $('#btn_edit_id').show();

                $("#cke_about_id").hide();
                $("#cke_policy_id").hide();
                $("#cke_transparent_id").hide();

                $("#about_id").attr('style', 'visibility: show');
                $("#policy_id").attr('style', 'visibility: show');
                $("#transparent_id").attr('style', 'visibility: show');

                $("#about_id").val(about);
                $("#policy_id").val(policy);
                $("#transparent_id").val(transparent);
            });

            $('#modalDelete').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $('#delete_id').val(id);
                $('#form_delete_id').attr('action', "{{ route('admin.users.admin.delete') }}");
            });


            $('#modalAdmin').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var status = $(e.relatedTarget).data('status');
                var email = $(e.relatedTarget).data('email');

                $('#update_name').val(name);
                $('#update_status').val(status);
                $('#update_email').val(email);
                $('#update_id').val(id);

                $('#is_change_password').prop(function() {
                    alert('Checkbox checked!');
                });

                $('#update_password').hide();
                $('#is_change_password').prop('checked', false);
                $("#is_change_password").click(function() {
                    if ($("#is_change_password").is(
                            ":checked")) {
                        $('#update_password').show();
                    } else {
                        $('#update_password').hide();
                    }
                });

            });
        });
    </script>
@endsection
