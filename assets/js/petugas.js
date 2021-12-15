$(document).ready(function(){
   
    $(this).on('click','.btn_hapus_balas',function(){
        var id_sttlp = $(this).attr('id');
        // alert(id_sttlp);
        Swal.fire({
            title: 'Yakin hapus STTLP?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus'
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: '../petugas_con/deleteInbox/'+id_sttlp,
                    type: 'POST',
                    data: {id_sttlp:id_sttlp},
                    dataType: 'JSON',
                    success:function(data){
                        if(data == 'sukses'){
                            Swal.fire(
                                'Terhapus!',
                                'STTLP berhasil dihapus.',
                                'success',
                              )
                              .then(function(){
                                $('#tablebalas').DataTable().ajax.reload();
                              });
                        }else{
                            Swal.fire(
                                'Gagal!',
                                'STTLP gagal dihapus.',
                                'error',
                              )
                        }
                    }        
                })
            }
        });
    });
    $(this).on('click','.btn_hapus_akun',function(){
        var id_pelapor = $(this).attr('id');
        // alert(id_sttlp);
        Swal.fire({
            title: 'Yakin Hapus Akun?',
            text: "Akun tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus'
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url: '../petugas_con/deleteProfileAkun/'+id_pelapor,
                    type: 'POST',
                    data: {id_pelapor:id_pelapor},
                    dataType: 'JSON',
                    success:function(data){
                        if(data == 'sukses'){
                            Swal.fire(
                                'Terhapus!',
                                'Akun berhasil dihapus.',
                                'success',
                              )
                              .then(function(){
                                $('#tablepelapor').DataTable().ajax.reload();
                              });
                        }else{
                            Swal.fire(
                                'Gagal!',
                                'Akun gagal dihapus.',
                                'error',
                              )
                        }
                    }        
                })
            }
        });
    });
    
    $('#input-kk').fileinput({
        "showRemove" : false,
        "showUpload" : false,
    })
    $('#input-ktp').fileinput({
        "showRemove" : false,
        "showUpload" : false,
    })
    
    $(this).on('click','.btn_updatebalas',function(){
        id = $(this).attr('id');
        window.location = '../petugas_con/pesanBalasan/' + id;
    })
    $(this).on('click','.btn_balas',function(){
        id = $(this).attr('id');
        window.location = 'petugas_con/pesanBalasan/' + id;
    })
    $(this).on('click','#submitbalasan',function(){
        var id = $('#idsttlp_req').val();
        var berkas = $('#berkas').val();
        var statusProses = $('#statusProses').val();
        var isibalasan = $('#isibalasan').val();
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
                    url:'../submitBalasan',
                    data: {id:id,berkas:berkas,statusProses:statusProses,isibalasan:isibalasan},
                    type: 'POST',
                    dataType: 'JSON',
                    success:function(data){
                        if(data == 'gagal'){
                            console.log('gagal insert')
                        }else if(data == 'sukses'){
                            $('.balaslaporan').modal('toggle');
                            Swal.fire(
                                'Terkirim!',
                                'Laporan anda sudah dikirim.',
                                'success',
                              )
                              .then(function(){
                                location.reload();
                              });
                        }else if(data == 'sama'){
                            $('.balaslaporan').modal('toggle');
                            Swal.fire(
                                'Opps!',
                                'Tidak ada perubahan dari penginputan.',
                                'warning',
                              )
                              .then(function(){
                                location.reload();
                              });
                        }else if(data.error){
                            $('.error-berkas').html(data['berkas'])
                            $('.error-statusProses').html(data['statusProses'])
                        }
                        
                    }
                })
            }
        })
        
    })
    $(this).on('click','#simpanActive',function(){
        var email = $('#email_pelapor').val();
        var status = $('#status_pelapor').val();
        Swal.fire({
            title: (status == 1)?'Aktifkan Akun Ini?':'Non-Aktifkan Akun Ini?',
            text: "Jika yakin, silahkan klik simpan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, simpan'
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({    
                    url:'../updateAktivasi',
                    data: {status:status,email:email},
                    type: 'POST',
                    dataType: 'JSON',
                    success:function(data){
                        if(data == 'gagal'){
                            Swal.fire(
                                'Gagal update!',
                                'Perubahan pada akun gagal.',
                                'error',
                              )
                        }else if(data == 'sukses'){
                            Swal.fire(
                                'Berhasil update!',
                                'Perubahan pada akun berhasil.',
                                'success',
                              )
                              .then(function(){
                                location.reload();
                              });
                        }
                    }
                })
            }
        })
        
    })
})

// Datatables
$(document).ready( function () {
    $('#tablesurat').DataTable({
        "language": {
            "emptyTable": "Tidak Ada STTLP Masuk",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, 
        "serverSide": true, 
        ajax: {
            url: "petugas_con/inboxSurat",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [4],
            "className": "text-center",
            "orderable": false
        }],
        "columns": [
            { "width": "15%" },
            null,
            null,
            null,
            null
          ]
    });

    $('#tablebalas').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Balasan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, 
        "serverSide": true, 
        ajax: {
            url: "../petugas_con/inboxBalasan",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [4],
            "className": "text-center",
            "orderable": false
        }],
        "columns": [
            { "width": "20%" },
            null,
            null,
            null,
            null
          ]
    });
    $('#tablepelapor').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Akun",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, 
        "serverSide": true, 
        ajax: {
            url: "../petugas_con/listPelapor",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [4],
            "className": "text-center",
            "orderable": false
        },
        {
            "targets": [3],
            "className": "text-center",
        }],
        "columns": [
            { "width": "0%" },
            null,
            null,
            null,
            null
          ]
    });
    $('#tablepetugas').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Akun Petugas",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "columnDefs": [
        {
            "targets": [0,3,4],
            "className": "text-center",
        }
    ],
        "columns": [
            { "width": "0%" },
            null,
            null,
            { "width": "20%" },
            null,
          ]
    });

});