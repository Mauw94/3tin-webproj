<?php

namespace model;


interface ProbleemMeldingRepository
{
    public function getAll();

    public function getById(int $id);

    public function addProbleemMelding(ProbleemMelding $probleemMelding);

    public function updateProbleemMelding(ProbleemMelding $probleemMelding);

    public function getAfgehandeldeProbleemMeldingen ();

    public function getUpDownVote (int $id);

    public function updateUpDownVote (int $id, int $upDownVote);
}