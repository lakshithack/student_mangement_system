<?php 
 $id = $_GET['delete_id'];

 include('connection.php');

 $sql = "DELETE FROM tbl_student WHERE id = $id";
 
 if ($conn->query($sql) === TRUE) {
        $sql = "DELETE FROM tbl_parent WHERE s_id = $id";
 
             if ($conn->query($sql) === TRUE) {
                    echo "<h1>";
                                echo "<center>";
                                    echo "Record deleted Successfully";
                                echo "</center>";
                            echo "</h1>";
                            echo "<br>";

                            header( "refresh:1;url=student_overview.php");
                            echo "<h3>";
                                echo "<center>";
                                    echo 'Redirected In About 1 Seconds...';
                                echo "</center>";
                            echo "</h1>";
                  } else {
                    echo "<h1>";
                                echo "<center>";
                                    echo "Record deleted Failed";
                                echo "</center>";
                            echo "</h1>";
                            echo "<br>";

                            header( "refresh:3;url=student_overview.php");
                            echo "<h3>";
                                echo "<center>";
                                    echo 'Redirected In About 1 Seconds...';
                                echo "</center>";
                            echo "</h1>";
                            echo "<br>";
                            echo $conn->error;
                  }
      } else {
        echo "<h1>";
                    echo "<center>";
                        echo "Record deleted Failed";
                    echo "</center>";
                echo "</h1>";
                echo "<br>";

                header( "refresh:3;url=student_overview.php");
                echo "<h3>";
                    echo "<center>";
                        echo 'Redirected In About 1 Seconds...';
                    echo "</center>";
                echo "</h1>";
                echo "<br>";
                echo $conn->error;
      }

      $conn->close();
?>