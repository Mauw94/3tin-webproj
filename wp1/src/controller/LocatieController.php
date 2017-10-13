<?php

namespace controller;

use model\Locatie;
use model\LocatiePDORepository;
use view\View;

class LocatieController
{
    private $locatieRepo;
    private $view;

    public function __construct(LocatiePDORepository $locatiePDORepository, View $view)
    {
        $this->locatieRepo = $locatiePDORepository;
        $this->view = $view;
    }

    public function handleGetAll() {
        $locaties = $this->locatieRepo->getAll();
        $this->view->show(['toShow' => $locaties]);
    }

    public function handleGetById(int $id) {
        $locatie = $this->locatieRepo->getById($id);
        $this->view->show(['toShow' => $locatie]);
    }

    public function handleUpdateLocatie($locatie) {
        $decode = json_decode($locatie, true);
        $newLocatie = new Locatie((int)$decode['id'], $decode['naam']);
        $this->locatieRepo->updateLocatie($newLocatie);
        $this->view->show(['toShow' => $newLocatie]);
    }

    public function handleAddLocatie($locatie) {
        $decode = json_decode($locatie, true);
        $newLocatie = new Locatie((int)$decode['id'], $decode['naam']);
        $this->locatieRepo->addLocatie($newLocatie);
        $this->view->show(['toShow' => $newLocatie]);
    }

    public function handleDeleteLocatie(int $id) {
        $returnValue = 'rows deleted ' . $this->locatieRepo->deleteLocatie($id);;
        $this->view->show(['toShow' => $returnValue]);
    }
}