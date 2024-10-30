



    let add_room_frm = document.getElementById('add_room_frm');
    let edit_room_frm = document.getElementById('edite_room_frm');

    let add_room_img_frm = document.getElementById('add_room_img_frm');


    add_room_frm.addEventListener('submit', function(e) {
        e.preventDefault();
        add_room();

    })

    // Add room

    function add_room() {

        let frmdata = new FormData();
        frmdata.append('room_name', add_room_frm.elements['room_name'].value);
        frmdata.append('room_area', add_room_frm.elements['room_area'].value);
        frmdata.append('room_quantity', add_room_frm.elements['room_quantity'].value);
        frmdata.append('room_price', add_room_frm.elements['room_price'].value);
        frmdata.append('room_adult', add_room_frm.elements['room_adult'].value);
        frmdata.append('room_child', add_room_frm.elements['room_child'].value);
        frmdata.append('room_des', add_room_frm.elements['room_des'].value);
        frmdata.append('add_room', '');

        let feature = [];
        //geting feature checked_id
        add_room_frm.elements['feature'].forEach(element => {
            if (element.checked) {
                feature.push(element.value)
            }
        });



        //geting facilitese checked_id
        let facilites = [];

        add_room_frm.elements['facilites'].forEach(element => {
            if (element.checked) {
                facilites.push(element.value)
            }
        });


        frmdata.append('feature', JSON.stringify(feature));
        frmdata.append('facilites', JSON.stringify(facilites));



        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);


        xhr.onload = function() {

            $('#room_model').modal('hide');

            get_All_rooms();
            add_room_frm.reset();
        }

        xhr.send(frmdata);


    }


    // Get room

    function get_All_rooms() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);


        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


        xhr.onload = function() {

            document.getElementById('room_table').innerHTML = this.responseText;

        };
        xhr.send('get_rooms');

    }
    // edite modal data add
    function edit_room(room_id) {




        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);


        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


        xhr.onload = function() {

            $data = JSON.parse(this.responseText)

            edit_room_frm.elements['room_name'].value = $data.rooms.room_name;
            edit_room_frm.elements['room_area'].value = $data.rooms.room_area;
            edit_room_frm.elements['room_quantity'].value = $data.rooms.room_quantity;
            edit_room_frm.elements['room_price'].value = $data.rooms.room_price;
            edit_room_frm.elements['room_adult'].value = $data.rooms.room_adult;
            edit_room_frm.elements['room_child'].value = $data.rooms.room_child;
            edit_room_frm.elements['room_id'].value = $data.rooms.sr_no;
            edit_room_frm.elements['room_des'].value = $data.rooms.room_des;



            edit_room_frm.elements['feature'].forEach(element => {

                if ($data.features.includes(Number(element.value))) {
                    element.checked = true;

                }
            });


            edit_room_frm.elements['facilites'].forEach(element => {

                if ($data.facilites.includes(Number(element.value))) {
                    element.checked = true;
                }
            });


        };
        xhr.send('room_id=' + room_id + "&get_edite_room");


    }
    // change Status

    function change_status(roomid, val) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');



        xhr.onload = function() {


            if (this.responseText = 1) {
                alert("success", "Status changed successfull..!");

                get_All_rooms();

            } else {
                alert("error", "Some thing wrong..!");

            }

        }

        xhr.send('room_id=' + roomid + '&status_value=' + val + '&change_Status');


    }


    // rooom update

    edit_room_frm.addEventListener('submit', function(e) {
        console.log(this.responseText);

        e.preventDefault();

        Update_room();

    })



    function Update_room() {

        let frmdata = new FormData();
        frmdata.append('room_name', edit_room_frm.elements['room_name'].value);
        frmdata.append('room_area', edit_room_frm.elements['room_area'].value);
        frmdata.append('room_quantity', edit_room_frm.elements['room_quantity'].value);
        frmdata.append('room_price', edit_room_frm.elements['room_price'].value);
        frmdata.append('room_adult', edit_room_frm.elements['room_adult'].value);
        frmdata.append('room_child', edit_room_frm.elements['room_child'].value);
        frmdata.append('room_des', edit_room_frm.elements['room_des'].value);
        frmdata.append('room_id', edit_room_frm.elements['room_id'].value);
        frmdata.append('upd_room', '');

        let feature = [];
        //geting feature checked_id
        edit_room_frm.elements['feature'].forEach(element => {
            if (element.checked) {
                feature.push(element.value)
            }
        });



        //geting facilitese checked_id
        let facilites = [];

        edit_room_frm.elements['facilites'].forEach(element => {
            if (element.checked) {
                facilites.push(element.value)
            }
        });


        frmdata.append('feature', JSON.stringify(feature));
        frmdata.append('facilites', JSON.stringify(facilites));



        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);


        xhr.onload = function() {


            $('#room_edite').modal('hide');
            if (this.responseText = 1) {
                alert("success", "Room edite successfull..!");
                edit_room_frm.reset();

                get_All_rooms();

            } else {
                alert("error", "Some thing wrong..!");

            }

        }

        xhr.send(frmdata);



    }

    // Add Room pohoto

    function add_room_IMG() {

        let frmdata = new FormData();
        frmdata.append('room_img', add_room_img_frm.elements['room_img'].files[0]);
        frmdata.append('room_id', add_room_img_frm.elements['room_id'].value);

        frmdata.append('add_room_img', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);




        xhr.onload = function() {

            if (this.responseText == 1) {
                alert("success", 'Room photo added successfully', 'model_alert');
                // Get_facilites();
                add_room_img_frm.reset();
                $room_name = document.querySelector('#Add_img_model  .modal-title').innerText;
                $room_id = add_room_img_frm.elements['room_id'].value;
                room_modal_data($room_id, $room_name);

            } else if (this.responseText === "inv_img") {
                alert("error", 'invalid image .Image allowed only Svg....! ', 'model_alert');

            } else if (this.responseText === "size_img") {
                alert("error", 'invalid image size. Image allowed less then 1 mb! ', 'model_alert');

            } else if (this.responseText === "img_upd_Fail") {
                alert("error", 'image didn`t move to about folder ', 'model_alert');

            }

        }

        xhr.send(frmdata);

    }

    function room_modal_data(room_id, room_name) {

        document.querySelector('#Add_img_model  .modal-title').innerText = room_name;
        add_room_img_frm.elements['room_id'].value = room_id;
        add_room_img_frm.elements['room_name_p'].value = room_name;



        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);


        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


        xhr.onload = function() {

            document.getElementById('room_img_table').innerHTML = this.responseText;

        };
        xhr.send('room_id=' + room_id + '&get_room_allIamge')

    }


    // delete room single photo
    function delete_room_photo(sr_no, room_id) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);

        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.responseText == 1) {
                alert("success", 'Room photo delete successfully', 'model_alert');
                $room_name = document.querySelector('#Add_img_model  .modal-title').innerText;
                room_modal_data(room_id, $room_name);
            } else if (this.responseText == "thum") {
                alert("error", 'this photo now estabilish as a thumnil,fast remove thum', 'model_alert');
            } else {

                alert("eooer", 'someThing wrong', 'model_alert');

            }
        }



        xhr.send('sr_no=' + sr_no + "&room_id=" + room_id + "&delete_room_photo");


    };




    // remove thum


    function remove_thum(sr_no, room_id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/room_crud.php", true);

        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.responseText == 1) {
                alert("success", 'Room Thum changed successfully', 'model_alert');
                $room_name = document.querySelector('#Add_img_model  .modal-title').innerText;
                room_modal_data(room_id, $room_name);
            } else {

                alert("eooer", 'someThing wrong', 'model_alert');

            }
        }



        xhr.send('sr_no=' + sr_no + "&room_id=" + room_id + "&remove_thum");

    }


    // detele room

    // delete member phpto
    function delete_room(room_id) {
        if (confirm('Are you sure you want delete this room?')) {


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/room_crud.php", true);

            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                console.log(this.responseText);
                if (this.responseText == 1) {
                    alert("success", 'Room delete successfully', 'model_alert');
                    get_All_rooms()
                } else {
                    alert("error", 'something wrong', 'model_alert');

                }
            }



            xhr.send('room_id=' + room_id + "&delete_room");
        }



    };



    window.onload = function() {

        get_All_rooms()
    }
