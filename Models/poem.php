<?php

class Poem {
    private $conn;
    private $table_name = "NightReader_Poems";
    private $weak_table_name_1 = "NightReader_UserPoems";

    public $pid;
    public $title;
    public $content;
    public $url;
    public $poet_name;
    public $poet_url;

    public function __construct($db) {
        $this->conn = $db;
    }

	function save($user_id) {
		$query = "
			INSERT INTO " . $this->table_name . "
			SET 
            POEM_TITLE=:poem_title, 
            POEM_CONTENT=:poem_content, 
            POEM_URL=:poem_url, 
            POET_NAME=:poet_name, 
            POET_URL=:poet_url";

		$stmt = $this->conn->prepare($query);

		$this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->url = htmlspecialchars(strip_tags($this->url));
        $this->poet_name = htmlspecialchars(strip_tags($this->poet_name));
        $this->poet_url = htmlspecialchars(strip_tags($this->poet_url));

		$stmt->bindParam(":poem_title", $this->title);
		$stmt->bindParam(":poem_content", $this->content);
		$stmt->bindParam(":poem_url", $this->url);
		$stmt->bindParam(":poet_name", $this->poet_name);
		$stmt->bindParam(":poet_url", $this->poet_url);

        if($stmt->execute()) {
			//return true;
            $this->pid = $this->conn->lastInsertId();
		}

        $query = "
			INSERT INTO " . $this->weak_table_name_1 . "
			SET 
            USER_ID=:user_id, 
            POEM_ID=:poem_id";

        $stmt = $this->conn->prepare($query);
        $user_id = htmlspecialchars(strip_tags($user_id));
        $this->pid = htmlspecialchars(strip_tags($this->pid));
		$stmt->bindParam(":user_id", $user_id);
		$stmt->bindParam(":poem_id", $this->pid);

        if($stmt->execute()) {
		    return true;
		}

        return false;
		
	}

    function read() {
		$query = "
			SELECT POEMS.POEM_TITLE, POEMS.POEM_CONTENT, POEMS.POEM_URL, POEMS.POET_NAME, POEMS.POET_URL
			FROM " . $this->table_name . " POEMS
			WHERE POEM.POEM_ID = ?
			LIMIT 0, 1";

		$transaction = $this->conn->prepare($query);
		$transaction->bindParam(1, $this->pid);
		$transaction->execute();

		$row = $transaction->fetch(PDO::FETCH_ASSOC);

		$this->pid = $row['POEM_ID'];
		$this->title = $row['POEM_TITLE'];
		$this->content = $row['POEM_CONTENT'];
		$this->url = $row['POEM_URL'];
		$this->poet_name = $row['POET_NAME'];
		$this->poet_url = $row['POET_URL'];
	}

    function search($keywords, $user_id) {
        $query = "
            SELECT * FROM (
                SELECT POEM_TITLE, POEM_CONTENT, POEM_URL, POET_NAME, POET_URL
                FROM " . $this->table_name . " T1, " . $this->weak_table_name_1 . " T2
                WHERE T1.POEM_ID = T2.POEM_ID AND T2.USER_ID = ? 
            ) T3
            WHERE 
            POEM_TITLE LIKE ? OR POEM_CONTENT LIKE ? OR POET_NAME LIKE ?";
            /*
            SELECT POEM_TITLE, POEM_CONTENT, POEM_URL, POET_NAME, POET_URL FROM nightreader_poems T1 LEFT JOIN nightreader_userpoems ON T1.POEM_ID = nightreader_userpoems.POEM_ID WHERE nightreader_userpoems.USER_ID = 37 
            */
            $stmt = $this->conn->prepare($query);

            $keywords = htmlspecialchars(strip_tags($keywords));
            $user_id = htmlspecialchars(strip_tags($user_id));
            
            $keywords = "%" . $keywords . "%";
            $stmt->bindParam(1, $user_id);
            $stmt->bindParam(2, $keywords);	
            $stmt->bindParam(3, $keywords);
            $stmt->bindParam(4, $keywords);

            $stmt->execute();
            return $stmt;
    }

    function firstFive($user_id) {
        $query = "
            SELECT POEMS.POEM_ID, POEMS.POEM_TITLE, POEMS.POEM_CONTENT, POEMS.POEM_URL, POEMS.POET_NAME, POEMS.POET_URL
            FROM " . $this->table_name . " POEMS, " . $this->weak_table_name_1 . " IDS
            WHERE POEMS.POEM_ID = IDS.POEM_ID AND IDS.USER_ID = :user_id
            ORDER BY POEMS.POEM_ID DESC
            LIMIT 3";

            $stmt = $this->conn->prepare($query);
            $user_id = htmlspecialchars(strip_tags($user_id));
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            return $stmt;
    }

    public function getPid() {
        return $this->pid;
    }

    public function setPid($id) {
        $this->pid = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getPoetName() {
        return $this->poet_name;
    }

    public function setPoetName($poet_name) {
        $this->poet_name = $poet_name;
    }

    public function getPoetUrl() {
        return $this->poet_url;
    }

    public function setPoetUrl($poet_url) {
        $this->poet_url = $poet_url;
    }

    public function toArray() {
        return [
            "pid" => $this->getPid(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "url" => $this->getUrl(),
            "poet_name" => $this->getPoetName(),
            "poet_url" => $this->getPoetUrl()
        ];
    }

}

?>