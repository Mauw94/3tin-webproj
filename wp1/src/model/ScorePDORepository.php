<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 29/09/2017
 * Time: 11:04
 */

namespace model;


class ScorePDORepository implements ScoreRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getScoreByIdprobleemmelding(int $id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM score WHERE idprobleemmelding=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($result > 0) {
                return new Score($result[0]['id'], $result[0]['idprobleemmelding'],  $result[0]['aantalscores'],  $result[0]['totalescore']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function updateScoreByIdprobleemmelding(score $score)
    {
        try {
            $id = $score->getId();
            $aantalScores = $score->getAantalscores();
            $totaleScore = $score->getTotalescore();

            $statement = $this->connection->prepare('UPDATE score SET aantalScores=?,totaalScore=? WHERE id=?');
            $statement->bindParam(1, $aantalScores, \PDO::PARAM_INT);
            $statement->bindParam(2, $totaleScore, \PDO::PARAM_INT);
            $statement->bindParam(3, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $score;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function addScoreByIdprobleemmelding(score $score)
    {
        try {
            $idprobleemmelding = $score->getIdprobleemmelding();
            $aantalScores = $score->getAantalscores();
            $totaleScore = $score->getTotalescore();
            $statement = $this->connection->prepare('INSERT INTO score(idprobleemmelding, aantalscores, totalescore) VALUES(?,?,?)');
            $statement->bindParam(1, $idprobleemmelding, \PDO::PARAM_INT);
            $statement->bindParam(2, $aantalScores, \PDO::PARAM_INT);
            $statement->bindParam(2, $totaleScore, \PDO::PARAM_INT);
            $statement->execute();
            return $score;
        } catch (\Exception $exception) {
            return null;
        }
    }
}