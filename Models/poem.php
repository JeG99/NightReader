<?php

class Poem {
    private $conn;
    private $table_name = "NightReader_Poems";

    public $pid; // poem id :)
    public $title;
    public $content;
    public $url;
    public $poet_name;
    public $poet_url;

    public function __construct($db) {
        $this->conn = $db;
    }

	function save() {
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

    function search($keywords) {
        $query = "
            SELECT POEMS.POEM_ID, POEMS.POEM_TITLE, POEMS.POEM_CONTENT, POEMS.POEM_URL, POEMS.POET_NAME, POEMS.POET_URL
            FROM " . $this->table_name . " POEMS
            WHERE
                POEMS.POEM_TITLE LIKE ? OR
                POEMS.POEM_CONTENT LIKE ? OR
                POEMS.POET_NAME LIKE ?
            ORDER BY POEMS.POEM_ID DESC";

            $stmt = $this->conn->prepare($query);

            $keywords = htmlspecialchars(strip_tags($keywords));
            $keywords = "%" . $keywords . "%";
            $stmt->bindParam(1, $keywords);	
            $stmt->bindParam(2, $keywords);
            $stmt->bindParam(3, $keywords);

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