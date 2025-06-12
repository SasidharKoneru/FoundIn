<?php 

class importController extends baseController {

    public function index() {

    }

    public function importCSV() {
        echo " inside importCSV function ";
            // Handle the uploaded file
            $file = $_FILES['csv_file'];
            echo " File handling ";
        
            if ($file['error'] == 0) {
                // Get file details
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileType = $file['type'];
                $fileSize = $file['size'];
        
                // Check if the uploaded file is a CSV
                if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) != 'csv') {
                    $_SESSION['import_error'] = "Please upload a valid excel file.";
                    header("Location: index.php?rt=index/postJob");
                    exit;
                }
                $uploadDir = 'uploads/';
                $uploadFilePath = $uploadDir . basename($fileName);

                if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                    echo "File uploaded successfully.";
                    // Now process the CSV file and insert data into the database
                    $recruiter_id = $_SESSION['recruiter_id'];
                    $registry = $this->registry;
                    $this->registry->import->processCSV($uploadFilePath, $recruiter_id, $registry);
                } else {
                    echo "Error uploading the file.";
                    $_SESSION['import_error'] = "Import Unsuccessfull.";
                }
        }
        
        header("Location: index.php?rt=index/postJob");
        exit();
    }  
    
    public function importXML() {
        //$_SESSION['import_msg'] = "inside importXML";
        $file = $_FILES['xml_file'];
        unset($_SESSION['import_msg']);
        //$_SESSION['import_msg'] = " File handling ";
        
            if ($file['error'] == 0) {
                // Get file details
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileType = $file['type'];
                $fileSize = $file['size'];
                $xml = simplexml_load_file($_FILES['xml_file']['tmp_name']);
                //$_SESSION['import_msg'] = "after simplexml()";
                // Check if the uploaded file is a CSV
                if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) != 'xml') {
                    $_SESSION['import_error'] = "Please upload a valid XML file.";
                    header("Location: index.php?rt=index/postJob");
                    exit;
                }
                $uploadDir = 'uploads/';
                $uploadFilePath = $uploadDir . basename($fileName);

                if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                    //$_SESSION['import_msg'] = "File uploaded successfully.";
                    // Now process the CSV file and insert data into the database
                    $recruiter_id = $_SESSION['recruiter_id'];
                    $registry = $this->registry;
                    $this->registry->import->processXML($xml, $recruiter_id, $registry);
                } else {
                    echo "Error uploading the file.";
                    $_SESSION['import_error'] = "Import Unsuccessfull.";
                }
            }
            header("location: index.php?rt=index/postJob");
            exit();
    }
}
?>