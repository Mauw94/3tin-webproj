<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 3/10/2017
 * Time: 16:25
 */

namespace model;


interface StatusMeldingRepository
{
    public function getAll();

    public function getById(int $id);

    public function addStatusMelding(StatusMelding $statusMelding);

    public function updateStatusMelding(StatusMelding $statusMelding);
}