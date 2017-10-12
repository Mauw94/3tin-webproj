<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 29/09/2017
 * Time: 10:10
 */

namespace model;


class ProbleemMeldingPDORepository implements ProbleemMeldingRepository
{
    private $connection = null;
    private $probleemMelding;

    public function __construct(\PDO $connection, ProbleemMeldingRepository $probleemMelding)
    {
        $this->connection = $connection;
        $this->probleemMelding = $probleemMelding;
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
                return new ProbleemMelding($probleemMelding[0]['id'],$probleemMelding[1]['locatieid'],$probleemMelding[2]['probleem'], $probleemMelding[3]['datum'], $probleemMelding[4]['afgehandeld']);
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
            $locatieId = $probleemMelding->getLocatieId();
            $probleem = $probleemMelding->getProbleem();
            $datum = $probleemMelding->getDatum();
            $afgehandeld = $probleemMelding->getAfgehandeld();
            $statement = $this->connection->prepare('INSERT INTO probleemmelding(locatieid, probleem, datum, afgehandeld) VALUES(?,?,?,?)');
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(2, $probleem, \PDO::PARAM_STR);
            $statement->bindParam(3, $datum, \PDO::PARAM_STR);
            $statement->bindParam(4, $afgehandeld, \PDO::PARAM_BOOL);
            $statement->execute();
            return $probleemMelding;
        } catch (\Exception $exception) {
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
            $statement = $this->connection->prepare('UPDATE probleemmelding SET locatieid=?,probleem=?,datum=?,afgehandeld=? WHERE id=?');
            $statement->bindParam(1, $locatieId, \PDO::PARAM_INT);
            $statement->bindParam(2, $probleem, \PDO::PARAM_STR);
            $statement->bindParam(3, $datum, \PDO::PARAM_STR);
            $statement->bindParam(4, $afgehandeld, \PDO::PARAM_BOOL);
            $statement->bindParam(5, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $probleemMelding;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function getAfgehandeldeProbleemMeldingen()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM probleemmelding WHERE afgehandeld = TRUE ');
            $statement->execute();

            $afgehandeldeProbleemMeldingen = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $afgehandeldeProbleemMeldingen;
        } catch (\Exception $exception) {
            return null;
        }
    }
}