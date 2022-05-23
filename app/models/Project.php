<?php

class project
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function upload($parms)
    {
        $sql = 'insert into projects (publisher_id,Title,Description,directory) values(:s_id,:tl,:dp,:dr)';
        $this->db->query($sql);
        return $this->db->execute($parms);
    }

    public function quick_search($prs)
    {
        $sql = 'select  Title , Description , added_at  , fname , lname from projects  , students  where title LIKE :title AND publisher_id=student_id AND :major=students.major limit 5 ';

        $this->db->query($sql);
        $this->db->execute($prs);
        return $this->db->resultSet();
    }



    public function search_by_title($prs)
    {
        $sql = 'select id, Title ,publisher_id, Description , added_at ,download_count, directory , fname , lname from projects  , students  where title LIKE :title AND publisher_id=student_id AND :major=students.major ';

        $this->db->query($sql);
        $this->db->execute($prs);
        return $this->db->resultSet();
    }

    public function search_by_user($prs)
    {
        $sql = 'select id, Title ,publisher_id, Description , added_at ,download_count, directory , fname , lname from projects  , students  where publisher_id=:student_id';

        $this->db->query($sql);
        $this->db->execute($prs);
        return $this->db->resultSet();
    }
}
