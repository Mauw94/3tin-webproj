<?php
/**
 * Created by PhpStorm.
 * User: Maurits
 * Date: 29-9-2017
 * Time: 09:00
 */

namespace model;


interface locatieRepository
{
    public function getById(int $id);

    public function addLocatie(Locatie $locatie);

    public function updateLocatie(Locatie $locatie);

    public function deleteLocatie(int $id);
}