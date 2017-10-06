<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 6/10/2017
 * Time: 8:46
 */

namespace controller;


use model\StatusMelding;
use model\StatusMeldingPDORepository;

class StatusMeldingController
{
    public function __construct(StatusMeldingPDORepository $statusMeldingPDORepository, View $view)
    {
        $this->statusMeldingRepo = $statusMeldingPDORepository;
        $this->view = $view;
    }

    public function handleGetAll()
    {
        $statusMeldingen = $this->statusMeldingRepo->getAll();
        $this->view->show(['toShow' => $statusMeldingen]);
    }

    public function handleGetById(int $id)
    {
        $statusMelding = $this->statusMeldingRepo->getById($id);
        $this->view->show(['toShow' => $statusMelding]);
    }

    public function handleUpdateStatusMelding($statusMelding)
    {
        $decode = json_decode($statusMelding, true);
        $newStatusMelding = new StatusMelding((int)$decode['id'], $decode['locatieid'], $decode['status'], $decode['datum']);
        $this->statusMeldingRepo->updateStatusMelding($newStatusMelding);
        $this->view->show(['toShow' => $newStatusMelding]);
    }

    public function handleAddStatusMelding($statusMelding)
    {
        $decode = json_decode($statusMelding, true);
        $newStatusMelding = new StatusMelding(0, $decode['locatieid'], $decode['status'], $decode['datum']);
        $this->statusMeldingRepo->addStatusMelding($newStatusMelding);
        $this->view->show(['toShow' => $newStatusMelding]);
    }

}