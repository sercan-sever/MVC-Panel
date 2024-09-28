$(document).on("click", ".update-btn", function (e) {
    e.preventDefault();
    const id = $(this).attr('data-id');

    $(':button').prop('disabled', true);
    $('#waitModel').show();

    $.ajax({
        url: '/user-get',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (response) {

            if (response.success === false) {

                Toastify({
                    text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#DC3546",
                }).showToast();

                $('#add-user-modal').modal('hide');
                $(':button').prop('disabled', false);

            } else {

                $('#update-user-modal').modal('show');

                $('#update-user-form #update-id').val(response.data.id);
                $('#update-user-form #update-name').val(response.data.name);
                $('#update-user-form #update-surname').val(response.data.surname);
                $('#update-user-form #update-email').val(response.data.email);
                $('#update-user-form #update-phone').val(response.data.phone);

                $(':button').prop('disabled', false);

            }
        },
        error: function (response) {


            $(':button').prop('disabled', false);

            if (response.status === 422) {

                $.each(response.responseJSON.errors, function (key, value) {
                    Toastify({
                        text: value[0],
                        duration: 5000,
                        close: true,
                        stopOnFocus: true,
                        gravity: "top",
                        position: "right",
                        class: "top-right",
                        backgroundColor: "#DC3546",
                    }).showToast();
                });

            } else {

                Toastify({
                    text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#DC3546",
                }).showToast();

            }
        }
    }).always(function () {
        $('#waitModel').hide();
    });
});


$(document).on("click", "#update-user-modal .btn-modal-close", function (e) {
    e.preventDefault();

    $('#update-user-form').trigger("reset");
});


$(document).on("click", ".delete-btn", function (e) {
    e.preventDefault();
    const id = $(this).attr('data-id');

    $(':button').prop('disabled', true);
    $('#waitModel').show();

    $.ajax({
        url: '/user-get',
        data: {
            id: id
        },
        type: 'POST',
        dataType: 'JSON',
        success: function (response) {

            if (response.success === false) {

                Toastify({
                    text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#DC3546",
                }).showToast();

                $('#add-user-modal').modal('hide');
                $(':button').prop('disabled', false);

            } else {

                $('#delete-user-modal').modal('show');

                $('#delete-user-form #delete-id').val(response.data.id);

                $(':button').prop('disabled', false);

            }
        },
        error: function (response) {


            $(':button').prop('disabled', false);

            if (response.status === 422) {

                $.each(response.responseJSON.errors, function (key, value) {
                    Toastify({
                        text: value[0],
                        duration: 5000,
                        close: true,
                        stopOnFocus: true,
                        gravity: "top",
                        position: "right",
                        class: "top-right",
                        backgroundColor: "#DC3546",
                    }).showToast();
                });

            } else {

                Toastify({
                    text: (response.message) ? response.message : "Bir Hata Oluştu Lütfen Sayfayı Yenileyerek Tekrar Deneyiniz !!!",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#DC3546",
                }).showToast();

            }
        }
    }).always(function () {
        $('#waitModel').hide();
    });
});

$(document).on("click", "#delete-user-modal .btn-modal-close", function (e) {
    e.preventDefault();

    $('#delete-user-form').trigger("reset");
});