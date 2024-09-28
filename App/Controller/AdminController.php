<?php

declare(strict_types=1);

class AdminController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        if (!authCheck()) {
            $this->logout();
        }
    }


    /**
     * @return void
     */
    public function index(): void
    {
        try {
            $auth = auth();

            $user = $this->model('User');
            $users = ($auth['role'] == RoleEnum::ADMIN->value)
                ? [$auth]
                : $user->allAdmin();

            $this->view(view: 'admin', params: [
                'users' => $users,
                'auth'  => $auth,
                'role'  => RoleEnum::SUPER_ADMIN->value,
            ]);
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: http://karecode.test/login');
        exit();
    }
}
