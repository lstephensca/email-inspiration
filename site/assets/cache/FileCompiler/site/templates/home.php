<?php namespace ProcessWire; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/iziModal.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/iziToast.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/main.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/offside.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates ?>styles/slimselect.min.css" />

</head>

<body>
    <!-- container -->
    <div id="container">

        <!-- header -->
        <div id="header">
            <div class="logo">
                <img src="<?php echo $config->urls->templates ?>styles/assets/logo-ch.jpg" alt="" style="width:250px" />
            </div>


        <?php if($user->isLoggedIn() && $user->hasRole('manager') || $user->hasRole('superuser') ): ?>
            <ul id="actions">
                <li><a href="#" id="manager" class="cd-btn js-cd-panel-trigger" data-panel="main">Add Tags/Previews</a></li>
            </ul>
        <?php endif; ?>


        </div>
        <!-- header -->

        <!-- sidebar -->
        <div id="sidebar">
            <div id="sticky">
            <p>Simply click on the filters below to fine-tune your search. You can add multiple filters by simply clicking on them, ie: "Year Month Campaign".</p>
            <div class="tag-search">
                <input type="text" class="input" data-ref="input-search" placeholder="Search by tag" />
            </div>

            <form class="controls">
                <ul>
                    <li><button type="reset" class="control control-text reset">Clear Filters</button></li>
                </ul>

                <fieldset data-filter-group class="control-group">
                    <label class="control-group-label">Filter by Format</label>
                    <?php $formats = $pages->find("template=tag, parent.name=formats"); ?>
                    <ul>
                        <?php foreach ($formats as $format) : ?>
                            <li><button type="button" class="control control-color" data-toggle=".<?= $format->name; ?>"><?= $format->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>
                </fieldset>

                <fieldset data-filter-group class="control-group">
                    <label class="control-group-label">Filter by Year</label>
                    <?php $formats = $pages->find("template=tag, parent.name=years"); ?>
                    <ul>
                        <?php foreach ($formats as $format) : ?>
                            <?php if (1 === preg_match('~[0-9]~', $format->name)) : ?>
                                <li><button type="button" class="control control-color" data-toggle=".<?= "y" . $format->name; ?>"><?= $format->title; ?></button></li>
                            <?php else : ?>
                                <li><button type="button" class="control control-color" data-toggle=".<?= $format->name; ?>"><?= $format->title; ?></button></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </fieldset>

                <fieldset data-filter-group class="control-group">
                    <label class="control-group-label">Filter by Month</label>
                    <?php $formats = $pages->find("template=tag, parent.name=months"); ?>
                    <ul>
                        <?php foreach ($formats as $format) : ?>
                            <li><button type="button" class="control control-color" data-toggle=".<?= $format->name; ?>"><?= $format->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>
                </fieldset>

                <fieldset data-filter-group class="control-group">
                    <label class="control-group-label">Filter by Campaign</label>
                    <?php $formats = $pages->find("template=tag, parent.name=campaigns"); ?>
                    <ul>
                        <?php foreach ($formats as $format) : ?>
                            <li><button type="button" class="control control-color" data-toggle=".<?= $format->name; ?>"><?= $format->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>
                </fieldset>
            </form>


    </div>





        </div>
        <!-- sidebar -->

        <!-- previews -->
        <div id="previews" data-ref="previews">

            <?php $previews = $pages->find("template=preview"); ?>
            <?php foreach ($previews as $preview) : ?>
                <div class="mix item <?php foreach ($preview->tags as $tag) : ?><?php if (1 === preg_match('~[0-9]~', $tag->name)) { echo "y" . $tag->name; } else { echo $tag->name; } ?> <?php endforeach; ?>">
                    <img src="<?= $preview->preview_image->url; ?>" class="image" />

                    <ul class="tags">
                        <?php foreach ($preview->tags as $tag) : ?>
                            <?php /*if (1 === preg_match('~[0-9]~', $tag->name)) {
                                 echo "y" . $tag->name;
                             }
                             else { 
                                echo $tag->name;
                            }*/
                            ?>

                            <?php if(1 === preg_match('~[0-9]~', $tag->name)): ?>
                                <li><button type="button" class="control" data-filter=".<?= "y" . $tag->name; ?>"><?= $tag->title; ?></button></li>

                            <?php else: ?>
                            <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>


                            <?php endif; ?>
                            
                        <?php endforeach; ?>
                    </ul>
            




                </div>
            


            <?php endforeach; ?>

            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
        </div>






    </div>
    <!-- previews -->

    <!-- footer -->
    <div id="footer">
        <p>Footer</p>
    </div>
    <!-- footer -->



    </div>
    <!-- container -->




    <div class="cd-panel cd-panel--from-right js-cd-panel-main">
        <header class="cd-panel__header">
            <h1>Create Tags / Upload New Preview</h1>
            <a href="#0" class="cd-panel__close js-cd-close">Close</a>
        </header>

        <div class="cd-panel__container">
            <div class="cd-panel__content">

                <h2>Create Tags</h2>
                <form action="./" role="form" method="post" id="form-tags">

                    <select id="parent-tags" name="parent-tags">
                        <?php $tags = $pages->find("template=parent-tag"); ?>
                        <option value="">Select Your Tags</option>
                        <?php foreach ($tags as $tag) : ?>
                        <option value="<?= $tag->name; ?>"><?= $tag->title; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input class="input" type="text" id="tags" name="tags" placeholder="Add a Tag">

                    <button type="button" id="create-tag" name="submit" class="frontend-submit button is-fullwidth">Create Tag</button>
                </form>




                <h2>Upload New Preview</h2>
                <form action="./" role="form" method="post" enctype="multipart/form-data" id="form-preview" class="dropzone">
                    <input class="input" type="text" id="preview_title" name="preview_title" placeholder="Image Title">

                    <input class="input" type="file" id="preview_name" name="preview_name">

                    <select id="select-tags" multiple>
                        <?php $tags = $pages->find("template=tag,sort=name"); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <option value="<?= $tag->name; ?>"><?= $tag->title; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="button" id="submit-preview" name="submit" class="button is-fullwidth">Upload Preview</button>
                </form>

            </div> <!-- cd-panel__content -->
        </div> <!-- cd-panel__container -->







        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        <script src="<?php echo $config->urls->templates ?>scripts/jquery.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/mixitup.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/mixitup-multifilter.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/iziToast.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/iziModal.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/slimselect.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/dropzone.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/all.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/offside.min.js"></script>
        <script src="<?php echo $config->urls->templates ?>scripts/main.js"></script>


        <script type="text/javascript">
   
        </script>

</body>

</html>