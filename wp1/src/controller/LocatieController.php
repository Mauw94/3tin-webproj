<?php

namespace controller;


use model\locatiePDORepository;
use view\View;

class LocatieController
{
    private $locatieRepo;
    private $view;

    public function __construct(locatiePDORepository $repo, View $view)
    {
        $this->locatieRepo = $repo;
        $this->view = $view;
    }

    public function handleGetById(int $id) {
        $locatie = $this->locatieRepo->getById($id);
        $this->view->show(['toShow' => $locatie]);
    }
}