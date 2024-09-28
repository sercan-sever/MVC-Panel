<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karecode Test Seneryosu | Admin Page</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/toastify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include_once('includes/backend/header.php') ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('includes/backend/navbar.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Kullanıcı Listesi</h1>
                    <?php if ($auth['role'] === $role) : ?>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
                                    <i class="fa-solid fa-user-plus"></i> Kullanıcı Ekle
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle nowrap text-center table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">E-Posta</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="add-tr">
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr id="item-<?php echo $user['id'] ?? '' ?>" class="text-center">
                                        <td><?php echo $user['name'] ?? '' ?></td>
                                        <td><?php echo $user['surname'] ?? '' ?></td>
                                        <td><?php echo $user['email'] ?? '' ?></td>
                                        <td><?php echo $user['phone'] ?? '' ?></td>
                                        <td>
                                            <button type="button" data-id="<?php echo $user['id'] ?? '' ?>" class="btn btn-sm btn-outline-primary update-btn m-1">
                                                <i class="fas fa-pencil"></i>
                                            </button>
                                            <?php if ($auth['role'] === $role) : ?>
                                                <button type="button" data-id="<?php echo $user['id'] ?? '' ?>" class="btn btn-sm btn-outline-danger delete-btn m-1">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr class="text-center alert-empty">
                                    <div class="alert alert-danger" role="alert">
                                        Kullanıcı Bulunamadı
                                    </div>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php if ($auth['role'] === $role) : ?>
        <div class="modal fade" id="add-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModal">
                            Kullanıcı Ekle
                        </h5>
                        <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form data-action="/user-add" class="text-start" data-method="POST" id="add-user-form">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Ad <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Adınızı Giriniz *" required minlength="1" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label fw-bold">Soyad <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Soyadınızı Giriniz *" required minlength="1" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">E-Posta Adresi <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-Posta Adresinizi Giriniz *" required minlength="1" maxlength="255">
                                <small class="text-danger">
                                    ( Panel girişinde bu E-Posta adresini kullanacaksınız. )
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Telefon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Telefon Numaranızı Giriniz *" required minlength="10" maxlength="11">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Şifre <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Şifrenizi Giriniz *" id="password" required minlength="1" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Şifre Tekrarı <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirm" class="form-control" placeholder="Şifrenizi Tekrar Giriniz *" id="password-confirm" required minlength="1" maxlength="255">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-modal-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Kapat
                        </button>
                        <button type="submit" form="add-user-form" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="update-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateUserModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModal">
                        Kullanıcı Düzenleme
                    </h5>
                    <button type="button" class="btn-close btn-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form data-action="/user-update" class="text-start" data-method="POST" id="update-user-form">
                        <input type="hidden" id="update-id" name="id" requiredd min="1">
                        <div class="mb-3">
                            <label for="update-name" class="form-label fw-bold">Ad <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="update-name" placeholder="Adınızı Giriniz *" required minlength="1" maxlength="255">
                        </div>
                        <div class="mb-3">
                            <label for="update-surname" class="form-label fw-bold">Soyad <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="surname" id="update-surname" placeholder="Soyadınızı Giriniz *" required minlength="1" maxlength="255">
                        </div>
                        <div class="mb-3">
                            <label for="update-email" class="form-label fw-bold">E-Posta Adresi <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="update-email" placeholder="E-Posta Adresinizi Giriniz *" required minlength="1" maxlength="255">
                            <small class="text-danger">
                                ( Panel girişinde bu E-Posta adresini kullanacaksınız. )
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="update-phone" class="form-label fw-bold">Telefon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="phone" id="update-phone" placeholder="Telefon Numaranızı Giriniz *" required minlength="10" maxlength="11">
                        </div>
                        <div class="mb-3">
                            <label for="update-password" class="form-label fw-bold">Şifre </label>
                            <input type="password" name="password" class="form-control" id="update-password" placeholder="Şifrenizi Giriniz..." minlength="1" maxlength="255">
                        </div>
                        <div class="mb-3">
                            <label for="update-password-confirm" class="form-label fw-bold">Şifre Tekrarı </label>
                            <input type="password" name="password_confirm" class="form-control" id="update-password-confirm" placeholder="Şifrenizi Tekrar Giriniz..." minlength="1" maxlength="255">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-modal-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i> Kapat
                    </button>
                    <button type="submit" form="update-user-form" class="btn btn-primary">
                        <i class="fa-solid fa-rotate-left"></i> Güncelle
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($auth['role'] === $role) : ?>
        <div class="modal fade" id="delete-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0"></div>

                    <div class="modal-body">
                        <form data-action="/user-delete" data-method="POST" id="delete-user-form">
                            <input type="hidden" id="delete-id" name="id" requiredd min="1">

                            <p class="text-muted fs-6 mb-3 text-center">
                                <strong>Silmek İstediğinize Emin misiniz ?</strong>
                                <br>
                                <small class="text-center" style="color: red;">
                                    <strong>Bu İşlem Geri Alınamaz !!!</strong>
                                </small>
                            </p>
                        </form>
                    </div>

                    <div class="modal-footer border-0 justify-content-center mb-4">
                        <button type="submit" form="delete-user-form" class="btn btn-danger">
                            Hemen Sil
                        </button>
                        <button type="button" class="btn btn-primary btn-modal-close" data-bs-dismiss="modal">
                            Vazgeç
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php include_once('includes/backend/wait.php') ?>

    <script src="../assets/js/jquery-min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/toastify.min.js"></script>
    <?php if ($auth['role'] === $role) : ?>
        <script src="../assets/js/modules/admin/add.js"></script>
        <script src="../assets/js/modules/admin/delete.js"></script>
    <?php endif; ?>
    <script src="../assets/js/modules/admin/get.js"></script>
    <script src="../assets/js/modules/admin/update.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>

</html>