<?php

declare(strict_types=1);

class NotFoundController extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $this->view('404');
    }
}