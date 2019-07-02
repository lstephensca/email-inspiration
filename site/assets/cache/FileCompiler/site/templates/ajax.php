<?php namespace ProcessWire;


/*if($input->urlSegment == 'render-specials'){
    $query = [
    	'title' => function($parent) {
            $clients = $parent->find('template=clients');
            return $clients->pageQueryArray(['title']);
        }


    ];

     $test = $pages->find('template=holding,include=hidden')->pageQueryJson($query);
     echo $test;
}*/




if($config->ajax && $input->urlSegment1 == 'create-tag') {

        $parentTag = $_POST['parent'];
        $parentTagLowerCase = strtolower($parentTag);
        
        $tag = $sanitizer->text($_POST['tag']);
        $tagLowerCase = strtolower($tag);

        $p = $pages->findOne("name=$tagLowerCase");

        if($p->id) {
            echo "We are sorry, it appears that this tag has already been added.";
        }
        else {
            $p = new Page();
            $p->template = 'tag';
            $p->parent = $pages->get("/tags/$parentTagLowerCase/");
            $p->name = $tag;
            $p->title = $tag;
            $p->setOutputFormatting(false);
            $p->save();

        }
} 


elseif($config->ajax && $input->urlSegment1 == "upload-preview") {
    $imagePath = $config->paths->assets . "files/pdfs/";

    $title = $sanitizer->text($_POST['title']);
    $rawTags = $input->post->tags;
    $image = $sanitizer->text($_POST['image']);

    $tags = explode(',', $rawTags);

    $p = new Page();
    $p->of(false);
    $p->template = "preview";
    $p->parent = $pages->get("/previews/");
    $p->name = $title;
    $p->title = $title;


    bdump($tags);
    $p->tags->add(array($tags));
    //$p->tags = $tags;
    $p->save();
    $p->setOutputFormatting(false);

    $u = new WireUpload('preview_name');
    $u->setMaxFiles(1);
    $u->setOverwrite(false);
    $u->setDestinationPath($p->preview_image->path());

    $u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));
    foreach($u->execute() as $filename) { $p->preview_image->add($filename); }

    $p->save();




}

elseif($config->ajax && $input->urlSegment1 == "tags") {

    //$tags = $sanitizer->text($_POST['tags']);
    
      //$tag = $sanitizer->text($_POST['tag']);
        $rawTags = $input->post->tags;
        $tags = array_map(
            function($tag) use($sanitizer) {
                return $sanitizer->text($tag);
            },
            is_array($rawTags) ? $rawTags : [$rawTags]
        );

        bdump($rawTags);
        bdump($tags);

        $myArray = explode(',', $rawTags);
        bdump($myArray);
    
            //$p = $pages->get(1092);
            //$p->of(false);
           // $p->dev_test->add(array($myArray));
            //bdump($tags);
                        //add(array(1023,1026))
            //bdump($Test->id);
            //$p->save();

        foreach($tags as $tag) {
            //bdump($tag);
        }


        /*bdump($tags);
        bdump($rawTags);
            $p = $pages->get(1092);
            $p->of(false);
            //$p->tags->add($rawTags);
            //bdump($rawTags);
           //$p->dev_test->add($tags);
            //$p->save("dev_test");

        foreach($tags as $tag) {
            echo $tag;
            $p->dev_test->add($tag); // add another page by id
            $p->save("dev_test");

        }*/
           // $p->save();



    
    



}    



else {}


?>






