<?php include("./inc/head.inc");?>

<div class="row">
  <div class="col s12">


    <div class="row">
       <form class="col s12" role="form" method="post" action="./" enctype="multipart/form-data" >
         <div class="row">
           <div class="input-field col s6">
             <label for="client_name">Enter Client Name:</label>
             <input type="text" name="client_name" class="form-control" id="client_name">
           </div>
           <div class="input-field col s6">
             <label for="title">Enter Client Code:</label>
             <input type="text" name="title" class="form-control" id="title">
           </div>
         </div>


                 <div class="row">
                   <div class="input-field col s12">
                     <div class="file-field input-field">
                       <div class="btn">
                         <span>Upload DMP PDF</span>
                         <input type="file" name="dmp_pdf" id="dmp_pdf">
                       </div>
                       <div class="file-path-wrapper">
                         <input class="file-path validate" type="text">
                       </div>

                     </div>
                   </div>
                   </div>
                   <div class="row">

                   <div class="input-field col s12">
                     <div class="file-field input-field">
                       <div class="btn">
                         <span>Upload SS PDF</span>
                         <input type="file" name="ss_pdf" id="dmp_pdf">
                       </div>
                       <div class="file-path-wrapper">
                         <input class="file-path validate" type="text">
                       </div>

                     </div>
                   </div>


                   </div>


                   <div class="row">

                   <div class="input-field col s12">
                     <div class="file-field input-field">
                       <div class="btn">
                         <span>Upload Social Report</span>
                         <input type="file" name="social_pdf" id="social_pdf">
                       </div>
                       <div class="file-path-wrapper">
                         <input class="file-path validate" type="text">
                       </div>

                     </div>
                   </div>


                   </div>

                   <div class="row">

                   <div class="input-field col s12">
                     <div class="file-field input-field">
                       <div class="btn">
                         <span>Upload Eblast Report</span>
                         <input type="file" name="eblast_pdf" id="eblast_pdf">
                       </div>
                       <div class="file-path-wrapper">
                         <input class="file-path validate" type="text">
                       </div>

                     </div>
                   </div>


                   </div>




         <div class="row">
           <div class="input-field col s3 m3 ">
             <button class="btn waves-effect waves-light" type="submit" name="submit" onclick="Materialize.toast('Client Created', 12000)">Submit
               <i class="material-icons right">send</i>
               </button>
           </div>
           <div class="input-field col s3 m3">
             <button class="btn waves-effect waves-light modal-action modal-close red" type="close" name="close">Close
               <i class="material-icons right">close</i>
               </button>
           </div>
           </div>




         </div>
       </form>
     </div>






  </div>

<?php


$sent = false;
$upload_path = $config->paths->assets . "files/pdfs/";

if(isset( $_POST['submit'])){
    // process form input
    //$form->processInput($input->post);

        // if no error occured
        // create new page and save values
        $uploadpage = new Page();
        $uploadpage->template = "upload-client";
        $uploadpage->parent = $pages->get("/clients/");

        // add title/name and make it unique with time and uniqid
        $uploadpage->title = $sanitizer->text($input->post->title);
        $uploadpage->client_name = $sanitizer->text($input->post->client_name);
        //$uploadpage->addStatus(Page::statusUnpublished);  Toggle status of page, now set to Published
        $uploadpage->save();

        $uploadpage->setOutputFormatting(false);

        // instantiate the class and give it the name of the HTML field
        $u = new WireUpload('dmp_pdf');

        // tell it to only accept 1 file
        $u->setMaxFiles(1);

        // tell it to rename rather than overwrite existing files
        $u->setOverwrite(false);

        // have it put the files in their final destination. this should be okay since
        // the WireUpload class will only create PW compatible filenames
        $u->setDestinationPath($uploadpage->dmp_pdf->path());

        // tell it what extensions to expect
        $u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));

        // execute() returns an array, so we'll foreach() it even though only 1 file
        foreach($u->execute() as $filename) { $uploadpage->dmp_pdf->add($filename); }

        // save the page
        $uploadpage->save();

        // instantiate the class and give it the name of the HTML field
        $u = new WireUpload('ss_pdf');

        // tell it to only accept 1 file
        $u->setMaxFiles(1);

        // tell it to rename rather than overwrite existing files
        $u->setOverwrite(false);

        // have it put the files in their final destination. this should be okay since
        // the WireUpload class will only create PW compatible filenames
        $u->setDestinationPath($uploadpage->ss_pdf->path());

        // tell it what extensions to expect
        $u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));

        // execute() returns an array, so we'll foreach() it even though only 1 file
        foreach($u->execute() as $filename) { $uploadpage->ss_pdf->add($filename); }

        // save the page
        $uploadpage->save();

        $u = new WireUpload('social_pdf');

        // tell it to only accept 1 file
        $u->setMaxFiles(1);

        // tell it to rename rather than overwrite existing files
        $u->setOverwrite(false);

        // have it put the files in their final destination. this should be okay since
        // the WireUpload class will only create PW compatible filenames
        $u->setDestinationPath($uploadpage->social_pdf->path());

        // tell it what extensions to expect
        $u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));

        // execute() returns an array, so we'll foreach() it even though only 1 file
        foreach($u->execute() as $filename) { $uploadpage->social_pdf->add($filename); }

        // save the page
        $uploadpage->save();



        $u = new WireUpload('eblast_pdf');

        // tell it to only accept 1 file
        $u->setMaxFiles(1);

        // tell it to rename rather than overwrite existing files
        $u->setOverwrite(false);

        // have it put the files in their final destination. this should be okay since
        // the WireUpload class will only create PW compatible filenames
        $u->setDestinationPath($uploadpage->social_pdf->path());

        // tell it what extensions to expect
        $u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));

        // execute() returns an array, so we'll foreach() it even though only 1 file
        foreach($u->execute() as $filename) { $uploadpage->eblast_pdf->add($filename); }

        // save the page
        $uploadpage->save();



}





if(!$sent){
  //echo $form->render();




} else {
    echo "<p>Form submission succeded. Thanks!</p>";
    echo "<p>Page created: $uploadpage->url</p>";
}
?>

<?php include("./inc/foot.inc");?>
