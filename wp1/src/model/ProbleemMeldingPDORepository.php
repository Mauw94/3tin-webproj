<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 29/09/2017
 * Time: 10:10
 */

namespace model;


class ProbleemMeldingPDORepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById(int $id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM probleemmelding WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($result > 0) {
            return new ProbleemMelding($result[0]['id'],$result[1]['locatieid'],$result[2]['probleem'], $result[3]['datum'], $result[4]['afgehandeld']);
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

}