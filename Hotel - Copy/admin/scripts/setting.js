

let g_data;
let c_data;
let updGenarel = document.getElementById('updGenarel');
let site_titel_inp = document.getElementById('site_title_inp');
let site_about_inp = document.getElementById('site_about_inp');
let update_contrats_form = document.getElementById('update_contrats_form');
let Add_team_from = document.getElementById('Add_team_from');



// get genarel siting data

function genare_data() {


    let site_shutdown = document.getElementById('shutdown_toggle');
    let site_titel = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        // console.log(Upload_Image_Path);
        g_data = JSON.parse(this.responseText);
        site_about.innerText = g_data.site_about;
        site_titel.innerText = g_data.site_title;
        site_about_inp.value = g_data.site_about;
        site_title_inp.value = g_data.site_title;

        if (g_data.site_sutdown == 0) {
            site_shutdown.checked = false;
            site_shutdown.value = 0;
        } else {
            site_shutdown.checked = true;
            site_shutdown.value = 1;
        }


    };
    xhr.send('get_genarel');

}

// update genarel seting data

updGenarel.addEventListener('submit', function(e) {
    e.preventDefault();
    upd_Genarel(site_titel_inp.value, site_about_inp.value);

});
// update genarel data
function upd_Genarel(site_title_val, site_about_val) {


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {

        $('#genarelmodal').modal('hide');

        if (this.responseText = 1) {
            alert("success", "updated");
            genare_data();

        } else {
            alert("danger", "updated");

        };


    };



    xhr.send('site_title_val=' + site_title_val + '&site_about_val=' + site_about_val + '&upd_genarel');

}
// update shut down

function upd_shutdown(val) {


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        console.log(this.responseText);
        if (this.responseText == 1 && g_data.site_sutdown == 0) {
            alert("success", "site Shutdown successfully");
            genare_data();

        } else {
            alert("success", "site shutdown off...!");
            genare_data();

        }


    };



    xhr.send('shutdown_val=' + val);

}

// Get contact Data
function getContract_data() {

    let contractId = ['address', 'gmap', 'phn1', 'phn2', 'email', 'fb', 'tw', 'link', 'snap'];
    let ifram = document.getElementById('ifram');



    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        c_data = JSON.parse(this.responseText);
        c_data = Object.values(c_data);
        for (let index = 0; index < contractId.length; index++) {
            document.getElementById(contractId[index]).innerText = c_data[index + 1];

        }

        ifram.src = c_data[10];
        contract_inp(c_data);

    };




    xhr.send('get_contarct');

}


// get input contrat


function contract_inp(c_data) {
    let contractId_inp = ['address_inp', 'gmap_inp', 'phn1_inp', 'phn2_inp', 'email_inp', 'fb_inp', 'tw_inp', 'link_inp', 'snap_inp'];
    for (let index = 0; index < contractId_inp.length; index++) {
        document.getElementById(contractId_inp[index]).value = c_data[index + 1];

    };

    let ifram_inp = document.getElementById('ifram_inp');
    ifram_inp.value = c_data[10];
}
// updates contract data


update_contrats_form.addEventListener('submit', function(e) {

    e.preventDefault();
    Update_contact_value();
});
// updating contract value
function Update_contact_value() {
    let contractname = ['address', 'gmap', 'phn1', 'phn2', 'email', 'fb', 'tw', 'link', 'snap', 'ifram'];
    let contractId_inpval = ['address_inp', 'gmap_inp', 'phn1_inp', 'phn2_inp', 'email_inp', 'fb_inp', 'tw_inp', 'link_inp', 'snap_inp', 'ifram_inp'];
    let data = '';
    for (let index = 0; index < contractname.length; index++) {
        data += contractname[index] + '=' + document.getElementById(contractId_inpval[index]).value + '&';
    }
    data += "contract_update";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {

        $('#conratctmodal').modal('hide');

        if (this.responseText = 1) {
            alert("success", "updated");
            getContract_data();

        } else {
            alert("danger", "update fail");

        };


    };



    xhr.send(data);

}

Add_team_from.addEventListener('submit', function(e) {

    e.preventDefault();
    Add_New_team_member();
})
// insert new team member
function Add_New_team_member() {
    let Team_Member_name_inp = document.getElementById('Team_Member_name_inp');
    let Team_member_img_inp = document.getElementById('Team_member_img_inp');

    let frmdata = new FormData();
    frmdata.append('name', Team_Member_name_inp.value);
    frmdata.append('member_img', Team_member_img_inp.files[0]);
    frmdata.append('add_member', '');


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);




    xhr.onload = function() {

        $('#tream_model').modal('hide');

        if (this.responseText == 1) {
            alert("success", 'Member added successfully');
            Get_members();
            Team_Member_name_inp.value = "";
            Team_member_img_inp.file[0] = '';

        } else if (this.responseText === "inv_img") {
            alert("error", 'invalid image .Image allowed only png,jpeg,webp....! ');

        } else if (this.responseText === "inv_size") {
            alert("error", 'invalid image size. Image allowed less then 2 mb! ');

        } else if (this.responseText === "img_upd_Fail") {
            alert("error", 'image didnt move to about folder ');

        }


    }

    xhr.send(frmdata);

}



function Get_members() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);


    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {

        document.getElementById('team_member_data').innerHTML = this.responseText;

    };
    xhr.send('get_Members');



}

// delete member phpto
function deleteImg(val) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/setting_crud.php", true);

    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {

        if (this.responseText == 1) {
            alert("success", "Member delete successful..!");
            Get_members();
        }
    }



    xhr.send('sr_no=' + val + "&delete_memeber");


};


window.onload = function() {
    genare_data();
    getContract_data();
    Get_members();
}
