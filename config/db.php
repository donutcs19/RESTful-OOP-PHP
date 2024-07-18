<?php
    require_once("config.php");
    

    class Database extends Config {
        private $table = "users";
        public function fetch($id = 0) {
            $sql = "SELECT * FROM {$this->table}";
            if ($id != 0) {
                $sql .= " WHERE id = :id";
                // "SELECT * FROM users WHERE id = :id";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["id" => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function fetchAll(){
            $sql = "SELECT * FROM {$this->table}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function insert($name, $email, $phone){
            $sql = "INSERT INTO {$this->table}(name, email, phone, create_at) VALUES (:name, :email, :phone, CURRENT_TIMESTAMP)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":name" => $name, ":email" => $email, ":phone" =>$phone]);
            return true;
        }

        public function update($name, $email, $phone, $id){
            $sql = "UPDATE {$this->table} SET name = :name, email = :email, phone = :phone WHERE id =:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["name" => $name, "email" => $email, "phone" => $phone, "id" => $id]);
            return true;
        }

        public function delete ($id){
         $sql = "DELETE FROM {$this->table} WHERE id = :id";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(["id" => $id]);
         return true;   
        }
    }
?>