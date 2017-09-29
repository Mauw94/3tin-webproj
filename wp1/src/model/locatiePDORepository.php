<?php

namespace model;


class locatiePDORepository implements locatieRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
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
       try { $id = $locatie->getId();
        $name = $locatie->getNaam();
        $statement = $this->connection->prepare('INSERT INTO locatie(id,name) VALUES(?,?)');
        $statement->bindParam(1, $id, \PDO::PARAM_INT);
        $statement->bindParam(2, $firstName);
        $statement->bindParam(3, $lastName);
        $statement->execute();
        return $locatie;
    } catch (\Exception $exception) {
            return null;
        }
    }


    public function updateLocatie(Locatie $locatie)
    {

    }

    public function deleteLocatie(int $id)
    {

    }

}