$(document).on("submit", "#auth-form", function (e) {
    e.preventDefault();
    const url = $(this).attr('data-action');
    const method = $(this).attr('data-method');

    $(':button').prop('disabled', true);
    $('#waitModel').show();

    $.ajax({
        url: url,
        method: method,
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
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

            } else {

                $('#auth-form').trigger("reset");

                Toastify({
                    text: "Başarıyla Giriş Yapıldı.",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#4fbe87",
                }).showToast();

                $(location).attr('href', '/admin');

            }

            $(':button').prop('disabled', false);

        },
        error: function (response) {

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

            $(':button').prop('disabled', false);
        }
    }).always(function () {
        $('#waitModel').hide();
    });
});