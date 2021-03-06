<?php
$data['tables'] = ModelTables::getAllTables();

$data['sectionPublication'] = array();

foreach ($data['tables'] as $table) {
    $tableName = $table[0];
    if ($tableName !== "ByDate" && $tableName !== "Parameter" && $tableName !== "Login" && $tableName !== "Token") {
        switch ($tableName) {
            /* --- Publications : --- */
            case "Publication": 
                $data['sectionPublication'][] = "Conferences";
                $data['sectionPublication'][] = "Journals";
                $data['sectionPublication'][] = "Documentations";
                $data['sectionPublication'][] = "Thesis";
                $data['sectionPublication'][] = "Miscellaneous";
                break;   
        }
    }
}
?>

<div  class="panels">
    <div class="titleBar">
        <a href="admin.php" id="backButton">&#10229; Back</a>
        <div class="title">
            <h2>Your different panels </h2> 
        </div>
    </div>
    <form method="post" >
        <div class="list">
            <div>
                <h3>Sections :</h3>
                <ul>
                <?php
                echo "<li id=\"section\">"
                        . "<a href=\"admin.php?table=section&action=showTable\">"
                            . "<div>Section</div>"
                        . "</a>"
                    . "</li>";
                $data['sections'] = ModelSection::getAllSections();
                foreach($data['sections'] as $section) {
                    $title = $section->getTitle();
                    $id = $section->getId();
                    echo "<li>"
                            . "<a href=\"admin.php?sectionId=$id&action=showResume\">"
                                . "<div>$title</div>"
                            . "</a>"
                        . "</li>";                      
                }
                ?>
                </ul> 
            </div>    
            <div>
                <h3>Publications :</h3>
                <ul>
                <?php
                foreach ($data['sectionPublication'] as $tableName) {
                    echo "<li>"
                            . "<a href=\"admin.php?table=$tableName&action=showTable\">"
                                . "<div>$tableName</div>"
                            . "</a>"
                        . "</li>";
                }
                ?>
                </ul> 
            </div>     
        </div>            
    </form>
</div>       
