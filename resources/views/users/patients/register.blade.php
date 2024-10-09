@extends('users.layouts.auth')

@section('content')
    <p class="login-box-msg">Register here</p>

    <form id="patientRegistrationForm" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-alt"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-alt"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" name="id_number" class="form-control" placeholder="ID Number" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-secret"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <select name="gender" class="form-control select2" style="width: 100%;">
                <option selected="selected">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="address" class="form-control" placeholder="Address">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-book"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="next_of_kin" class="form-control" placeholder="Next of Kin">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="next_of_kin_contact" class="form-control" placeholder="Next of Kin Contacts">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone-alt"></span>
                </div>
            </div>
        </div>

        <div class="row">
            
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" id="loginSubmitBtn" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{-- <p class="mb-1">
        <a href="{{ route('users.forgot.password') }}">
            I forgot my password
        </a>
    </p> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#patientRegistrationForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('users.self.registration.store', $clinic->id) }}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: path,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        form.find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        form.find('button[type=submit]').html('Sign In');
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }   
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        var errorsHtml = '<ul>';
                        $.each(errors['errors'], function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul>';
                        toastr.error(errorsHtml);
                    }
                });
            });

        });
    </script>
@endsection
