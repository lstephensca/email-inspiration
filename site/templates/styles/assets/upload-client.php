
<?php include("./inc/head.inc");?>
<div class="container">
<div class="row">
  <div class="col m3">
      <a href="http://<?php echo $config->httpHost ?>/thewire"class="waves-effect waves-light btn valign red " style="margin-top:20px;"><i class="material-icons left">skip_previous</i>Go Back</a>
</div>
  <div class="col m9">
    <h4 class="center-align">To Edit, Double Click on the value.</h3>
      <p class="center-align">Unfortunately, as of now, displaying a thumbail is not supported. Please <span class="bold">Double Click</span> on the name to change the pdf.</p>
  </div>
</div>

<div class="row">
  <div class="col s12 m6">
  <div class="card blue-grey darken-1 hoverable card-title">

  <div class="card-content white-text">
    <p class="card-title center-align title">Client Name: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->client_name; ?></span></p>
    <p class="card-title center-align title" edit="title">Client Code: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->title; ?></span></p>
  </div>
  </div>
</div>

  <div class="col s12 m6 mix ford" data-myorder="2">
  <div class="card blue-grey darken-1 hoverable card-title">

  <div class="card-content white-text">
    <div edit="dmp_pdf">DMP PDF: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->dmp_pdf->name; ?></span></div>
    <div edit="ss_pdf">SS PDF: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->ss_pdf->name; ?></span></div>
    <div edit="social_pdf">Social PDF: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->social_pdf->name; ?></span></div>
    <div edit="eblast_pdf">Eblast PDF: <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Double click to edit"><?php echo $page->eblast_pdf->name; ?></span></div>
  </div>
  </div>
</div>



</div>



<!--<div class="fixed-action-btn horizontal">
   <a class="btn-floating btn-large red">
     <i class="large material-icons">mode_edit</i>
   </a>
   <ul>
     <li><a class="btn-floating red"><i class="material-icons">delete</i></a></li>
     <li><a class="btn-floating yellow darken-1"><i class="material-icons">pause_circle_outline</i></a></li>
     <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
     <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
   </ul>
 </div>


</div>-->


<?php include("./inc/foot.inc");?>
