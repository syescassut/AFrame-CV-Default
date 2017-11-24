
<?php
class ModelInformation {
    
    /**
     * Fill table with Information object array from a SQL query
     * @global string $base
     * @global string $login
     * @global string $password
     * @return array
     */
    public static function getAllInformation() :array {

 	global $base, $login, $password;

        $informationGW = new InformationGateway(new Connection($base, $login, $password));
        $results = $informationGW->getAllInformation(); 
        $data = array();
        foreach ($results as $row){
            $data[] = new Information ($row['ID'], $row['status'], $row['name'], $row['firstName'], $row['photo'], $row['age'], $row['address'], $row['phone'], $row['mail']);
        }
        return $data;
    }
    
    /**
     * 
     * @global string $base
     * @global string $login
     * @global string $password
     * @param int $id
     * @return Conference
     */
    public static function getOneInformation(int $id) : Information {

 	global $base, $login, $password;

        $informationGW = new InformationGateway(new Connection($base, $login, $password));
        $row = $informationGW->getOneInformation($id);
        $data = new Information ($row[0]['ID'], $row[0]['status'], $row[0]['name'], $row[0]['firstName'], $row[0]['photo'], $row[0]['age'], $row[0]['address'], $row[0]['phone'], $row[0]['mail']);
        
        return $data;
    }
}
?>  
