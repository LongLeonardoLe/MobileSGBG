<?php

class model {
	public $aResult;
	public $oCon;
	public $sHost = "localhost";
	public $sUser =  "root";
	public $sPassword = "";
	public $sDatabase = "sgbg";
	/*public $sHost = "localhost";
	public $sUser =  "saigprga";
	public $sPassword = "27}!=zyI";
	public $sDatabase = "saigprga_shop";*/

	function __construct() {
		$this->oCon = mysqli_connect( $this->sHost, $this->sUser, $this->sPassword, $this->sDatabase);

		if(mysqli_connect_errno()) {
			printf("Connection failed %s\n", mysqli_connect_error());
			exit();
		}

		mysqli_query($this->oCon, "SET NAMES 'utf8'");
	}

	/**
	* Get Query
	**/
	function getQuery($sSql) {
		$this->aResult = mysqli_query($this->oCon,$sSql);
		return $this->aResult;
	}

	/**
	* Return the number of record from the query
	**/
	function getNumRows() {
		if($this->aResult){
			return mysqli_num_rows($this->aResult);
		}
		return 0;
	}

	/**
	* Return 1 record from the query
	**/
	function getFetchArray() { // lấy 1 bảng (table) từ kết quả câu truy vấn
		if($this->aResult){
			return mysqli_fetch_array($this->aResult);
		}
		return null;
	}
	/**
	* Return the number of record from the query
	**/
	function getFetchAssoc() { // lấy 1 bảng (table) từ kết quả câu truy vấn
		if($this->aResult){
			return mysqli_fetch_assoc($this->aResult);
		}
		return null;
	}
}

?>
