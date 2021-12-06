$(document).ready(function(){
    $('#submit_regis').on('submit',function(e){
        
        e.preventDefault();
        $.ajax({
            url:"auth/dodaftar",
            type:"POST",
            dataType: "json",
            data:new FormData(this),
            processData: false,
            contentType: false,
            async:false,
            success: function(data){
                if(data.sukses == true){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Anda berhasil daftar akun',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                            location.reload();
                    });
                }else if(data == 'gagal'){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Gagal daftar akun',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        location.reload();
                    });
                }else if(data.error == true){
                    $('.error-nama-reg').html(data['nama'])
                    $('.error-email-reg').html(data['email'])
                    $('.error-jk-reg').html(data['jk'])
                    $('.error-password-reg').html(data['pass'])
                    $('.error-repassword').html(data['repass'])
                    $('.error-input-ktp').html(data['input_ktp'])
                    $('.error-input-kk').html(data['input_kk'])
                }else if(data.error_upload == true){
                    console.log(data)
                    $('.error-input-ktp').html(data['error_ktp'])
                    $('.error-input-kk').html(data['error_kk'])
                }
            }
        });
        // var data = [
        //    {pp: $('#upload_pp').val(), email: $('#email_p').val(), nomor: $('#nomor_p').val(), jk: $('#jk_p').val(), alamat: $('#alamat_p').val()
        //    ,ktp: $('#input-ktp').val(),kk: $('#input-kk').val() }
        // //    pp: $('.upload_pp').val(),
        // ];

        // data.forEach(element => {
        //     console.log(element)
        // });
    });
})
