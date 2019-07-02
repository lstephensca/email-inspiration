
    <!-- header -->
    <div id="header">
        <div class="logo">
            <img src="<?php echo $config->urls->templates ?>styles/assets/logo-ch.jpg" alt="" />
        </div>


        <div class="column">
            <ul id="admin-actions">
                <li><a href="#0" class="cd-btn js-cd-panel-trigger" data-panel="main">Fire Panel</a></li>

                <!--<li><a href="#" id="add-tag" data-izimodal-open="#tag-modal"><i class="fas fa-tag"></i><span>Add Tag</span></a></li>
                <li><a href="#" id="add-preview" data-izimodal-open="#upload-images"><i class="fas fa-image"></i><span>Add Preview</span></a></li>-->
            </ul>
        </div>
    </div>
    <!-- header -->


    <div id="container">
        <div id="sidebar">
            <p>Simply click on the filters below to fine-tune your search. You can add multiple filters by simply clicking on them, ie: "Year Month Campaign".</p>

            <div class="tag-search">
                <input type="text" class="input" data-ref="input-search" placeholder="Search by tag" />
            </div>

            <form class="controls">
                <ul>
                    <li><button type="reset" class="control control-text">Clear Filters</button></li>
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

    </div>
    <!-- sidebar -->


    <div id="previews" data-ref="previews">

        <?php $previews = $pages->find("template=preview"); ?>
        <?php foreach ($previews as $preview) : ?>
            <div class="mix item <?php foreach ($preview->tags as $tag) : ?><?php if (1 === preg_match('~[0-9]~', $tag->name)) {
                                                                                    echo "y" . $tag->name;
                                                                                } else {
                                                                                    echo $tag->name;
                                                                                } ?> <?php endforeach; ?>">
                <img src="<?= $preview->preview_image->url; ?>" class="image" />
                <ul class="tags">
                    <?php foreach ($preview->tags as $tag) : ?>
                        <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

        <div class="gap"></div>
        <div class="gap"></div>
        <div class="gap"></div>
    </div>


    </div> <!-- end content -->
    </div> <!-- end container -->

    <!-- Tag Modal -->
    <div id="tag-modal" class="iziModal">

    </div>
    <!-- Tag Modal -->


    <!-- Image Preview -->

    <div id="upload-images" class="iziModal">

    </div>



    <div class="cd-panel cd-panel--from-right js-cd-panel-main">
        <header class="cd-panel__header">
            <h1>Title Goes Here</h1>
            <a href="#0" class="cd-panel__close js-cd-close">Close</a>
        </header>

        <div class="cd-panel__container">
            <div class="cd-panel__content">

                <h2>Create Tags</h2>
                <form action="./" role="form" method="post" id="form-tags">

                    <div class="field">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select id="parent-tags" name="parent-tags">
                                    <?php $tags = $pages->find("template=parent-tag"); ?>
                                    <option value="">Select Your Tags</option>
                                    <?php foreach ($tags as $tag) : ?>
                                        <option value="<?= $tag->name; ?>"><?= $tag->title; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" id="tags" name="tags" placeholder="Add a Tag">
                        </div>
                    </div>

                    <button type="button" id="create-tag" name="submit" class="frontend-submit button is-fullwidth">Create Tag</button>
                </form>




                <h2>Upload New Preview</h2>
                <form action="./" role="form" method="post" enctype="multipart/form-data" id="form-preview">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" id="preview_title" name="preview_title" placeholder="Image Title">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input" type="file" id="preview_name" name="preview_name">
                        </div>
                    </div>


                    <div class="field">
                        <div class="control">
                            <select id="multiple" multiple>
                                <?php $tags = $pages->find("template=tag,sort=name"); ?>
                                <?php foreach ($tags as $tag) : ?>
                                    <option value="<?= $tag->name; ?>"><?= $tag->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button type="button" id="submit-preview" name="submit" class="button is-fullwidth">Upload Preview</button>
                </form>
            </div> <!-- cd-panel__content -->
        </div> <!-- cd-panel__container -->


        <div id="footer">
            <img src="<?php echo $config->urls->templates ?>styles/assets/logo-white.png" alt="" />

            <div id="copywrite">
                <p>Copyright 2019 Chumney & Associates | All Rights Reserved | Powered by Creativity</p>
            </div>
        </div>


<!--  -- -- -- -- -- -- -- -- -- -- -- -->
    <script src="<?php echo $config->urls->templates ?>scripts/jquery.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/mixitup.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/mixitup-multifilter.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/iziToast.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/select2.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/masonry.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/muuri.min.js"></script>
    <script src="<?php echo $config->urls->templates ?>scripts/ajax.requests.js"></script>



        <div id="previews" data-ref="previews" class="column">
            <div class="columns is-multiline">

                    <?php $previews = $pages->find("template=preview"); ?>

                    <?php foreach ($previews as $preview) : ?>
                        <div class="mix column is-one-quarter <?php foreach ($preview->tags as $tag) : ?><?= $tag->name; ?> <?php endforeach; ?>">
                            <img src="<?= $preview->preview_image->url; ?>" class="image" />
                            <ul class="tags">
                        <?php foreach ($preview->tags as $tag) : ?>
                                <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                        <?php endforeach; ?>
                            </ul>


                        </div>
                    <?php endforeach; ?>

                    <div class="gap"></div>
                    <div class="gap"></div>
                    <div class="gap"></div>



            </div>

        </div>





                    <form>
                        <fieldset data-filter-group>
                            <h3>Filter By Type</h3>
                            <ul>
                                <li><button type="button" data-filter=".jacket">Emails</button></li>
                                <li><button type="button" data-filter=".sweater">Slides</button></li>
                                <li><button type="button" data-filter=".shirt">Direct Mail</button></li>
                                <li><button type="button" data-filter=".shirt">Why Buy/Advantage</button></li>
                            </ul>
                        </fieldset>

                        <fieldset data-filter-group>
                            <h3>Filter By Year</h3>
                            <ul>
                                <li><button type="button" data-toggle=".red">2016</button></li>
                                <li><button type="button" data-toggle=".blue">2017</button></li>
                                <li><button type="button" data-toggle=".green">2018</button></li>
                                <li><button type="button" data-toggle=".green">2019</button></li>
                                </ul>
                        </fieldset>
                        <fieldset data-filter-group>
                            <h3>Filter By Month</h3>
                            <ul>
                                <li><button type="button" data-toggle=".red">January</button></li>
                                <li><button type="button" data-toggle=".blue">February</button></li>
                                <li><button type="button" data-toggle=".green">March</button></li>
                                <li><button type="button" data-toggle=".green">April</button></li>
                                <li><button type="button" data-toggle=".green">May</button></li>
                                <li><button type="button" data-toggle=".green">June</button></li>
                                <li><button type="button" data-toggle=".green">July</button></li>
                                <li><button type="button" data-toggle=".green">August</button></li>
                                <li><button type="button" data-toggle=".green">September</button></li>
                                <li><button type="button" data-toggle=".green">October</button></li>
                                <li><button type="button" data-toggle=".green">November</button></li>
                                <li><button type="button" data-toggle=".green">December</button></li>
                                </ul>
                        </fieldset>
                        <fieldset data-filter-group>
                            <h3>Filter By Campaign</h3>
                            <ul>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                <li><button type="button" data-toggle=".red">Example</button></li>
                                </ul>
                        </fieldset>
                            <button type="reset">Clear filters</button>

                    </form>










                    <input type="text" class="input" data-ref="input-search" placeholder="Search by tag" />




    <h3>Filter By Type</h3>
                    <ul>
                        <li><button type="button" class="control" data-filter="all">All</button></li>
                        <?php $tags = $pages->find('template=tag'); ?>
                        <?php foreach ($tags as $tag) : ?>
                        <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>


                    <h3>Filter By Year</h3>
                    <ul>
                        <li><button type="button" class="control" data-filter="all">All</button></li>
                        <?php $tags = $pages->find('template=tag'); ?>
                        <?php foreach ($tags as $tag) : ?>
                        <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>


                    <h3>Filter By Month</h3>
                    <ul>
                        <li><button type="button" class="control" data-filter="all">All</button></li>
                        <?php $tags = $pages->find('template=tag'); ?>
                        <?php foreach ($tags as $tag) : ?>
                        <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>




                    <h3>Filter By Campaign</h3>
                    <ul>
                        <li><button type="button" class="control" data-filter="all">All</button></li>
                        <?php $tags = $pages->find('template=tag'); ?>
                        <?php foreach ($tags as $tag) : ?>
                        <li><button type="button" class="control" data-filter=".<?= $tag->name; ?>"><?= $tag->title; ?></button></li>
                        <?php endforeach; ?>
                    </ul>
















<div id="upload-images">
        <form action="./" role="form" method="post" enctype="multipart/form-data">
            <div>
                <label></label>
                <input type="text" id="preview_title" name="preview_title" placeholder="Image Title">
            </div>

            <div>
                <label></label>
                <input type="file" id="preview_name" name="preview_name">
            </div>

            <div>

                <select id="select-tags" name="select-tags" multiple="multiple">
                    <?php $tags = $pages->find("template=tag"); ?>
                    <option value="">Select Your Tags</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= $tag->name; ?>"><?= $tag->name; ?></option>
                    <?php endforeach; ?>

                </select>


            </div>

            <div>
                <button type="button" id="submit-preview" name="submit" class="">Upload Images</button>
            </div>

        </form>
    </div>
