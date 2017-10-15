<?php

namespace model;

interface StatusMeldingRepository
{
    public function getAll();

    public function getById(int $id);

    public function addStatusMelding(StatusMelding $statusMelding);

    public function updateStatusMelding(StatusMelding $statusMelding);
}