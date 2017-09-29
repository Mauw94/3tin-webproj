<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 29-9-2017
 * Time: 20:04
 */

namespace controller;


use model\ProbleemMeldingPDORepository;

class ProbleemMeldingController
{
    public function __construct(ProbleemMeldingPDORepository $probleemMeldingPDORepository, View $view)
    {
        $this->probleemMeldingRepo = $probleemMeldingPDORepository;
        $this->view = $view;
    }

    public function handleGetAll() {
        $probleemMelding = $this->probleemMeldingRepo->getAll();
        $this->view->show(['toShow' => $probleemMelding]);
    }

    public function handleGetById(int $id) {
        $probleemMelding = $this->probleemMeldingRepo->getById($id);
        $this->view->show(['toShow' => $probleemMelding]);
    }

}