<?php
class Projects extends Controller
{


    public function __construct()
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/users/login');
        }
        $this->projectModel = $this->model('Project');
    }


    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $success = [];
            if (!empty($_POST['title']) && !empty($_POST['description'] && !empty($_FILES['file']['name']))) {
                $title = trim($_POST['title']);
                $description = trim($_POST['description']);
                $directory = '../app/upload/' . trim($_SESSION['session_id'] . '/');
                $archivename = $directory . $title . '.zip';
                $download_link = trim($_SESSION['session_id']) . '/' . $title . '.zip';
                $parms = [':s_id' => $_SESSION['session_id'], ':tl' => $title, ':dp' => $description, ':dr' => $download_link];

                if ($this->projectModel->upload($parms)) {
                    // Count total files
                    $countfiles = count($_FILES['file']['name']);

                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }

                    $zip = new ZipArchive();

                    if ($zip->open($archivename, ZipArchive::CREATE) === TRUE) {
                        $temp_dir = $directory . "temp";
                        if (!file_exists($temp_dir)) {
                            mkdir($temp_dir, 0777, true);
                        }
                        // Looping all files
                        for ($i = 0; $i < $countfiles; $i++) {
                            $file = $directory . "temp/" . $_FILES['file']['name'][$i];
                            // Upload file
                            move_uploaded_file($_FILES['file']['tmp_name'][$i], $file);
                            $zip->addFile($file);
                        }
                        $zip->close();
                        array_map('unlink', array_filter((array) glob($directory . "temp/*")));
                        rmdir($directory . "temp/");
                    }
                    unset($_POST);
                    unset($_FILES);
                    array_push($success, "your project has been published ");
                    $this->view("projects/create", $success);
                } else {
                    unset($_POST);
                    unset($_FILES);
                    array_push($errors, 'Something went wrong');
                    $this->view("projects/create", $errors);
                }
            } else {
                unset($_POST);
                unset($_FILES);
                array_push($errors, 'Fields are required');
                $this->view("projects/create", $errors);
            }
        }
        $this->view("projects/create");
    }



    public function search()
    {
        if (!empty($_GET['project_title'])) {

            $title = trim($_GET['project_title']);
            $major = $_GET['Major'];
            $prs = [':title' => "%$title%", ':major' => $major];

            $results = $this->projectModel->search_by_title($prs);
            $this->view("projects/search", $results);
        }
    }

    public function profile($student=null)
    {
        $prs = ['student_id' => $student];

        $results = $this->projectModel->search_by_user($prs);

        $this->view("projects/profile", $results);
    }

    public function quick_search()
    {
        if (!empty($_GET['q']) && !empty($_GET['major'])) {
            $title = trim($_GET['q']);
            $major = trim($_GET['major']);
            $prs = [':title' => "%$title%", ':major' => $major];
            $results = $this->projectModel->quick_search($prs);
            if ($results) {
                echo json_encode($results);
            }
        }
    }
}
