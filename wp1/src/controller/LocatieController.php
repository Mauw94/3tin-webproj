<?php

namespace controller;


use model\locatiePDORepository;
use view\View;
use model\Locatie;

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

    public function handleAddLocatie($locatie) {
        $decoded = json_decode($locatie, true);
        $newLocatie = new Locatie((int)$decoded['id'], $decoded['naam']);
        $this->locatieRepo->addLocatie($newLocatie);
        $this->view->show(['toShow' => $newLocatie]);
    }

    public function handleUpdateLocatie($locatie) {
        $decoded = json_decode($locatie);
        $newLocatie = new Locatie((int)$decoded['id'], $decoded['naam']);
        $this->locatieRepo->updateLocatie($newLocatie);
        $this->view->show(['toShow' => $newLocatie]);
    }

    public function handleDeleteLocatie($id) {
        $this->locatieRepo->deleteLocatie($id);
        $this->view->show(['toShow' => $id]);
    }
}