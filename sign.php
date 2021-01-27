<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "APP";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
           echo "failed to connect: ".mysqli_connect_error($conn);
    }
    $first = "select * from districts";
    $second = mysqli_query($conn,$first);
    while($third = mysqli_fetch_assoc($second)){
       if($third['id'] == 1){
          $filename = "/opt/lampp/htdocs/UFT-PP---Recess/APP/kla.dat";
       }
       else if($third['id'] == 2){
          $filename = "/opt/lampp/htdocs/UFT-PP---Recess/APP/muk.dat";
       }
       else if($third['id'] == 3){
          $filename = "/opt/lampp/htdocs/UFT-PP---Recess/APP/kab.dat";
       }

          $fp = fopen($filename,"r+");
     
          fseek($fp,-1,SEEK_END);
          $data = fgets($fp,2);
          if($data == "\0"){
                fseek($fp,-1,SEEK_END);
                fwrite($fp,0);
          } 
    
    fseek($fp,-4,SEEK_END);
    $data = fgets($fp,2);
    if($data == "\0"){
           fseek($fp,-4,SEEK_END);
           fwrite($fp,0);
    } 
    
    $check = "select * from agents where districtID = '$third[id]'";
    $check2 = mysqli_query($conn,$check);
    while($row = mysqli_fetch_assoc($check2)){
          $j = 0;
          $count = 0;
          fseek($fp,199 * 56,SEEK_SET);
          while($count < 26){
               $line = fgets($fp,53);
               $fname = substr($line,3,10);
               $fname = str_replace("\0","",$fname);
               $lname = substr($line,13,10);
               $lname = str_replace("\0","",$lname);
               if((strcmp($row['fName'],$fname) ==0 ) && (strcmp($row['lName'],$lname)==0)){
                         $j = 1;  break;
               } 
               $count++;
          }
          if($j == 0){
               fseek($fp,-1,SEEK_END);
               $data = fgets($fp,2);
               if($data == "\0"){
                      fseek($fp,-1,SEEK_END);
                      fputs($fp,0);
               } 
               fseek($fp,199 * 56,SEEK_SET);
               fseek($fp,$data * 52,SEEK_CUR);
               fseek($fp,4,SEEK_CUR);
               fputs($fp,$row['fName']);
               fseek($fp,199 * 56,SEEK_SET);
               fseek($fp,$data * 52,SEEK_CUR);
               fseek($fp,14,SEEK_CUR);
               fputs($fp,$row['lName']);
               if($row['agentHeadID'] == NUll){
                   fseek($fp,199 * 56,SEEK_SET);
                   fseek($fp,$data * 52,SEEK_CUR);
                   fseek($fp,37,SEEK_CUR);
                   fputs($fp,"H");
                }
               fseek($fp,-1,SEEK_END);
               $data++;
               echo $data;
               fwrite($fp,$data);
          }
    }
    
      $check = "select * from agents where districtID = '$third[id]'";
      $check2 = mysqli_query($conn,$check);
      while($row = mysqli_fetch_assoc($check2)){
              $check3 = "SELECT t.agentID , max_date , amount FROM payments t inner join (SELECT payments.agentID , MAX(month) AS max_date FROM payments WHERE payments.agentID = '$row[id]' GROUP BY payments.agentID) a on a.agentID = t.agentID and a.max_date = month";
              $check4 = mysqli_query($conn,$check3);
              $row2   =  mysqli_fetch_assoc($check4);
              $count = 0;
              while($count < 26){ 
                   fseek($fp,199 * 56,SEEK_SET);
                   fseek($fp,$count * 52,SEEK_CUR);
                   $line = fgets($fp,53);
                   $fname = substr($line,3,10);
                   $fname = str_replace("\0","",$fname);
                   if(strlen($fname) == 0){
                        break;
                   }
                   $lname = substr($line,13,10);
                   $lname = str_replace("\0","",$lname);
                   if((strcmp($fname,$row['fName'])==0) && (strcmp($lname,$row['lName'])==0)){
                      fseek($fp,199 * 56,SEEK_SET);
                      fseek($fp,$count * 52,SEEK_CUR);
                      fseek($fp,41,SEEK_CUR);
                      $amount = (string)$row2['amount'];
                      fputs($fp,$amount);
                   }
                   $count ++;
              }
    }
    $count = 0;
    while($count < 26){
          fseek($fp,199 * 56,SEEK_SET);
          fseek($fp,$count * 52,SEEK_CUR);
          $line = fgets($fp,53);
          $fname = substr($line,3,10);
          $fname = str_replace("\0","",$fname);
          if(strlen($fname) == 0){
                 break;
          }
          $sign  = substr($line,23,2);
          $sign = str_replace("\0","",$sign);
          if(strcmp($sign,"") == 0){
                  fseek($fp,-24,SEEK_END);
                  fputs($fp,"incomplete");
                 break;
          }
          else{ 
                 fseek($fp,-24,SEEK_END);
                 fputs($fp,"complete");
                 fseek($fp,-16,SEEK_END);
                 fputs($fp,"\0");
                 fseek($fp,-15,SEEK_END);
                 fputs($fp,"\0");
          }
                $count++;
    }
   
   fseek($fp,-24,SEEK_END);
   $line = fgets($fp,17);
   $line = str_replace("\0","",$line);
   $z =0;
   if(strcmp($line,"complete") == 0){
         $check = "select * from agents where districtID = '$third[id]'";
         $check2 = mysqli_query($conn,$check);
         while($row = mysqli_fetch_assoc($check2)){
             $count = 0;
             while($count < 26){ 
                  fseek($fp,199 * 56,SEEK_SET);
                  fseek($fp,$count * 52,SEEK_CUR);
                  $line = fgets($fp,53);
                  $fname = substr($line,3,10);
                  $fname = str_replace("\0","",$fname);
                  if(strlen($fname) == 0){
                        break;
                  }
                  $lname = substr($line,13,10);
                  $lname = str_replace("\0","",$lname);
                  $sign  = substr($line,23,2);
                  $sign = str_replace("\0","",$sign);
                  if((strcmp($row['fName'],$fname)==0) && (strcmp($row['lName'],$lname)==0)){
                           if(strcmp($row['signature'],$sign)==0){
                                    fseek($fp,199 * 56,SEEK_SET);
                                    fseek($fp,$count * 52,SEEK_CUR);
                                    fseek($fp,26,SEEK_CUR);
                                    fputs($fp,"valid");
                                    fputs($fp,"\0");
                                    fputs($fp,"\0");
                                    break;
                           } 
                           else{  
                                    fseek($fp,199 * 56,SEEK_SET);
                                    fseek($fp,$count * 52,SEEK_CUR);
                                    fseek($fp,26,SEEK_CUR);
                                    fputs($fp,"invalid");
                                    break;
                           }          
                  } 
                  $count++;
             }
           
         }
         fseek($fp,199 * 56,SEEK_SET);
         $count = 0;
         $k = -1;
             while($count<26){
                  fseek($fp,199 * 56,SEEK_SET);
                  fseek($fp,$count * 52,SEEK_CUR);
                  $line = fgets($fp,53);
                  $fname = substr($line,3,10);
                  $fname = str_replace("\0","",$fname);
                  if(strlen($fname) == 0){
                        break;
                  }
                  $status = substr($line,25,15);
                  $status = str_replace("\0","",$status);  
                  if(strcmp($status,"invalid")==0){
                       fseek($fp,-40,SEEK_END);
                       fputs($fp,"invalid");
                       $k = 0;
                       break;               
                  }
                 $count++;
             }
             if($k == -1){
                   fseek($fp,-40,SEEK_END);
                   fputs($fp,"valid");
                   fputs($fp,"\0");
                   fputs($fp,"\0");
               }      
         
   }
   fseek($fp,-40,SEEK_END);
   $line = fgets($fp,17);
   $line = str_replace("\0","",$line);

   if(strcmp("valid",$line)==0){
               fseek($fp,-4,SEEK_END);
               $data = fgets($fp,2);
               if($data == "\0"){
                      fseek($fp,-1,SEEK_END);
                      fputs($fp,0);
               } 
              while($data<200){
                   fseek($fp,$data * 56,SEEK_SET);
                   $line = fgets($fp,50);
                   $fname       = substr($line,3,10);
                   $fname       = str_replace("\0","",$fname);
                   if(strlen($fname) == 0){
                        break;
                   }    
                   $lname       = substr($line,13,10);
                   $lname       = str_replace("\0","",$lname);
                   $date        = substr($line,23,11);
                   $date        = str_replace("\0","",$date);
                   $sex         = substr($line,34,2);
                   $sex         = str_replace("\0","",$sex);
                   $recommender = substr($line,36,19);
                   $recommender = str_replace("\0","",$recommender);
                   $reco = explode(" ",$recommender);

                    $kigula =  "select * from agents where districtID = '$third[id]' AND agentHeadID is NULL";
                    $jesse = mysqli_query($conn,$kigula);
                    $james = mysqli_fetch_assoc($jesse);

                   
                   if(!(strcmp($recommender,"") == 0)){
                       $select =  "select * from members where fName = '$reco[0]' && LName = '$reco[1]'";
                       $select1 = mysqli_query($conn,$select);
                       $select2 = mysqli_fetch_assoc($select1);
 $check = "INSERT INTO members(fName,lName,gender,dateOfEnrollment,recommenderID,agentID)values('$fname','$lname','$sex','$date',$select2[id],$james[id])";
                       if(!mysqli_query($conn,$check)){
                             echo "Didnt insert".mysqli_error($conn);
                        }
                        else{
                        $z = 1;
                        $data++;
                        fseek($fp,-4,SEEK_END);
                        fwrite($fp,$data);
                        }
                       $select =  "select * from members where lName = '$reco[0]' && fName = '$reco[1]'";
                       $select1 = mysqli_query($conn,$select);
                       $select2 = mysqli_fetch_assoc($select1);
 $check = "INSERT INTO members(fName,lName,gender,dateOfEnrollment,recommenderID,agentID)values('$fname','$lname','$sex','$date',$select2[id],$james[id])";
                       if(!mysqli_query($conn,$check)){
                             echo "Didnt insert".mysqli_error($conn);
                        }
                        else{
                        $z = 1;
                        $data++;
                        fseek($fp,-4,SEEK_END);
                        fwrite($fp,$data);
                        } 
                    }
                    else{
                 
                 $check = "INSERT INTO members(fName,lName,gender,dateOfEnrollment,agentID)values('$fname','$lname','$sex','$date',$james[id])";
                          if(!mysqli_query($conn,$check)){
                             echo "Didnt insert".mysqli_error($conn);
                          }
                          else{
                          $z = 1;
                          $data++;
                          fseek($fp,-4,SEEK_END);
                          fwrite($fp,$data);
                          }
                     }
                    
                    
              } 
   }
    if($z==1){
        $count = 0;
        while($count < 26){ 
              fseek($fp,199 * 56,SEEK_SET);
              fseek($fp,$count * 52,SEEK_CUR);
              $line = fgets($fp,53);
              $fname = substr($line,3,10);
              $fname = str_replace("\0","",$fname);
              if(strlen($fname) == 0){
                        break;
              }
              fseek($fp,199 * 56,SEEK_SET);
              fseek($fp,$count * 52,SEEK_CUR);
              fseek($fp,24,SEEK_CUR);
              $d =0;
              for($d = 0;$d<12;$d++){
              fputs($fp,"\0");
              }
              $count++;
              fseek($fp,-24,SEEK_END);
              fputs($fp,"incomplete");
              fseek($fp,-40,SEEK_END);
              fputs($fp,"invalid");
        }
    }
   fclose($fp);
    }

