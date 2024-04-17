
        <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
			</li>
      <?php if($_SESSION['login_groupname'] == "Super Admin"){?>

      <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
               User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="add-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Users</p>
                </a>
              </li>
              
			   <li class="nav-item">
                <a href="admin-record.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Record</p>
                </a>
              </li>
             </ul>
          </li>
          <?php } ?>
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
               voter Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              
              <li class="nav-item">
                <a href="upload_student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voter Record </p>
                </a>
              </li>
			  
              
             </ul>
          </li>  

          <li class="nav-item">
            <a href="add_school.php" class="nav-link">
              <p>Candidate Management     </p>
            </a>
          </li>	
          
          <li class="nav-item">
            <a href="add_house.php" class="nav-link">
              <p>Add House      </p>
            </a>
          </li>	
         
          <li class="nav-item">
            <a href="changepassword.php" class="nav-link">
              <p>Change Password</p>
            </a>
          </li>	
                


          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
              Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              
              <li class="nav-item">
                <a href="class_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student by Class </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="house_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student by House </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="status_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student by Status </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="general_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Search </p>
                </a>
              </li>
             </ul>
          </li>  

          <li class="nav-item">
            <a href="activity_log.php" class="nav-link">
              <p>Activity Log</p>
            </a>
          </li>	
          <?php if($_SESSION['login_groupname'] == "Super Admin"){?>

          <li class="nav-item">
            <a href="website_settings.php" class="nav-link">
              <p>Website Management</p>
            </a>
          </li>	
          <?php } ?>
		  
		   <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fa fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>	
		
          <li class="nav-item">
            <a href="../Student/index.php" class="nav-link">
       <i class='fas fa-exchange-alt' style='font-size:18px;color:red'></i>
                 <p class="text">Switch To Student</p>
            </a>
          </li>	
				 
          </li>
          <li class="nav-item">
            <a href="../index.php" class="nav-link">
       <i class='fas fa-exchange-alt' style='font-size:18px;color:red'></i>
                 <p class="text">Switch To Landing Page</p>
            </a>
          </li>	
				 <p class="text"></p>
				 
          </li>
        
				 <p class="text"></p>
		  <p class="text"></p>
		  <p class="text"></p>
		  <p class="text"></p>
		   <p class="text"></p>
		  <p class="text"></p>
		  <p class="text"></p>
		  <p class="text"></p>
				 
          </li>