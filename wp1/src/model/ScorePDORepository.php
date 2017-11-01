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
                //var_dump($result);
                return new Score($result[0]['id'], $result[0]['idprobleemmelding'],  $result[0]['aantalscores'],  $result[0]['totalescore']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function updateScoreByIdprobleemmelding(Score $score)
    {
        try {
            $id = $score->getId();
            $aantalScores = $score->getAantalScores();
            $totaleScore = $score->getTotaleScore();

            $statement = $this->connection->prepare('UPDATE score SET aantalscores=?,totalescore=? WHERE id=?');
            $statement->bindParam(1, $aantalScores, \PDO::PARAM_INT);
            $statement->bindParam(2, $totaleScore, \PDO::PARAM_INT);
            $statement->bindParam(3, $id, \PDO::PARAM_INT);
            $statement->execute();

            return $score;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public function addScoreByIdprobleemmelding(Score $score)
    {
        try {
            $id = $score->getId();
            $idProbleemMelding = $score->getIdProbleemMelding();
            $aantalScores = $score->getAantalScores();
            $totaleScore = $score->getTotaleScore();
            $statement = $this->connection->prepare('INSERT INTO score(id, idprobleemmelding, aantalscores, totalescore) VALUES(?,?,?,?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $idProbleemMelding, \PDO::PARAM_INT);
            $statement->bindParam(3, $aantalScores, \PDO::PARAM_INT);
            $statement->bindParam(4, $totaleScore, \PDO::PARAM_INT);
            $statement->execute();
            return $score;
        } catch (\Exception $exception) {
            return null;
        }
    }
}