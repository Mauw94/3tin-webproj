<?php

namespace model;


class StatusMeldingPDORepository implements StatusMeldingRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM statusmelding");
            $statement->execute();
            $statusMeldingen = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($statusMeldingen > 0) {
                return $statusMeldingen;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getById(int $id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM statusmelding WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $statusMelding = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($statusMelding > 0) {
                return new StatusMelding($statusMelding[0]['id'],$statusMelding[0]['locatieid'],$statusMelding[0]['status'], $statusMelding[0]['datum']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }

    }

    public function addStatusMelding(StatusMelding $statusMelding)
    {
        try {
            $locatieId = $statusMelding->getLocatieId();
            $status = $statusMelding->getStatus();
            $datum = $statusMelding->getDatum();

            $statement = $this->connection->prepare('INSERT INTO statusmelding(locatieid, status, datum) VALUES(?,?,?)');
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(2, $status, \PDO::PARAM_STR);
            $statement->bindParam(3, $datum, \PDO::PARAM_STR);
            $statement->execute();

            return $statusMelding;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function updateStatusMelding(StatusMelding $statusMelding)
    {
        try {
            $id = $statusMelding->getId();
            $locatieId = $statusMelding->getLocatieId();
            $status = $statusMelding->getStatus();
            $datum = $statusMelding->getDatum();
            $statement = $this->connection->prepare('UPDATE statusmelding SET locatieid=?,status=?,datum=? WHERE id=?');
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(2, $status, \PDO::PARAM_STR);
            $statement->bindParam(3, $datum, \PDO::PARAM_STR);
            $statement->bindParam(4, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $statusMelding;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function deleteStatusMelding(int $statusdId)
    {
        try {
            $id = $statusdId;
            $statement = $this->connection->prepare("DELETE FROM statusmelding WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->rowCount();
            return $count;
        } catch (\Exception $exception) {
            return null;
        }
    }
}