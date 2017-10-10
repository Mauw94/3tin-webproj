<?php

namespace model;

class LocatiePDORepository implements LocatieRepository
{
    private $connection;
    private $locatieRepo;

    public function __construct(\PDO $connection, LocatieRepository $locatieRepository)
    {
        $this->connection = $connection;
        $this->locatieRepo = $locatieRepository;
    }

    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM locatie");
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if ($result > 0) {
                return $result;
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
            $statement = $this->connection->prepare("SELECT * FROM locatie WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $statement->execute();
            $locatie = $statement->fetchAll();
            return $locatie;
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function addLocatie(Locatie $locatie)
    {
        try {
            $id = $locatie->getId();
            $naam = $locatie->getNaam();
            $statement = $this->connection->prepare('INSERT INTO locatie(id, naam) VALUES(?,?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $naam, \PDO::PARAM_STR);
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
            $naam = $locatie->getNaam();

            $statement = $this->connection->prepare('UPDATE locatie SET naam=? WHERE id=?');
            $statement->bindParam(1, $naam, \PDO::PARAM_STR);
            $statement->bindParam(2, $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function deleteLocatie(int $id)
    {
        try {
            $statement = $this->connection->prepare("DELETE * FROM locatie WHERE id=?");
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (\Exception $exception) {
            return null;
        }
    }

}