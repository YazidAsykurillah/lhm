@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">My Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" id="form-complete-my-profile" action="{{ url('/my-profile/complete-profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lengkapi Profil Anda</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{ $profile->name}}" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number" class="col-sm-3 col-form-label">Nomor Telepon/WA</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone_number" value="{{ $profile->phone_number}}" placeholder="Nomor Telepon/WA">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="address">{{$profile->address}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select name="gender" class="form-control">
                            <option>---Pilih Jenis Kelamin---</option>
                            <option {{($profile->gender)=="Male"? 'selected':''}}  value="Male">Laki-Laki</option>
                            <option {{($profile->gender)=="Female"? 'selected':''}}  value="Female">Perempuan</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="photo_file" class="col-sm-3 col-form-label">Pas Photo</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="photo_file">
                    </div>
                    <div class="col-sm-5">
                        <a href="{{asset(get_public_path().'/photo-files/'.$profile->photo_file)}}" data-lightbox="{{$profile->photo_file}}" data-title="Pas foto">
                            <img class="profile-user-img img-fluid" src="{{asset(get_public_path().'/photo-files/'.$profile->photo_file)}}" alt="Pas Photo">
                        </a>
                        <input type="hidden" name="old_photo_file" value="{{$profile->photo_file}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ktp_number" class="col-sm-3 col-form-label">Nomor KTP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ktp_number" value="{{ $profile->ktp_number}}" placeholder="Nomor KTP">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ktp_file" class="col-sm-3 col-form-label">File KTP</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="ktp_file">
                    </div>
                    <div class="col-sm-5">
                        <a href="{{asset(get_public_path().'/ktp-files/'.$profile->ktp_file)}}" data-lightbox="{{$profile->ktp_file}}" data-title="File KTP">
                            <img class="profile-user-img img-fluid" src="{{asset(get_public_path().'/ktp-files/'.$profile->ktp_file)}}" alt="Foto KTP">
                        </a>
                        <input type="hidden" name="old_ktp_file" value="{{$profile->ktp_file}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_number" class="col-sm-3 col-form-label">Nomor Passport</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="passport_number" value="{{ $profile->passport_number}}" placeholder="Nomor Passport">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_file" class="col-sm-3 col-form-label">File Passport</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="passport_file">
                    </div>
                    <div class="col-sm-5">
                        <a href="{{asset(get_public_path().'/passport-files/'.$profile->passport_file)}}" data-lightbox="{{$profile->passport_file}}" data-title="File KTP">
                            <img class="profile-user-img img-fluid" src="{{asset(get_public_path().'/passport-files/'.$profile->passport_file)}}" alt="Photo Passport">
                        </a>
                        <input type="hidden" name="old_passport_file" value="{{$profile->passport_file}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" value="{{ $profile->email}}" placeholder="Email (tidak wajib diisi">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="user_id" value="{{$profile->id}}">
                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
            </div>
        </div>
        </form>
    </div>


</div>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        //Block Form complete my profile
        $('#form-complete-my-profile').on('submit', function(event){
            event.preventDefault();
            let url = $(this).attr('action');
            let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#form-complete-my-profile').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data){
                    console.log(data);
                    if(data.status == true){
                        $('#form-complete-my-profile')[0].reset();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        $('#form-complete-my-profile').find("button[type='submit']").prop('disabled', false);
                        window.location.href = data.data.url;
                    }else{
                        $('#form-complete-my-profile').find("button[type='submit']").prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let errors = jqXHR.responseJSON;
                    console.log(errors);
                    let error_template = "";
                    //console.log(textStatus);
                    $.each( errors.errors, function( key, value ){
                        console.log(value);
                        error_template += '<p>'+value+ '</p>'; //showing only the first error.
                    });
                    console.log(error_template);
                    $(document).Toasts('create',{
                        class: 'bg-danger',
                        position: 'bottomRight',
                        autohide: true,
                        delay: 5000,
                        icon: 'fas fa-exclamation-circle',
                        title: 'Error',
                        subtitle: ' Validation error',
                        body: error_template
                    });
                    $('#form-complete-my-profile').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Form complete my profile
    });
</script>
@endsection
