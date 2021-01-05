@extends( 'layouts.reports')
@section('title')
    {{$report->title}}
    <a href="{{ route('report') }}"
       class="btn btn-info float-right">Back</a>
@endsection
@section('content')
<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
    <div class="card">
        <table class="table card-table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Data</td>
                       <td>Date</td>
				
                </thead>
                <tbody>
                @foreach($clients->cursor() as $x => $client)
				<?php //die(print_r($client));?>
                    <tr>
                        <td><i>{{$x+1}}</i></td>
               
                              <td><button class="myBtn1"  id="myBtn{{ $client->id}}">Open Modal</button></td>
                               <span style="
    display: none;
" id="hiddentextmyBtn{{$client->id}}">@php urldecode($client->data) @endphp</span>
                                <td>{{$client->created_at}}</td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
             @section('scripts')
 <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
$(".myBtn1").click(function(){
modal.style.display = "block";
 
  var d = this.id; 
  var new_con =$('#hiddentext'+d).text();
 //alert(new_con);
 $('#moc').html(new_con);

    
});




// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
 @append
            <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" id="moc">


</div>
    </div>
@endsection

