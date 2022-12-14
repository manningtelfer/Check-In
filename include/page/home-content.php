<div class="container">
    <div class="check-in-out-container box">
        <div class="check-in">
            <section class="heading-section">
                <h2>Check in</h2>
            </section>
            <form class="check-in-form" name="Check in" action="checkin.php" method="POST">
                <div class="form-item">
                    <input type="text" name="name" id="name" maxlength="32" title="Provide your first and last name." autocomplete="name" required oninvalid="this.setCustomValidity('Provide your first and last name.')" oninput="this.setCustomValidity('')">
                    <label>Name</label>
                </div>
                <div class="form-item">
                    <input type="text" name="number" id="number" title="Provide a valid phone number." autocomplete="tel" required oninvalid="this.setCustomValidity('Provide a valid phone number.')" oninput="this.setCustomValidity('')">
                    <label>Phone</label>
                </div>
                <div class="form-item">
                    <input type="text" name="company" id="company" maxlength="32" autocomplete="organization" placeholder=" ">
                    <label>Company</label>
                </div>
                <button type="submit" name="checkin" id="submit">Check in<i class="fa-solid fa-right-to-bracket fa-fw"></i></button>
            </form>
        </div>
        <div class="check-out">
            <section class="heading-section">
                <h2>Check out</h2>
            </section>
            <div class="form-block">
                <?php
                    $app = parse_ini_file('app.ini');
                    $servername = $app['db_server'];
                    $dbengine = $app['db_engine'];
                    
                    switch ($dbengine) {
                        case '0':
                             //Define connection string
                             $connection = array( "Database"=>$app['db_name'], "UID"=>$app['db_user'], "PWD"=>$app['db_pass'], "TrustServerCertificate"=>$app['db_trustcert']);

                             // Create connection
                            $conn = sqlsrv_connect($servername.','.$app['db_port'], $connection);
                            if( $conn === false ) {
                                die( print_r( sqlsrv_errors(), true));
                            }

                            // Read data
                            $query = "SELECT * FROM visitor_log where status = 1";
                            $result = sqlsrv_query( $conn, $query, array(), array("Scrollable"=>"buffered"));

                            if (sqlsrv_num_rows($result) > 0) {
                            
                                // output data of each row
                                while($row = sqlsrv_fetch_array($result)) {
                                    echo '
                                    <div class="check-out-container">
                                    <div class="check-out-details">
                                        <div class="check-out-details-name">
                                            <div class="check-out-details-name-label">Name:</div>
                                                <div class="check-out-details-name-value">' . $row['name']. '</div>
                                            </div>
                                            <div class="check-out-details-company">
                                                <div class="check-out-details-company-label">Company:</div>
                                                <div class="check-out-details-name-value">' . $row['company'].'</div>
                                            </div>
                                        </div>
                                        <form class="check-out-form" name="Check out" action="checkout.php" method="POST">
                                            <input class="visibly-hidden" name="id" value="' . $row['id'].'">
                                            <button class="check-out-button" type="submit" name="checkout">Check out<i class="fa-solid fa-right-from-bracket fa-fw"></i></button>
                                        </form>
                                    </div>
                                    ';
                                }
                            }
                            else {
                                echo "<p>No visitors are currently checked-in.</p>";
                            }
                            
                            //close sql connection
                            sqlsrv_close($conn);
                            break;

                        case 1:
                            // Define connection string and create connection
                            $conn = mysqli_connect($servername, $app['db_user'], $app['db_pass'], $app['db_name'], $app['db_port']);
                            if( $conn === false ) {
                                die( print_r( mysqli_connect_error(), true));
                            }

                           // Read data
                           $query = "SELECT * FROM visitor_log where status = 1";
                           $result = mysqli_query($conn, $query);

                           if (mysqli_num_rows($result) > 0) {
                           
                               // output data of each row
                               while($row = mysqli_fetch_array($result)) {
                                   echo '
                                   <div class="check-out-container">
                                   <div class="check-out-details">
                                       <div class="check-out-details-name">
                                           <div class="check-out-details-name-label">Name:</div>
                                               <div class="check-out-details-name-value">' . $row['name']. '</div>
                                           </div>
                                           <div class="check-out-details-company">
                                               <div class="check-out-details-company-label">Company:</div>
                                               <div class="check-out-details-name-value">' . $row['company'].'</div>
                                           </div>
                                       </div>
                                       <form class="check-out-form" name="Check out" action="checkout.php" method="POST">
                                           <input class="visibly-hidden" name="id" value="' . $row['id'].'">
                                           <button class="check-out-button" type="submit" name="checkout">Check out<i class="fa-solid fa-right-from-bracket fa-fw"></i></button>
                                       </form>
                                   </div>
                                   ';
                               }
                           }
                           else {
                               echo "<p>No visitors are currently checked-in.</p>";
                           }
                           
                           //close sql connection
                           mysqli_close($conn);
                           break;

                        default:
                            echo('Error: Invalid DB Engine in app.ini');
                    }
                    
                ?>
            </div>
        </div>
    </div>
</div>