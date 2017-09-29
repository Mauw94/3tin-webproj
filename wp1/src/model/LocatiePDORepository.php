<?php

namespace model;


use Doctrine\DBAL\Driver\PDOConnection;

class LocatiePDORepository implements LocatieRepository
{
    private $connection;

    public function __construct(PDOConnection $connection)
    {
        $this->connection = $connection;
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
        // TODO: Implement getById() method.
    }

    public function addLocatie(Locatie $locatie)
    {
        // TODO: Implement addLocatie() method.
    }

    public function updateLocatie(Locatie $locatie)
    {
        // TODO: Implement updateLocatie() method.
    }

    public function deleteLocatie(int $id)
    {
        // TODO: Implement deleteLocatie() method.
    }

}