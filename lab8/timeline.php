<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "apmsetup");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		
        public function add($tweet) // This function inserts a tweet
        {
            //Fill out here
			$ex_data = explode("|", $tweet, 2);
			$this->db->exec("insert into tweets(author, contents, time) values('$ex_data[0]', '$ex_data[1]', now())");
        }
		
        public function delete($no) // This function deletes a tweet
        {
            //Fill out here
			$this->db->exec("delete from tweets where no=$no");
        }
		
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
            //Fill out here
			$return_data = $this->db->query("select * from tweets order by time desc");
			
			foreach ($return_data as $r) 
					{?>
						<div class="tweet">
							<form action="delete.php">
								<input type="submit" value="delete">
								<input type="hidden" name="twnum" value=<?= $r["no"]?>>
							</form>
							
							<div class="tweet-info">
								<span><?= $r["author"]?></span>
								<span><?= date("H:i:s m/d/Y", strtotime($r["time"])); ?></span>
							</div>
							
							<div class="tweet-content">
								<?php
									$sh_con = explode(" ", $r["contents"]);
                        
									foreach($sh_con as $sh)
									{
										$sh_st = substr($sh, 1);
										echo preg_replace("/^#\w+/", "<a href='index.php?c_type=Content&c_text=%23$sh_st'>$sh</a>", $sh)." ";
									}
								?>
							</div>
						</div>
				<?php }
        }
		
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
			//Fill out here
			if (empty($query) != true)
			{
				if ($type == "Author")
				{
					$return_data = $this->db->query("select * from tweets where author like '%$query%' order by time desc");
					
					foreach ($return_data as $r) 
					{?>
						<div class="tweet">
							<form action="delete.php">
								<input type="submit" value="delete">
								<input type="hidden" name="twnum" value=<?= $r["no"]?>>
							</form>
							
							<div class="tweet-info">
								<span><?= $r["author"]?></span>
								<span><?= date("H:i:s m/d/Y", strtotime($r["time"])); ?></span>
							</div>
							
							<div class="tweet-content">
								<?php
									$sh_con = explode(" ", $r["contents"]);
                        
									foreach($sh_con as $sh)
									{
										$sh_st = substr($sh, 1);
										echo preg_replace("/^#\w+/", "<a href='index.php?c_type=Content&c_text=%23$sh_st'>$sh</a>", $sh)." ";
									}
								?>
							</div>
						</div>
				<?php }
				}
				else if ($type == "Content")
				{
					$return_data = $this->db->query("select * from tweets where contents like '%$query%' order by time desc");
					
					foreach ($return_data as $r) 
					{?>
						<div class="tweet">
							<form action="delete.php">
								<input type="submit" value="delete">
								<input type="hidden" name="twnum" value=<?= $r["no"]?>>
							</form>
							
							<div class="tweet-info">
								<span><?= $r["author"]?></span>
								<span><?= date("H:i:s m/d/Y", strtotime($r["time"])); ?></span>
							</div>
							
							<div class="tweet-content">
								<?php
									$sh_con = explode(" ", $r["contents"]);
                        
									foreach($sh_con as $sh)
									{
										$sh_st = substr($sh, 1);
										echo preg_replace("/^#\w+/", "<a href='index.php?c_type=Content&c_text=%23$sh_st'>$sh</a>", $sh)." ";
									}
								?>
							</div>
						</div>
				<?php }
				}
			}
			else
			{
				echo "<script>alert(\"Emptry search! Show all timeline.\");</script>";
				$return_data = $this->db->query("select * from tweets order by time desc");
				return $return_data;
			}
        }
    }
?>
