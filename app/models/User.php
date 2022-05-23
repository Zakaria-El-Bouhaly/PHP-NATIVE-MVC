<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    function is_student($st_code,  $fn,  $ln)
    {
        $sql = 'select * from all_students where id = :st_code AND fname LIKE :f_name AND lname LIKE :l_name';
        $this->db->query($sql);
        $p = [':st_code' => $st_code, ':f_name' => $fn, ':l_name' => $ln];
        $this->db->execute($p);
        $count = $this->db->rowCount();
        if ($count > 0) {
            return true;
        }
        return true;  //testing purposes
    }

    public function Already_exist($email, $code)
    {
        $sql = 'select * from students where email = :email or code_st = :code';
        $this->db->query($sql);
        $p = [':email' => $email, ':code' => $code];
        $this->db->execute($p);
        $count = $this->db->rowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function register($data)
    {
        $sql = "insert into students (code_st, fname, lname,email, password,major) values(:code,:fname,:lname,:email,:pass,:major)";
        $this->db->query($sql);
        if ($this->db->execute($data)) {
            return true;
        }
        return false;
    }




    public function login($data)
    {
        $sql = 'select * from students where   code_st = :code';
        $this->db->query($sql);
        $p = [':code' => $data["login_code"]];
        $this->db->execute($p);
        $result = $this->db->single();

        if (
            $this->db->rowCount() == 1
            && password_verify($data['password'], $result['password'])
        ) {
            return $result;
        }
        return false;
    }
}
