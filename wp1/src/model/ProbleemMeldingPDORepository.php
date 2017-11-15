<?php

namespace model;


class ProbleemMeldingPDORepository implements ProbleemMeldingRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM probleemmelding");
            $statement->execute();
            $probleemMeldingen = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($probleemMeldingen > 0) {
                return $probleemMeldingen;
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
            $statement = $this->connection->prepare("SELECT * FROM probleemmelding WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $probleemMelding = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($probleemMelding > 0) {
                return new ProbleemMelding($probleemMelding[0]['id'],$probleemMelding[0]['locatieid'],
                    $probleemMelding[0]['probleem'], $probleemMelding[0]['datum'],
                    $probleemMelding[0]['afgehandeld'],$probleemMelding[0]['updownvote'], $probleemMelding[0]['userid']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getAllProblemenByLocatieId(int $locatieId)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM probleemmelding WHERE locatieid=?");
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->execute();
            $probleemMeldingen = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($probleemMeldingen > 0) {
                return $probleemMeldingen;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function addProbleemMelding(ProbleemMelding $probleemMelding)
    {
        try {
            $id = $probleemMelding->getId();
            $locatieId = $probleemMelding->getLocatieId();
            $probleem = $probleemMelding->getProbleem();
            $datum = $probleemMelding->getDatum();
            $afgehandeld = $probleemMelding->getAfgehandeld();
            $upDownVote = $probleemMelding->getUpDownVote();
            $userId = $probleemMelding->getUserId();
            $statement = $this->connection->prepare('INSERT INTO probleemmelding(id, locatieid, probleem, datum, afgehandeld, updownvote, userid) VALUES(?,?,?,?,?,?,?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(3, $probleem, \PDO::PARAM_STR);
            $statement->bindParam(4, $datum, \PDO::PARAM_STR);
            $statement->bindParam(5, $afgehandeld, \PDO::PARAM_BOOL);
            $statement->bindParam(6, $upDownVote,\PDO::PARAM_STR);
            $statement->bindParam(7, $userId, \PDO::PARAM_INT);
            
            $statement->execute();
            return $probleemMelding;
        } catch (\Exception $exception) {
            print $exception->getMessage();
            return null;
        }
    }

    public function updateProbleemmelding(ProbleemMelding $probleemMelding)
    {
        try {
            $id = $probleemMelding->getId();
            $locatieId = $probleemMelding->getLocatieId();
            $probleem = $probleemMelding->getProbleem();
            $datum = $probleemMelding->getDatum();
            $afgehandeld = $probleemMelding->getAfgehandeld();
            $upDownVote = $probleemMelding->getUpDownVote();
            $userId = $probleemMelding->getUserId();
            $statement = $this->connection->prepare('UPDATE probleemmelding SET locatieid=?,probleem=?,datum=?,afgehandeld=?,updownvote=?,userid=? WHERE id=?');
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(2, $probleem, \PDO::PARAM_STR);
            $statement->bindParam(3, $datum, \PDO::PARAM_STR);
            $statement->bindParam(4, $afgehandeld, \PDO::PARAM_BOOL);
            $statement->bindParam(5, $upDownVote,\PDO::PARAM_STR);
            $statement->bindParam(6, $userId, \PDO::PARAM_INT);
            $statement->bindParam(7, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $probleemMelding;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getAfgehandeldeProbleemMeldingen()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM probleemmelding WHERE afgehandeld = 1 ');
            $statement->execute();

            $afgehandeldeProbleemMeldingen = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $afgehandeldeProbleemMeldingen;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function deleteProbleemMelding(int $probleemId)
    {
        try {
            $id = $probleemId;
            $statement = $this->connection->prepare("DELETE FROM probleemmelding WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->rowCount();
            return $count;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getUpDownVote(int $id)
    {
        try {
            $statement = $this->connection->prepare('SELECT updownvote FROM probleemmelding WHERE id = ? ');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();

            $upDownVote = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $upDownVote;
        } catch (\Exception $exception) {
            return null;
        }

    }

    public function updateUpDownVote(int $id, int $upDownVote)
    {
        try {
            $statement = $this->connection->prepare('UPDATE probleemmelding SET updownvote=? WHERE id=?');
            $statement->bindParam(1,$upDownVote,\PDO::PARAM_INT);
            $statement->bindParam(2, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $upDownVote;
        } catch (\Exception $exception) {
            return null;
        }

    }
}