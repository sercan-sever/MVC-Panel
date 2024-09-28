$(document).on("submit", "#add-user-form", function (e) {
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

                $('#add-user-form').trigger("reset");

                $('#add-tr').append(
                    `<tr id="item-` + response.data.id + `" class="text-center">
                        <td>` + response.data.name + `</td>
                        <td>` + response.data.surname + `</td>
                        <td>` + response.data.email + `</td>
                        <td>` + response.data.phone + `</td>
                        <td>
                            <button type="button" data-id="` + response.data.id + `" class="btn btn-sm btn-outline-primary update-btn">
                                <i class="fas fa-pencil"></i>
                            </button>
                            <button type="button" data-id="` + response.data.id + `" class="btn btn-sm btn-outline-danger delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`
                );

                Toastify({
                    text: "Kayıt Başarıyla Gerçekleştirildi.",
                    duration: 5000,
                    close: true,
                    stopOnFocus: true,
                    gravity: "top",
                    position: "right",
                    class: "top-right",
                    backgroundColor: "#4fbe87",
                }).showToast();

                $('#add-user-modal').modal('hide');
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

$(document).on("click", "#add-user-modal .btn-modal-close", function (e) {
    e.preventDefault();

    $('#add-user-form').trigger("reset");
});