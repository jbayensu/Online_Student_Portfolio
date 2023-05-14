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

	    public $exhibits;
		
		/*function __construct(argument)
		{
			# code...
		}*/

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

		public function InsertNewExhibit()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
		}

		public function updateExhibit()
		{
			if($this->setDbConnection()){

			}else{
				$this->errors[] = "Database connection problem.";
			}
		}

		public function getExhibitDetails()
		{
			if($this->setDbConnection()){
				$sql = "SELECT *
                        FROM portfoliotb;";
                $result_of_porfolio_exhibits = $this->db_connection->query($sql);
                // if this data exists
                if ($result_of_porfolio_exhibits->num_rows == 1) {

                    // get result row (as an object)
                    while($exhibit_result_row = $result_of_porfolio_exhibits->fetch_object()){
                    	$exhibits = $exhibit_result_row;
                    }

                }

			}else{
				$this->errors[] = "Database connection problem.";
			}
		}


	}

?>