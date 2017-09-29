<?php

namespace model;


class LocatiePDORepository implements locatieRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM locatie");
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($results > 0) {
                return $results;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getById(int $id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM locatie WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($result > 0) {
                return new Locatie($result[0]['id'], $result[1]['naam']);
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function addLocatie(Locatie $locatie)
    {
       try {
           $id = $locatie->getId();
            $name = $locatie->getNaam();
            $statement = $this->connection->prepare('INSERT INTO locatie(id, naam) VALUES(?,?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $name, \PDO::PARAM_STR);
             $statement->execute();
            return $locatie;
    } catch (\Exception $exception) {
            return null;
        }
    }

    public function updateLocatie(Locatie $locatie)
    {
        try {
            $id = $locatie->getId();
            $name = $locatie->getNaam();

            $statement = $this->connection->prepare('UPDATE locatie SET naam=? WHERE id=?');
            $statement->bindParam(1, $name, \PDO::PARAM_STR);
            $statement->bindParam(2, $id, \PDO::PARAM_INT);
            $statement->execute();
            return $locatie;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function deleteLocatie(int $locatieId)
    {
        try {
            $id = $locatieId;
            $statement = $this->connection->prepare('DELETE FROM locatie WHERE id=?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (\Exception $exception) {
            return null;
        }
    }

}