 <?php
    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');

    $q = "SELECT * FROM `contracts` WHERE `sr_no`=?";
    $value = [1];
    $Contract_r = mysqli_fetch_assoc(select($q, $value, 'i'));



    ?>





 <!-- nav bar -->
 <nav class="navbar navbar-expand-lg bg-light shadow-sm p-lg-3 sticky-top" id="navbar_id">
     <div class="container-fluid">
         <a class="navbar-brand navtext h-font" href="index.php">Montre`al</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="index.php">Home</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="room.php">Room</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="facility.php">Facilities</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="contact.php">contract</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="about.php">About</a>
                 </li>

             </ul>
             <div class="d-flex">

                 <div class="me-2">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">
                         Login
                     </button>
                 </div>
                 <div class="ml-3">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rejister">
                         Register
                     </button>
                 </div>

             </div>
         </div>
     </div>
 </nav>



 <!--Login Modal -->

 <div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">


             <form>

                 <div class="modal-header d-flex justify-content-between">
                     <h5 class="modal-title"><i class="bi bi-person-square"></i> Login Here</h5>
                     <button type="button" class="close p-1 border-0 bg-white font-weight-bold shadow" data-dismiss="modal" aria-label="Close">
                         <span class="bold" aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">
                     <div class="form-group mb-3">
                         <label>Email address</label>
                         <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                     </div>
                     <div class="form-group mb-3">
                         <label>Password</label>
                         <input type="password" class="form-control" placeholder="Password" required>
                     </div>

                 </div>
                 <div class="modal-footer">

                     <button type="submit" class="btn btn-primary m-auto">Login</button>
                 </div>
             </form>


         </div>
     </div>
 </div>

 <!-- rejister modal -->
 <div class="modal fade  modal-lg m-5" id="rejister" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">


             <form id="register_frm">

                 <div class="modal-header d-flex justify-content-between mt-3 text-center">
                     <h5 class="modal-title text-center"><i class="bi bi-person-square"></i> register Here</h5>
                     <button type="button" class="close p-1 border-0 bg-white font-weight-bold shadow" data-dismiss="modal" aria-label="Close">
                         <span class="bold" aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">

                     <div class="container-fluid">
                         <div class="row">



                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Name</label>
                                     <input name='name' type="Text" class="form-control" aria-describedby="emailHelp" placeholder="Enter name" required>
                                 </div>
                             </div>

                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Email address</label>
                                     <input name='email' type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>
                                 </div>
                             </div>

                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label">Password</label>
                                         <input name='pass' type="password" class="form-control" placeholder="Password" required>
                                 </div>
                             </div>
                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Confirm Password</label>
                                     <input name='cpass' type="password" class="form-control" placeholder="Password" required>
                                 </div>
                             </div>

                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Phone number</label>
                                     <input name='number' type="number" class="form-control" placeholder="Password" required>
                                 </div>
                             </div>

                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label for="exampleInputPassword1">Date of Birth</label>
                                     <input name='birth' type="date" class="form-control" placeholder="select calender" required>
                                 </div>
                             </div>



                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Picture</label>
                                     <input name='img' accept=".jpg,.jpeg,.png,.webp" type="file" class="form-control" required>
                                 </div>
                             </div>

                             <div class="col-6 col-sm-12 col-md-12 col-lg-6">
                                 <div class="form-group mb-3">
                                     <label>Address</label>
                                     <input name="address" type="text" class="form-control" required>
                                 </div>
                             </div>



                         </div>






                     </div>



                 </div>
                 <div class="modal-footer">

                     <button type="submit" class="btn btn-primary m-auto">Register</button>
                 </div>
             </form>


         </div>
     </div>
 </div>