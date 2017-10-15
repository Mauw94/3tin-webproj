<?php

namespace controller;


use model\ProbleemMelding;
use model\ProbleemMeldingPDORepository;
use view\View;

class ProbleemMeldingController
{
    public function __construct(ProbleemMeldingPDORepository $probleemMeldingPDORepository, View $view)
    {
        $this->probleemMeldingRepo = $probleemMeldingPDORepository;
        $this->view = $view;
    }

    public function handleGetAll()
    {
        $probleemMeldingen = $this->probleemMeldingRepo->getAll();
        $this->view->show(['toShow' => $probleemMeldingen]);
    }

    public function handleGetById(int $id)
    {
        $probleemMelding = $this->probleemMeldingRepo->getById($id);
        $this->view->show(['toShow' => $probleemMelding]);
    }

    public function handleUpdateProbleemMelding($probleemMelding)
    {
        $decode = json_decode($probleemMelding, true);
        $newProbleemMelding = new ProbleemMelding((int)$decode['id'], $decode['locatieid'], $decode['probleem'], $decode['datum'], $decode['afgehandeld']);
        $this->probleemMeldingRepo->updateProbleemmelding($newProbleemMelding);
        $this->view->show(['toShow' => $newProbleemMelding]);
    }

    public function handleAddProbleemMelding($probleemMelding)
    {
        $decode = json_decode($probleemMelding, true);
        $newProbleemMelding = new ProbleemMelding(0, $decode['locatieid'], $decode['probleem'], $decode['datum'], $decode['afgehandeld']);
        $this->probleemMeldingRepo->addProbleemMelding($newProbleemMelding);
        $this->view->show(['toShow' => $newProbleemMelding]);
    }

    public function handleGetAfgehandeldeProbleemMeldingen()
    {
        $afgehandeldeProbleemMeldingen = $this->probleemMeldingRepo->getAfgehandeldeProbleemMeldingen();
        $this->view->show(['toShow' => $afgehandeldeProbleemMeldingen]);
    }

    public function handleDeleteProbleemMelding(int $id) {
        $returnValue = 'rows deleted ' . $this->probleemMeldingRepo->deleteProbleemMelding($id);;
        $this->view->show(['toShow' => $returnValue]);
    }
}