<?php

declare(strict_types=1);

class LoginController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        if (authCheck()) {
            header('Location: http://karecode.test/admin');
            exit();
        }
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->view('login');
    }

    /**
     * @return void
     */
    public function login(): void
    {
        try {
            $data = $this->getData();

            $result = LoginRequest::validated(data: $data);

            if (!empty($result['data'])) {
                $user = $this->model('User');
                $user = $user->auth(data: $result['data']);

                if ($user) {
                    unset($user['password']);

                    $_SESSION['auth'] = $user;
                    $_SESSION['auth']['auth_time'] = time();

                    echo json_encode([
                        'success' => $result['success'] ?? '',
                        'message' => $result['message'] ?? '',
                        'data' => $user,
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Kullanıcı Bulunamadı !!!',
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
                /* 'message' => "İşlemler Sırasında Bir Sorun Oluştu. Sayfayı Yenileyerek Tekrar Deneyiniz !!!", */
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            'email' => htmlHideCode($_POST['email'] ?? ''),
            'password' => htmlHideCode($_POST['password'] ?? ''),
        ];
    }
}
