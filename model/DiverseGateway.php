<?php
class DiverseGateway {
    
    private $connection;
    
    public function __construct(Connection $con) {
        $this->connection=$con;
    }
       
    /**
     * Get all diverse personal information on database
     * @return array
     */
    public function getAllDiverse() :array {
        $query='SELECT * FROM Diverse;';
        $this->connection->executeQuery($query);
        return $this->connection->getResults();
    }
    
    /**
     * 
     * @param int $id
     * @return array
     */
    public function getOnDiverse(int $id) :array {
        $query='SELECT * FROM Diverse WHERE ID=:id;';
        $this->connection->executeQuery($query, array(
            ':id' => array($id, PDO::PARAM_INT)
        ));
        return $this->connection->getResults();
    }
}
?>

