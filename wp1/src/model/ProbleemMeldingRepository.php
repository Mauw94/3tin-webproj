<?php

namespace model;


interface ProbleemMeldingRepository
{
    public function getById(int $id);

    public function addProbleemMelding(ProbleemMelding $probleemMelding);

    public function updateProbleemMelding(ProbleemMelding $probleemMelding);

    public function getAfgehandeldeProbleemMeldingen ();
}