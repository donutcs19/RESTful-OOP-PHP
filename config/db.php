<?php
    require_once("config.php");

    class Database extends Config {
        public function fetch($id = 0){
            $sql = "SELECT * FROM users";
            if ($id != 0){
                $sql .="WHERE id = :id";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["id" => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function insert($name, $email, $phone){
            $sql = "INSERT INTO users(name, email, phone, create_at) VALUES (:name, :email, :phone, CURRENT_TIMESTAMP)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":name" => $name, ":email" => $email, ":phone" =>$phone]);
            return true;
        }
    }
?>