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
			$f_array = file($filename);
			$f_size = filesize($filename);
			$f_line = count($f_array);
			echo "My dictionary has total $f_line words and size of $f_size bytes.";
		?>
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
//                implement here.
                return $resultArray;
            }
        ?>
        <ol>
            <li>CRYPTOGRAPHY - CSE3029</li>
            <li>SOFTWARE CONVERGENCE STRATEGY - CSE3031</li>
            <li>BIG DATA PROCESSING - CSE4036</li>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            Courses that started by <strong>'C'</strong> are followings :
        </p>
        <ol>
            <li>COMPILER CONSTRUCTION - CSE3009</li>
            <li>COMPUTER NETWORKS - CSE3027</li>
            <li>CRYPTOGRAPHY - CSE3029</li>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;
//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
            <li class="long">ARTIFICIAL INTELLIGENCE - CSE4007</li>
            <li>BIG DATA PROCESSING - CSE4036</li>
            <li class="long">COMPILER CONSTRUCTION - CSE3009</li>
            <li>COMPUTER NETWORKS - CSE3027</li>
            <li>CRYPTOGRAPHY - CSE3029</li>
            <li class="long">EMBEDDED OPERATING SYSTEMS - CSE4035</li>
            <li>MOBILE COMPUTING - CSE4045</li>
            <li class="long">SOFTWARE CONVERGENCE STRATEGY - CSE3031</li>
            <li class="long">WEB APPLICATION DEVELOPMENT - CSE3026</li>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <p>Input course or code of the course doesn't exist.</p>
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