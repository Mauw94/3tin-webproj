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

    public function getScoreByIdprobleemmelding(int $id)
    {
        $score = $this->Repo->getScoreByIdprobleemmelding($id);
        $this->view->show(['toShow' => $score]);
    }

    public function updateScoreByIdprobleemmelding($score)
    {
        $decode = json_decode($score, true);
        $newScore = new Score((int)$decode['id'], $decode['idprobleemMelding'], $decode['aantalScores'], $decode['totaleScore']);
        $this->Repo->updateScoreByIdprobleemmelding($newScore);
        $this->view->show(['toShow' => $newScore]);
    }

    public function addScoreByIdprobleemmelding($score)
    {
        $decode = json_decode($score, true);
        $newScore = new Score((int)$decode['id'], $decode['idprobleemMelding'], $decode['aantalScores'], $decode['totaleScore']);
        $this->Repo->addScoreByIdprobleemmelding($newScore);
        $this->view->show(['toShow' => $newScore]);
    }

}