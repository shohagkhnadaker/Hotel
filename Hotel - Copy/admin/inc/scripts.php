<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


<script>
  function alert(type, msg, position = 'body') {
    let bts_cls = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `<div class="alert ${bts_cls} d-flex justify-content-between  alert-dismissible  show " role="alert">
        <div class='mx-3'>
         <strong>${msg}</strong>
        </div>
       <div>
       <button type="button" class="close mx-5-5" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>
 
    </div>
        `;

    if (position == 'body') {
      document.body.append(element);
      element.classList.add('aler_css');

    } else {
      document.getElementById(position).appendChild(element);

    }


    setTimeout(reset_alert, 2000);


  }


  function reset_alert() {

    document.getElementsByClassName('alert')[0].remove();


  }
</script>