<?php
	
	/**
	* 
	*/
	class portfolio
	{

		/**
	     * @var object The database connection
	     */
	    private $db_connection = null;
	    /**
	     * @var array Collection of error messages
	     */
	    public $errors = array();
	    /**
	     * @var array Collection of success / neutral messages
	     */
	    public $messages = array();

		
		function __construct(argument)
		{
			# code...
		}

		private function setDbConnection()
		{
			// create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            if (!$this->db_connection->connect_errno) 
            {
            	return true;
            }
            else
            {
            	return false;
            }
		}

		public function insertNewComment()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}

		}

		public function setExhibitNumLike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function getExhibitNumLike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function setExhibitNumDislike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function getExhibitNumdislike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function setExhibitNumView()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function getExhibitNumView()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function setExhibitNumDownloads()
		{
			
		}
		public function getExhibitNumDownloads()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}



		public function getExhibitComment()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function setCommentNumLike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function getCommentNumLike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function setCommentNumDislike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}
		public function getCommentNumdislike()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
			
		}


	}

?>