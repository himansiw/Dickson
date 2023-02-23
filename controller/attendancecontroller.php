<?php
if (isset($_REQUEST["status"])) {
    include '../model/attendance_model.php';
    $attendanceObj = new Attendance();
    $status = $_REQUEST["status"];
    switch ($status) {
        case "add_attendance":
            $emp_no = $_POST["emp_no"];
            $emp_name = $_POST["emp_name"];
            $att_date= $_POST["att_date"];
            $att_intime= $_POST["att_intime"];
            $att_outtime= $_POST["att_outtime"];

                if(isset($_POST['importSubmit'])){

                    // Allowed mime types
                    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

                    // Validate whether selected file is a CSV file
                    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

                        // If the file is uploaded
                        if(is_uploaded_file($_FILES['file']['tmp_name'])){

                            // Open uploaded CSV file with read-only mode
                            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                            // Skip the first line
                            fgetcsv($csvFile);

                            // Parse data from CSV file line by line
                            while(($line = fgetcsv($csvFile)) !== FALSE){
                                // Get row data
                                $emp_no   = $line[0];
                                $emp_name  = $line[1];
                                $att_date  = $line[2];
                                $att_intime = $line[3];
                                $att_outtimee = $line[4];

                                    // Insert employee data in the database
                                $attendanceId = $attendanceObj->addAttendance($emp_no, $emp_name, $att_date, $att_intime, $att_outtime);
                                }
                            }

                            // Close opened CSV file
                            fclose($csvFile);
                        $msg = "Successfully Inserted Attendance List  $att_date";
                        $msg = base64_encode($msg);
                        header('Location: ../view/attendance.php?msg=' . $msg);

                        }else{
                        $error = "Some problem occurred, please try again.";
                        $error = base64_encode($error);
                        header('Location: ../view/attendance.php?error=' . $error);
                        }
                    }

            break;
    }
    }