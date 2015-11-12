<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple Timeline</title>
        <link rel="stylesheet" href="timeline.css">
    </head>
    <body>
        <div>
            <a href="index.php"><h1>Simple Timeline</h1></a>
            <div class="search">
                <!-- Ex 3: Modify forms -->
                <form action="index.php">
                    <input type="submit" value="search">
                    <input type="text" placeholder="Search" name="c_text">
                    <select name="c_type">
                        <option>Author</option>
                        <option>Content</option>
                    </select>
                </form>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <!-- Ex 3: Modify forms -->
                    <form action="add.php"> 
                        <input type="text" placeholder="Author" name="i_type">
                        <div>
                            <input type="text" placeholder="Content" name="i_text">
                        </div>
                        <input type="submit" value="write">
                    </form>
                </div>
				
                <!-- Ex 3: Modify forms & Load tweets -->
				<?php					
					require_once('timeline.php');
					$tclass = new TimeLine();
					
					$g_type = $_GET["c_type"];
					$g_text = $_GET["c_text"];
										
					if (isset($g_text) == true)
					{
						$rdata = $tclass->searchTweets($g_type, $g_text);
					}
					else 
					{
						$rdata = $tclass->loadTweets();
					}
				?>
            </div>
        </div>
    </body>
</html>
