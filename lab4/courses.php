<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->      
    <p>
        <?php 
        $filename = "courses.tsv";
        $lines = file($filename); 
        ?>
        Course list has <?= count($lines)?> total courses and size of <?= filesize($filename)?> bytes.
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
//                implement here.
                $resultArray = array_rand($listOfCourses, $numberOfCourses);
                return $resultArray;
            }
        ?>
        <ol>
            <?php 
                $numberOfCourses = $_GET["number_of_courses"];
                if((!isset($numberOfCourses)) or $numberOfCourses = " ") {
                    $numberOfCourses = 3;
                }
                $listOfCourses = $lines;
                $resultArray = array();
                $resultArray = getCoursesByNumber($lines,$numberOfCourses);
                foreach ($resultArray as $todaysCourse) { ?>
                    <li><?= $listOfCourses[$todaysCourse] ?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            $startCharacter = (string)$_GET["startCharacter"];
            if($startCharacter===""){
                $startCharacter = "C";
            }
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
//                implement here.
                foreach ($listOfCourses as $searchedCourses) {
                        if($searchedCourses[0] == $startCharacter) {
                            $resultArray[] = $searchedCourses;
                        }
                    }
                return $resultArray;
            }          
        ?>
        <p>
            Courses that started by <strong>'<?= $startCharacter ?>'</strong> are followings :
        </p>
        <ol>
            <?php     
                $array = getCoursesByCharacter($listOfCourses,$startCharacter);
                foreach ($array as $result) { 
            ?>
            <li><?= $result ?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            

            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;
                $orderby = $_GET["orderby"]; #0:alphabet order, 1:alphabet reverse order
//                implement here.
                if(isset($orderby) and $orderby == 0){
                    sort($resultArray);
                } else {
                    rsort($resultArray);
                }
                return $resultArray;
            }

            $text;
            if(isset($orderby) and $orderby == 0) {
                $text = "Alphabetical order";
            } else {
                $text = "Alphabetical reverse order";
            }
        ?>
        <p>
            All of courses ordered by <strong><?= "$text $orderby" ?></strong> are followings :
        </p>
        <ol>
            <?php 
                $arr = getCoursesByOrder($listOfCourses, $orderby);
                foreach ($arr as $content) { 
                    if ((strlen($content)-8) <= 20) { 
            ?>
                        <li><?= $content ?></li>
                        
            <?php   } else { ?>
                        <li class="long"><?= $content ?></li>
            <?php   } ?>
            
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <?php
            $newCourse = $_GET["newCourse"];;
            $codeOfCourse = $_GET["codeOfCourse"];; 
            if(isset($newCourse) and isset($codeOfCourse) and !empty($codeOfCourse) and !empty($newCourse)) { ?>
                <p>Input course is <?= $newCourse ?> and code of the course is <?= $codeOfCourse ?> </p>
            <?php }
            else  {?>
                <p>Input course or code of the course doesn't exist.</p>               
            <?php } ?>

    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>
