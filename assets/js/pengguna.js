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
    // $(this).on('click','.btn-regis', function(){
    //     var namareg = $('#nama-reg').val()
    //     var emailreg = $('#email-reg').val()
    //     var passreg = $('#password-reg').val()
        
    //     $.ajax({
    //         url: 'daftar',
    //         data: {namareg:namareg, emailreg:emailreg,passreg:passreg},
    //         type: 'POST',
    //         dataType: 'JSON',
    //         success: function(data){
    //         }
    //     });
    // });
})

$(document).ready(function() {
    $(this).on('click','.fileinput-upload-button',function(){
       var parents = $(this).parents('input').hasClass('input-ktp');
       console.log(parents);
    });
    $(this).on('click','#input-ktp>.fileinput-upload-button',function(){
        alert('aploded kk')
    });
    $(this).on('click','.fileinput-remove-button',function(){
        alert('terhapus')
    });
    // $("#input-b2").fileinput({
    //     success:function(){
    //         alert('anu');
    //     }
    //     uploadUrl: "/site/upload-file-chunks",
    //     enableResumableUpload: true,
    //     initialPreviewAsData: true,
    //     maxFileCount: 5,
    //     theme: 'fas',
    //     deleteUrl: '/site/file-delete',
    //     uploadExtraData: {
    //         uploadToken: "SOME_VALID_TOKEN"
    //     },
    //     overwriteInitial: false,
    //     initialPreview: [
    //         // TEXT DATA
    //         'https://kartik-v.github.io/bootstrap-fileinput-samples/samples/SampleTextFile_10kb.txt',
    //         // PDF DATA
    //         'https://kartik-v.github.io/bootstrap-fileinput-samples/samples/pdf-sample.pdf',
    //         // VIDEO DATA
    //         "https://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4"
    //     ],
    //     initialPreviewAsData: true, // defaults markup  
    //     initialPreviewConfig: [
    //         {caption: "Lorem Ipsum.txt", type: "text", description: "<h5>Content # 1</h5> Enjoy this Lorem Ipsum text.", size: 1430, url: "/site/file-delete", key: 12}, 
    //         {type: "pdf", description: "<h5>Content # 2</h5> Enjoy this sample PDF document.", size: 8000, caption: "PDF Sample.pdf", url: "/site/file-delete", key: 14}, 
    //         {type: "video", description: "<h5>Content # 3</h5> Enjoy this sample video.", size: 375000, filetype: "video/mp4", caption: "Krajee Sample.mp4", url: "/site/file-delete", key: 15} 
    //     ],
    //     preferIconicPreview: true,
    //     previewFileIconSettings: { // configure your icon file extensions
    //         'doc': '<i class="fas fa-file-word text-primary"></i>',
    //         'xls': '<i class="fas fa-file-excel text-success"></i>',
    //         'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
    //         'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
    //         'zip': '<i class="fas fa-file-archive text-muted"></i>',
    //         'htm': '<i class="fas fa-file-code text-info"></i>',
    //         'txt': '<i class="fas fa-file-alt text-info"></i>',
    //         'mov': '<i class="fas fa-file-video text-warning"></i>',
    //         'mp3': '<i class="fas fa-file-audio text-warning"></i>',
    //         // note for these file types below no extension determination logic 
    //         // has been configured (the keys itself will be used as extensions)
    //         'jpg': '<i class="fas fa-file-image text-danger"></i>', 
    //         'gif': '<i class="fas fa-file-image text-muted"></i>', 
    //         'png': '<i class="fas fa-file-image text-primary"></i>'    
    //     },
    //     previewFileExtSettings: { // configure the logic for determining icon file extensions
    //         'doc': function(ext) {
    //             return ext.match(/(doc|docx)$/i);
    //         },
    //         'xls': function(ext) {
    //             return ext.match(/(xls|xlsx)$/i);
    //         },
    //         'ppt': function(ext) {
    //             return ext.match(/(ppt|pptx)$/i);
    //         },
    //         'zip': function(ext) {
    //             return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
    //         },
    //         'htm': function(ext) {
    //             return ext.match(/(htm|html)$/i);
    //         },
    //         'txt': function(ext) {
    //             return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
    //         },
    //         'mov': function(ext) {
    //             return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
    //         },
    //         'mp3': function(ext) {
    //             return ext.match(/(mp3|wav)$/i);
    //         }
    //     }
    // }).on('fileuploaded', function(event, previewId, index, fileId) {
    //     console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
    // }).on('fileuploaderror', function(event, previewId, index, fileId) {
    //     console.log('File Upload Error', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
    // }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
    //     console.log('File Batch Uploaded', preview, config, tags, extraData);
    // });
 
    // uncomment below if you need to monitor file upload chunk status or take actions based on events
    /*
    $("#input-res-3").on('filechunkbeforesend', function(event, fileId, index, retry, fm, rm, outData) {
        console.log('File Chunk Before Send', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    }).on('filechunksuccess', function(event, fileId, index, retry, fm, rm, outData) {
        console.log('File Chunk Success', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    }).on('filechunkerror', function(event, fileId, index, retry, fm, rm, outData) {
        console.log('File Chunk Error', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    }).on('filechunkajaxerror', function(event, fileId, index, retry, fm, rm, outData) {
        console.log('File Chunk Ajax Error', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    }).on('filechunkcomplete', function(event, fileId, index, retry, fm, rm, outData) {
        console.log('File Chunk Complete', 'ID: ' + fileId + ', Index: ' + index + ', Retry: ' + retry);
    });
    */
 
    // uncomment below if you need file's test status (via resumableUploadOptions.testUrl) or take actions based on events
    /*
    $("#input-res-3").on('filetestbeforesend', function(event, fileId, fm, rm, outData) {
        console.log('File Test Before Send', 'ID: ' + fileId);
    }).on('filetestsuccess', function(event, fileId, fm, rm, outData) {
        console.log('File Test Success', 'ID: ' + fileId);
    }).on('filetesterror', function(event, fileId, fm, rm, outData) {
        console.log('File Test Error', 'ID: ' + fileId);
    }).on('filetestajaxerror', function(event, fileId, fm, rm, outData) {
        console.log('File Test Ajax Error', 'ID: ' + fileId);
    }).on('filetestcomplete', function(event, fileId, fm, rm, outData) {
        console.log('File Test Complete', 'ID: ' + fileId);
    });;
    */
});