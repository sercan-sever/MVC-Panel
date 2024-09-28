<?php

declare(strict_types=1);

class IndexController extends Controller
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

        header('Location: http://karecode.test/logout');
        exit();
    }
}
