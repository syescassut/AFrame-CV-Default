<?php

class ModelResume {
    
    /**
     * Get a Resume by sectionId in Database 
     * @global string $base
     * @global string $login
     * @global string $password
     * @param int $sectionId
     * @return Resume
     */
    public static function getResumeBySectionId(int $sectionId) :Resume {
        global $base, $login, $password;

        $resumeGW = new ResumeGateway(new Connection($base, $login, $password));
        $row = $resumeGW->getResumeBySectionId($sectionId);
        
        $data = new Resume($row['ID'], $row['date_creation'], $row['date_modification'], $row['content'], $row['section_id']);
        
        return $data;
    }
    
    /**
     * Count Resume by sectionId in Database 
     * @global string $base
     * @global string $login
     * @global string $password
     * @param int $sectionId
     * @return int
     */
    public static function countResumeBySectionId(int $sectionId) :int {
        global $base, $login, $password;

        $resumeGW = new ResumeGateway(new Connection($base, $login, $password));
        $count = $resumeGW->countResumeBySectionId($sectionId);
               
        return $count;
    }
    
    /**
     * Get a Resume by id in Database 
     * @global string $base
     * @global string $login
     * @global string $password
     * @param int $id
     * @return Resume
     */
    public static function getResumeById(int $id) :Resume {
        global $base, $login, $password;

        $resumeGW = new ResumeGateway(new Connection($base, $login, $password));
        $row = $resumeGW->getResumeById($id);
        
        $data = new Resume($row['ID'], $row['date_creation'], $row['date_modification'], $row['content'], $row['section_id']);
        
        return $data;
    }
}

