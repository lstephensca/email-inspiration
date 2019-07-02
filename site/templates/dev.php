<?php namespace ProcessWire; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/dev.min.css" />

</head>

<body>



    <div class="grid">
        <form action="./" role="form" method="post" enctype="multipart/form-data" id="form-preview">
            <fieldset>
                <input class="input" type="text" id="preview_title" name="preview_title" placeholder="Image Title">
                <input class="input" type="file" id="preview_name" name="preview_name">
                <select id="multiple" multiple>
                <?php foreach ($tags as $tag) : ?>
                    <option value="<?= $tag->name; ?>"><?= $tag->title; ?></option>
                <?php endforeach; ?>
                </select>
                
            </fieldset>

                    <button type="button" id="submit-preview" name="submit" class="button is-fullwidth">Upload Preview</button>
                </form>

    </div>











    <script src="<?php echo $config->urls->templates ?>scripts/jquery.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/all.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/macy.js"></script>


    <script type="text/javascript">
  
    </script>

</body>

</html>