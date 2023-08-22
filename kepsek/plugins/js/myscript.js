$('.tombol-hapus').on('click', function (e) {
    e.preventDefault();// fungsi e.preventDefault() adalah aksi default nya di hentikan dan tidak akan jalan ke href nya yang di tuju.


    const href_hapus = $(this).attr('href');//untuk mengambil href yang di tombol hapus

    swal({
        title: 'Apakah anda Yakin?',
        text: "Data ini akan di Hapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Data!'
    }, function (result) {
        if (result) {
            document.location.href = href_hapus;
        }
    })




});