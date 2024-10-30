<?php

$q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$value = [1];
$Genarel_r = mysqli_fetch_assoc(select($q, $value, 'i'));

?>





<div class="Footer container pt-5 bg-white">
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <h4 class="h-font fw-bold p-3"><?php echo "$Genarel_r[site_title]"   ?></h4>
            <p> <?php echo "$Genarel_r[site_about]"   ?> </p>
        </div>
        <div class="col-md-4 col-lg-4 text-xs-center">
            <h4>Links</h4>
            <div class="pb-2  ">
                <a class="text-decoration-none text-black fw-bold d-inline-block pb-2" href="index.php">Home</a><br>
                <a class="text-decoration-none text-black fw-bold d-inline-block pb-2" href="room.php">Rooms</a><br>
                <a class="text-decoration-none text-black fw-bold d-inline-block pb-2" href="facility.php">Facalityes</a><br>
                <a class="text-decoration-none text-black fw-bold d-inline-block pb-2" href="about.php">About us</a><br>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 text-md-center text-lg-left text-sm-center text-xs-center  ">




            <div class="bg-white p-2 shadow-sm rounded ">
                <h4>Follow us</h4>

                <?php

                if ($Contract_r['fb'] != '') {
                    echo <<<data
                                     <div class="mb-2"><i class="text-primary bi bi-facebook"></i> <a class="text-decoration-none text-black" target="_blank" href="$Contract_r[fb] ">Facebook</a></div>
                          data;
                }

                if ($Contract_r['tw'] != '') {
                    echo <<<data
 
                                      <div class="mb-2"><i class="text-primary bi bi-twitter"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[tw]">twitter</a></div>


                                data;
                }

                if ($Contract_r['link'] != '') {
                    echo <<<data
                                      <div class="mb-2"><i class="bi bi-linkedin"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[link]">linkedin</a></div>
                          data;
                }


                if ($Contract_r['snap'] != '') {
                    echo <<<data
                                        <div class="mb-2"><i class="bi bi-snapchat text-warning"></i> <a target="_blank" class="text-decoration-none text-black"  href="$Contract_r[snap]">snapchat</a></div>
                          data;
                }


                ?>






            </div>

        </div>

    </div>

</div>

<div class="bg-dark text-center text-light mb-0 container-fluid p-2">@Copy-right by TA Shohag Khandaker</div>


<!-- jqury -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Bootarp -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




<script>
    function setActive() {
        let nabbar = document.getElementById('navbar_id');
        let a_tag = nabbar.getElementsByTagName('a');



        for (let index = 0; index < a_tag.length; index++) {

            let file = a_tag[index].href;
            let file_name = file.split('.')[0];
            if (document.location.href.indexOf(file_name) >= 0) {
                a_tag[index].classList.add('active');
            }


        }
    }
    setActive();
</script>


<script>
    let regiter_frm = document.getElementById('register_frm')

    regiter_frm.addEventListener('submit', function(e) {
        e.preventDefault();

        let frmdata = new FormData();
        frmdata.append('name', regiter_frm.elements['name'].value);
        frmdata.append('email', regiter_frm.elements['email'].value);
        frmdata.append('pass', regiter_frm.elements['pass'].value);
        frmdata.append('cpass', regiter_frm.elements['cpass'].value);
        frmdata.append('number', regiter_frm.elements['number'].value);
        frmdata.append('birth', regiter_frm.elements['birth'].value);
        frmdata.append('address', regiter_frm.elements['address'].value);
        frmdata.append('img', regiter_frm.elements['img'].files[0]);
        frmdata.append('register', '');


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);




        xhr.onload = function() {
            console.log(this.responseText);


            // $('#tream_model').modal('hide');

            // if (this.responseText == 1) {
            //     alert("success", 'Member added successfully');
            //     Get_members();
            //     Team_Member_name_inp.value = "";
            //     Team_member_img_inp.file[0] = '';

            // } else if (this.responseText === "inv_img") {
            //     alert("error", 'invalid image .Image allowed only png,jpeg,webp....! ');

            // } else if (this.responseText === "inv_size") {
            //     alert("error", 'invalid image size. Image allowed less then 2 mb! ');

            // } else if (this.responseText === "img_upd_Fail") {
            //     alert("error", 'image didnt move to about folder ');

            // }


        }

        xhr.send(frmdata);

    })
</script>