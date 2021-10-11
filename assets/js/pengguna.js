$(document).ready(function(){
    $(this).on('click','#submitsurat',function(){
        var nama = $('#nama').val();
        var aduan = $('#aduan').val();
        var judul = $('#judul').val();
        var isilapor = $('#isilapor').val();
        var file = $('#file').val();
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
                    data: {nama:nama,aduan:aduan,isilapor:isilapor,file:file},
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
                            $('.error-aduan').html(data['aduan'])
                            $('.error-isilap').html(data['isilapor'])
                        }
                        
                    }
                })
            }
        })
        
    })
    $(this).on('click','.btn-buka',function(){
        var id_surat = $(this).attr('id');
        $.ajax({
            url: '../pengguna_con/viewLaporan/'+id_surat,
            type: 'POST',
            data: {id_surat:id_surat},
            success:function(){
                window.location.href = '../pengguna_con/viewLaporan/'+id_surat;
            }        
        })
    });
    
})