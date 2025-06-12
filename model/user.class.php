<?php 

class User {
    public function login($db,$userType, $email) {
        try {
            $query = "SELECT * from $userType where email = :email limit 1";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch(PDOException $e){
            echo $e;
            return false;
        }
        return false;
    }

    public function register($db,$userType) {
        try {
            $query = "SELECT * FROM $userType WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':email', $_POST['email']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Email already Exists please try with another email. ";
                header("Location: index.php?rt=register/recruiter");
                exit();
            } else {
            $query = "insert into $userType(company_name, email, password) values(:company, :email, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':company', $_POST['company_name']);
            $stmt->bindparam(':email',$_POST['email']);
            $stmt->bindparam(':password',$_POST['password']);
            $stmt->execute();
            $_SESSION['success'] = "Registered successfully, Login. ";
            header("Location: index.php?rt=register/recruiter");
                exit();
            }

        } catch(PDOException $e){
            echo $e;
        }
    }

    public function register_jobseeker($db,$userType){
        try{
            $query = "SELECT * FROM $userType WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':email', $_POST['email']);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Email already Exists please try with another email. ";
                header("Location: index.php?rt=register/jobseeker");
                exit();
            } else {
            $query = "INSERT INTO $userType(full_name,email,password,phone_number,date_of_birth,gender,education,skills) values(:full_name, :email,:password, :phone_number, :date_of_birth, :gender, :education, :skills)";
            $stmt = $db->prepare($query);
            $stmt->bindparam(':full_name', $_POST['full_name']);
            $stmt->bindparam(':email', $_POST['email']);
            $stmt->bindparam(':password',$_POST['password']);
            $stmt->bindparam(':phone_number', $_POST['phone_number']);
            $stmt->bindparam(':date_of_birth', $_POST['date_of_birth']);
            $stmt->bindparam(':gender', $_POST['gender']);
            $stmt->bindparam(':education', $_POST['education']);
            $stmt->bindparam(':skills', $_POST['skills']);
            $stmt->execute();
            $_SESSION['success'] = "Registration Success. Login";
            }

        } catch(PDOException $e) {
            echo $e;
        }
    }

    public function getUser() {

    }
}

?>