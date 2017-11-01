<?php

namespace controller;

use model\Score;
use model\ScorePDORepository;
use view\View;

class ScoreController
{
    private $Repo;
    private $view;

    public function __construct(ScorePDORepository $PDORepository, View $view)
    {
        $this->Repo = $PDORepository;
        $this->view = $view;
    }

    public function handleGetScoreByIdprobleemmelding(int $id)
    {
        $score = $this->Repo->getScoreByIdprobleemmelding($id);
        $this->view->show(['toShow' => $score]);
    }

    public function handleUpdateScoreByIdprobleemmelding($score)
    {
        $decode = json_decode($score, true);
        $newScore = new Score((int)$decode['id'], $decode['idprobleemMelding'], $decode['aantalScores'], $decode['totaleScore']);
        $this->Repo->updateScoreByIdprobleemmelding($newScore);
        $this->view->show(['toShow' => $newScore]);
    }

    public function handleAddScoreByIdprobleemmelding($score)
    {
        $decode = json_decode($score, true);
        $newScore = new Score((int)$decode['id'], $decode['idprobleemMelding'], $decode['aantalScores'], $decode['totaleScore']);
        $this->Repo->addScoreByIdprobleemmelding($newScore);
        $this->view->show(['toShow' => $newScore]);
    }

}