$(document).ready(function(){
    $(this).on('click','#submitsurat',function(){
        var nama = $('#nama').val();
        var tempat = $('#tempat').val();
        var tgl = $('#datepicker').val();
        var isilapor = $('#isilapor').val();
        // var file = $('#file').val();

        // alert(tgl);
        Swal.fire({
            title: 'Apakah sudah benar?',
            text: "Jika sudah, silahkan klik kirim",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, kirim'
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({    
                    url:'../pengguna_con/submitLaporan',
                    data: {nama:nama,tempat:tempat,tgl:tgl,isilapor:isilapor},
                    type: 'POST',
                    dataType: 'JSON',
                    success:function(data){
                       
                        if(data == 'gagal'){
                            console.log('gagal insert')
                        }else if(data == 'sukses'){
                            $('.buatlaporan').modal('toggle');
                            Swal.fire(
                                'Terkirim!',
                                'Laporan anda sudah dikirim.',
                                'success',
                              )
                              .then(function(){
                                location.reload();
                              });
                        }else if(data.error){
                            $('.error-nama').html(data['nama'])
                            $('.error-tempat').html(data['tempat'])
                            $('.error-tgl').html(data['tgl'])
                            $('.error-isilap').html(data['isilapor'])
                        }
                        
                    }
                })
            }
        })
        
    })
    $(this).on('click','.btn-buka',function(){
        var id_surat = $(this).attr('id');
        var count = (location.pathname.split('/').length - 1) - (location.pathname[location.pathname.length - 1] == '/' ? 1 : 0);
        if(count == 3){
            $.ajax({
                url: '../pengguna_con/viewLaporan/'+id_surat,
                type: 'POST',
                data: {id_surat:id_surat},
                success:function(){
                    window.location.href = '../pengguna_con/viewLaporan/'+id_surat;
                }        
            })
        }else{
            $.ajax({
                url: '../../pengguna_con/viewLaporan/'+id_surat,
                type: 'POST',
                data: {id_surat:id_surat},
                success:function(){
                    window.location.href = '../../pengguna_con/viewLaporan/'+id_surat;
                }        
            })
        }
    });
    
    $('#input-kk').fileinput({
        "showRemove" : false,
        "showUpload" : false,
    })
    $('#input-ktp').fileinput({
        "showRemove" : false,
        "showUpload" : false,
    })
    $('#submit_p').on('submit',function(e){
        
        e.preventDefault();
        $.ajax({
            url:"../pengguna_con/saveProfile",
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
                        title: 'Berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        if(data.data['email'] != data.old_email){
                            window.location.href = '../auth/logout';
                            $('.pesan').html('<div class="alert alert-success alert-dismissible" role="alert">Email diubah, silahkan login kembali.<span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span></div>');
                        }else{
                            location.reload();
                        }
                    });
                }else if(data == 'gagal'){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Gagal menyimpan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        location.reload();
                    });
                }else if(data.error == true){
                    $('.error-nama_p').html(data['nama_p'])
                    $('.error-email_p').html(data['email_p'])
                    $('.error-jk_p').html(data['jk_p'])
                    $('.error-nomor_p').html(data['nomor_p'])
                    $('.error-alamat_p').html(data['alamat_p'])
                }else if(data.error_upload == true){
                    console.log(data)
                    $('.error-input_pp').html(data['error_pp'])
                    $('.error-input_ktp').html(data['error_ktp'])
                    $('.error-input_kk').html(data['error_kk'])
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
