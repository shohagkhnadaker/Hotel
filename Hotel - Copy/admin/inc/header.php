<div class="p-2 container-fluid bg-dark d-flex  justify-content-between aling-items-center sticky-top">

    <div>
        <a class="text-decoration-none" href="../index.php">
            <h4 class="h-font navtext">Montreal</h4>
        </a>

    </div>
    <div>
        <a class="text-decoration-none text-black" href="logout.php"><button class="btn bg-white btn-sm text-black fw-bold">Logout</button></a>
    </div>

</div>


<div class="col-lg-2  border-top border-4 border-secondary text-white " id="dashbord_minu" style="height:auto;z-index: 1">
    <nav class="navbar navbar-expand-lg flex-lg-colum navbar-dark bg-dark  rounded" id="navbar_id">
        <div class="container-fluid flex-lg-column aling-items-stretch ">
            <a class="navbar-brand h-font text-white" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin_nav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column aling-items-stretch " id="admin_nav">
                <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashbord.php">Dashbord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="room.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="massage.php">Massage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="feature_facilites.php">feature & facilites</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link text-white" href="carosel.php">Home Carosel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="setting.php">Settings</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</div>


<script>
    function setActive() {
        let nabbar = document.getElementById('navbar_id');
        let a_tag = nabbar.getElementsByTagName('a');



        for (let index = 0; index < a_tag.length; index++) {

            let file = a_tag[index].href.split('/').pop();
            let file_name = file.split('.')[0];
            if (document.location.href.indexOf(file_name) >= 0) {
                a_tag[index].classList.add('active');
            }


        }
    }
    setActive();
</script>