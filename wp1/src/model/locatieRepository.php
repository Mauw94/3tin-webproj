<?php

namespace model;


interface locatieRepository
{
    public function getById(int $id);

    public function addLocatie(Locatie $locatie);

    public function updateLocatie(Locatie $locatie);

    public function deleteLocatie(int $id);
}