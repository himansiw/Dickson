<?php
include '../model/backup_model.php';
$backupObj = new backup();
if(isset($_REQUEST["status"])) {


    $status = $_REQUEST["status"];
    switch ($status) {

        case "makeBackup":

            $tables = array();
            $showTables = $backupObj->showTables();
//            print_r($showTables);
//            echo'<br>';
            while ($row = $showTables->fetch_row()){
                $tables[] = $row[0];
            }
//            print_r($tables);
            $output = '';
            foreach ($tables as $table){
                $selectTables = $backupObj->selectTable($table);
//                print_r($selectTables);
//                echo'<br>';
                $num_fields = $selectTables->field_count; // number of columns
                $num_rows = $selectTables->num_rows; //number of rows
                $output.= 'DROP TABLE IF EXISTS '.$table.';';
                $getCreateTable = $backupObj->getCreateTable($table);
                $getCreateTableResult = $getCreateTable->fetch_row();
                $output.= "\n\n".$getCreateTableResult[1].";\n\n";
                $counter = 1;

                for ($i = 0; $i <$num_fields; $i++){
                    while ($row = $selectTables->fetch_row()){
                        if ($counter == 1){ //we  can know about the create table query
                            $output.= 'INSERT INTO '.$table.' VALUES('; //write down the INSERT INTO'.table_now.'VALUES
                        }else{
                            $output.= '('; //else then write down(
                        }
                        for ($j = 0; $j <$num_fields; $j++){
                            $row[$j] = addslashes($row[$j]); // eg:vicoria\'s
 //                            print_r($row[$j]);
//                            echo'<br>';
                            $row[$j] = str_replace("\n","\\n", $row[$j]);
//                            print_r($row[$j]);
//                            echo'<br>';
                            if (isset($row[$j])){
                                $output.='"'.$row[$j].'"';
                            } else {
                                $output.='""';  // no data then go empty
                            }
                            if ($j<($num_fields-1)){
                                $output.=',';
                            }
                        }

                        if($num_rows == $counter){
                            $output.= ");\n"; //query is finish last ;
                        }else{
                            $output.="),\n"; //when the counting is not stop then add data set again
                        }
                        ++$counter;
                    }
                }
                $output.= "\n\n\n";
            }
            date_default_timezone_set("Asia/Colombo");
            $file ='../backup/db-backup-'.date("D M j G-i-s T Y",time()).'-'.(sha1(implode(',',$tables))).'.sql';
            $file1 ='C:/xampp/htdocs/dicksons/backup/db-backup-'.date("D M j G-i-s T Y",time()).'-'.(sha1(implode(',',$tables))).'.sql';
            $handle = fopen($file, 'w+');
            fwrite($handle, $output);
            fclose($handle);
            $id= $backupObj->addBackup($file1,$file);

            $msg = "Successfully Downloaded Backup";
            $msg = base64_encode($msg);
            header('Location: ../view/backup.php?msg=' . $msg);


//            header('Content-Description: File Transfer');
//            header('Content-Type: application/octet-stream');
//            header('Content-Disposition: attachment; filename=' . basename($file));
//            header('Content-Transfer-Encoding: binary');
//            header('Expires: 0');
//            header('Cache-Control: must-revalidate');
//            header('Pragma: public');
//            header('Content-Length: ' . filesize($file));
//            ob_clean();
//            flush();
//            readfile($file);
//            unlink($file);


            break;
    }
}