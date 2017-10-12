<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 29/09/2017
 * Time: 10:50
 */

namespace model;


interface ScoreRepository
{
    public function getScoreByIdprobleemmelding(int $id);
    public function updateScoreByIdprobleemmelding(Score $score);
    public function addScoreByIdprobleemmelding(Score $score);
}