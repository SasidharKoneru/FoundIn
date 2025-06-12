<?php 

class loginController extends baseController {

    public function index() {

    }

    public function recruiter() {
        $this->registry->template->Msg = 'Recruiter Login Page';
        $this->registry->template->show('recruiter/login');
     }

    public function jobseeker() {
        $this->registry->template->show('jobseeker/login');
    }

    public function recruiter_action() {
       $db = $this->registry->db;
       $email = $_POST['email'];
       $result = $this->registry->user->login($db, 'recruiters', $email);
       if (($_POST['password'] === ($result['password']))) {
        $_SESSION['recruiter_id'] = $result['recruiter_id'];
        $_SESSION['company_name'] = $result['company_name'];
        header("Location: index.php?rt=index/admin");
        exit();
       }else {
        $_SESSION['error'] = 'Username or password is invalid!';
        header('Location: index.php?rt=login/recruiter');
        exit();
       }
        
    }

    public function jobseeker_action() {
        $db = $this->registry->db;
        try {
            $query = "SELECT * from jobseekers where email = :email limit 1";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':email', $_POST['email']);
            $stmt->execute();
            $result = $stmt->fetch();
            if (($_POST['password'] === ($result['password']))) {
                $_SESSION['jobseeker_id'] = $result['jobseeker_id'];
                header('Location: index.php?rt=index/home');
                exit();
            } else {
                $_SESSION['error'] = 'Username or password is invalid!';
                header('Location: index.php?rt=login/jobseeker');
                exit();
            }

        } catch(PDOException $e){
            echo $e;
        }
    }

    public function logout() {
        unset($_SESSION['jobseeker_id']);
        $this->registry->template->Msg = "Logged out";
        header("Location: index.php?rt=index/logout");
        exit();
    }

    public function logout_recruiter() {
        unset($_SESSION['recruiter_id']);
        $this->registry->template->Msg = "Logged out";
        header("Location: index.php?rt=index/logout");
        exit();
    }
}

?>