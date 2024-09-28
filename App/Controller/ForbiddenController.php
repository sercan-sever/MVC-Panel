<?php

declare(strict_types=1);

class ForbiddenController extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $this->view('403');
    }
}