<?php


/**
 * Get a Resume to display
 * @param string $sectionTitle
 * @return Resume
 */
function getResumeToDisplay(string $sectionTitle) :Resume {
    $section = ModelSection::getSectionByTitle($sectionTitle);
    $resume = ModelResume::getResumeBySectionId($section->getId());
    
    return $resume;
}


// Data for the headings
$data['resumes'] = array();

$managementPlane = new ManagementPlane();

$parameters = ModelParameter::getAllParameter();

$obj3D = FALSE;
$spotlight = FALSE;
$light = FALSE;
$door = FALSE;

// Add plane of headings
foreach($parameters as $parameter) {      
    if($parameter->getDisplay() === "FALSE" || $parameter->getName() === "Publications") {
        continue;
    }
    if($parameter->getSection() != NULL) {
        $resume = getResumeToDisplay($parameter->getSection());
        $data['resumes'][] = $resume;   
    }
    $scroll = filter_var($parameter->getScroll(), FILTER_VALIDATE_BOOLEAN);
    
    switch($parameter->getName()) {
        case "Front" :  
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -19.3, 3.5, 0, 90, $scroll, "", 1.6);
            break;
        case "Left1" : 
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), 5, 2.5, 14.35, 180, $scroll, "");    
            break;
        case "Left2" :
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -5, 2.5, 14.35, 180, $scroll, ""); 
            break;
        case "Right1" :
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), 5, 2.5, -14.35, 0, $scroll, "");
            break;
        case "Right2" :
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -5, 2.5, -14.35, 0, $scroll, "");
            break;
        case "Middle1" :
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), 3.2, 2.5, 0, 90, $scroll, "");
            break;
        case "Middle2" :
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -2, 2.5, -5.2, 180, $scroll, "");
            break;
        case "Middle3" :    
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -2, 2.5, 5.2, 0, $scroll, "");
            break;
        case "Middle4" :    
            $managementPlane->addPlane("views/htmlPlane/resumePlane.php", "resume".$resume->getId(), -7.1, 2.5, 0, -90, $scroll, "");
            break;
        case "obj3D" :
            $obj3D = TRUE;
            break;
        case "light" :
            $light = TRUE;
            break;
        case "spotlight" :
            $spotlight = TRUE;
            break;
        case "door" :
            $door = TRUE;
            break;
    }     
}


$parameterPublication = ModelParameter::getParameterPublications();
if($parameterPublication->getDisplay() === "TRUE") {
    // Data for publication
    $data['conferences'] = ModelPublication::getAllConferences();
    $data['journals'] = ModelPublication::getAllJournals();
    $data['documentation'] = ModelPublication::getAllDocumentation();
    $data['thesis'] = ModelPublication::getAllThesis();
    $data['miscellaneous'] = ModelPublication::getAllMiscellaneous();
    $data['byDates'] = ModelPublication::getAllPublication();

    // Add publication panel 
    $managementPlane->addPlane("views/htmlPlane/journals.php", "targetJournals", -10.24, 7.6, -9, 90, TRUE, "go-pdf-journals");
    $managementPlane->addPlane("views/htmlPlane/conferences.php", "targetConferences", -10.24, 7.6, 1, 90, TRUE, "go-pdf-conferences");
    $managementPlane->addPlane("views/htmlPlane/miscellaneous.php", "targetMiscellaneous", 6.89 , 7.6, 1, -90, TRUE, "go-pdf-others");
    $managementPlane->addPlane("views/htmlPlane/byDates.php", "targetDates", 6.89, 7.6, -9, -90, TRUE, "go-pdf");  
    $managementPlane->addPlane("views/htmlPlane/documentation.php", "targetDocumentation", -1.656, 7.6, -3, -90, TRUE, "go-pdf-others");
    $managementPlane->addPlane("views/htmlPlane/thesis.php", "targetThesis", -1.548, 7.6, -3, 90, TRUE, "go-pdf-others");
}

// Place the panels
$managementPlane->placeHTML($data);
?>
