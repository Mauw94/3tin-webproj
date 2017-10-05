<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 3/10/2017
 * Time: 16:33
 */

namespace model;


class StatusMeldingPDORepository implements StatusMelidingRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {

    }

    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    public function addStatusMelding(StatusMelding $statusMelding)
    {
        // TODO: Implement addStatusMelding() method.
    }

    public function updateStatusMelding(StatusMeliding $statusMeliding)
    {
        // TODO: Implement updateStatusMelding() method.
    }
}