<?php

declare(strict_types=1);


class UserController extends Controller
{

    /**
     * @return void
     */
    public function __construct()
    {
        if (!authCheck()) {
            header('Location: http://karecode.test/logout');
            exit();
        }
    }

    /**
     * @return void
     */
    public function add(): void
    {
        try {
            $data = $this->getData();

            $result = UserCreateRequest::validated(data: $data);

            if (!empty($result['data'])) {
                $user = $this->model('User');
                $user = $user->create(data: $result['data']);

                if ($user) {
                    echo json_encode([
                        'success' => $result['success'] ?? '',
                        'message' => $result['message'] ?? '',
                        'data' => $user,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Kullanıcı Kaydı Sırasında Bir Sorun Oluştu !!!',
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => $result['success'] ?? '',
                'message' => $result['message'] ?? '',
            ]);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 23000) {
                if (str_contains($exception->getMessage(), 'users.email')) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Bu e-posta adresi zaten başka bir kullanıcı tarafından kullanılıyor !!!",
                    ]);
                }

                if (str_contains($exception->getMessage(), 'users.phone')) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Bu telefon numarası zaten başka bir kullanıcı tarafından kullanılıyor !!!",
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => false,
                /* 'message' => "İşlemler Sırasında Bir Sorun Oluştu. Sayfayı Yeniliyerek Tekrar Deneyiniz !!!", */
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @return void
     */
    public function get(): void
    {
        try {
            $data = $data = $this->getIdData();

            $result = UserGetRequest::validated(data: $data);

            if (!empty($result['data'])) {
                $user = $this->model('User');
                $user = $user->getAdmin(data: $result['data']);

                if ($user) {
                    echo json_encode([
                        'success' => $result['success'] ?? '',
                        'message' => $result['message'] ?? '',
                        'data' => $user,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Böyle Bir Kullanıcı Bulunamadı !!!',
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => $result['success'] ?? '',
                'message' => $result['message'] ?? '',
            ]);
        } catch (\Exception $exception) {
            echo json_encode([
                'success' => false,
                /* 'message' => "İşlemler Sırasında Bir Sorun Oluştu. Sayfayı Yeniliyerek Tekrar Deneyiniz !!!", */
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @return void
     */
    public function update(): void
    {
        try {
            $refresh = false;

            $data = $this->getData(idStatus: true);

            $result = UserUpdateRequest::validated(data: $data);

            if (!empty($result['data'])) {
                $user = $this->model('User');
                $user = $user->update(data: $result['data']);

                if ($user) {

                    $user['html'] = $this->setUserHtml(user: $user);

                    if (isset(auth()['change_password'])) {
                        $refresh = true;
                    }

                    if (auth()['id'] == $user['id']) {
                        $this->changeAuthSessionValue(user: $user);
                    }

                    echo json_encode([
                        'success' => $result['success'] ?? '',
                        'message' => $result['message'] ?? '',
                        'data' => $user ?? '',
                        'refresh' => $refresh,
                        'check' => (auth()['id'] == $user['id']),
                        'name' => authName(),
                        'first' => authFirstName(),
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Kullanıcı Güncelleme Sırasında Bir Sorun Oluştu !!!',
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => $result['success'] ?? '',
                'message' => $result['message'] ?? '',
            ]);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 23000) {
                if (str_contains($exception->getMessage(), 'users.email')) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Bu e-posta adresi zaten başka bir kullanıcı tarafından kullanılıyor !!!",
                    ]);
                }

                if (str_contains($exception->getMessage(), 'users.phone')) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Bu telefon numarası zaten başka bir kullanıcı tarafından kullanılıyor !!!",
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => false,
                /* 'message' => "İşlemler Sırasında Bir Sorun Oluştu. Sayfayı Yeniliyerek Tekrar Deneyiniz !!!", */
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @return void
     */
    public function delete(): void
    {
        try {
            $data = $this->getIdData();

            $result = UserGetRequest::validated(data: $data);

            if (!empty($result['data'])) {
                $user = $this->model('User');
                $user = $user->delete(data: $result['data']);

                if ($user) {
                    echo json_encode([
                        'success' => $result['success'] ?? '',
                        'message' => $result['message'] ?? '',
                        'data' => $user,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Kullanıcı Silme İşleminde Bir Sorun Oluştu !!!',
                    ]);
                }

                exit();
            }

            echo json_encode([
                'success' => $result['success'] ?? '',
                'message' => $result['message'] ?? '',
            ]);
        } catch (\Exception $exception) {
            echo json_encode([
                'success' => false,
                /* 'message' => "İşlemler Sırasında Bir Sorun Oluştu. Sayfayı Yeniliyerek Tekrar Deneyiniz !!!", */
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @param array $user
     *
     * @return string
     */
    private function setUserHtml(array $user): string
    {
        $html = '<td>' . ($user['name'] ?? '') . '</td>
                <td>' . ($user['surname'] ?? '') . '</td>
                <td>' . ($user['email'] ?? '') . '</td>
                <td>' . ($user['phone'] ?? '') . '</td>
                <td>
                    <button type="button" data-id="' . ($user['id'] ?? '') . '" class="btn btn-sm btn-outline-primary update-btn m-1">
                        <i class="fas fa-pencil"></i>
                    </button>';

        if (auth()['role'] == RoleEnum::SUPER_ADMIN->value) {
            $html .= ' <button type="button" data-id="' . ($user['id'] ?? '') . '" class="btn btn-sm btn-outline-danger delete-btn m-1">
                            <i class="fas fa-trash"></i>
                        </button>';
        }

        $html .= '</td>';

        return $html;
    }


    /**
     * @param bool $idStatus
     *
     * @return array
     */
    private function getData(bool $idStatus = false): array
    {
        $data = [
            'id' => htmlHideCode($_POST['id'] ?? ''),
            'name' => htmlHideCode($_POST['name'] ?? ''),
            'surname' => htmlHideCode($_POST['surname'] ?? ''),
            'email' => htmlHideCode($_POST['email'] ?? ''),
            'phone' => htmlHideCode($_POST['phone'] ?? ''),
            'password' => htmlHideCode($_POST['password'] ?? ''),
            'password_confirm' => htmlHideCode($_POST['password_confirm'] ?? ''),
        ];

        if ($idStatus) {
            $data['id'] = htmlHideCode($_POST['id'] ?? '');
        }

        return $data;
    }

    /**
     * @return array
     */
    private function getIdData(): array
    {
        return [
            'id' => htmlHideCode($_POST['id'] ?? '')
        ];
    }

    /**
     * @param array $user
     *
     * @return void
     */
    private function changeAuthSessionValue(array $user): void
    {
        $_SESSION['auth']['name'] = $user['name'];
        $_SESSION['auth']['surname'] = $user['surname'];
        $_SESSION['auth']['email'] = $user['email'];
        $_SESSION['auth']['phone'] = $user['phone'];
    }
}
