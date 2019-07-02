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
        <!-- sidebar -->

        <!-- previews -->
        <div id="previews" data-ref="previews">

            <?php $previews = $pages->find("template=preview"); ?>
            <?php foreach ($previews as $preview) : ?>
                <div class="mix item <?php foreach ($preview->tags as $tag) : ?><?php if (1 === preg_match('~[0-9]~', $tag->name)) { echo "y" . $tag->name; } else { echo $tag->name; } ?> <?php endforeach; ?>">
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


        <script type="text/javascript">
            //var grid = new Muuri('.grid');






            $(document).ready(function() {

                // $('#select-tags').select2();
                // $('#parent-tags').select2();

                new SlimSelect({
                    select: '#parent-tags'
                });
                new SlimSelect({
                    select: '#select-tags'
                });


                (function() {
                    // Slide In Panel - by CodyHouse.co
                    var panelTriggers = document.getElementsByClassName('js-cd-panel-trigger');
                    if (panelTriggers.length > 0) {
                        for (var i = 0; i < panelTriggers.length; i++) {
                            (function(i) {
                                var panelClass = 'js-cd-panel-' + panelTriggers[i].getAttribute('data-panel'),
                                    panel = document.getElementsByClassName(panelClass)[0];
                                // open panel when clicking on trigger btn
                                panelTriggers[i].addEventListener('click', function(event) {
                                    event.preventDefault();
                                    addClass(panel, 'cd-panel--is-visible');
                                });
                                //close panel when clicking on 'x' or outside the panel
                                panel.addEventListener('click', function(event) {
                                    if (hasClass(event.target, 'js-cd-close') || hasClass(event.target, panelClass)) {
                                        event.preventDefault();
                                        removeClass(panel, 'cd-panel--is-visible');
                                    }
                                });
                            })(i);
                        }
                    }

                    //class manipulations - needed if classList is not supported
                    //https://jaketrent.com/post/addremove-classes-raw-javascript/
                    function hasClass(el, className) {
                        if (el.classList) return el.classList.contains(className);
                        else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
                    }

                    function addClass(el, className) {
                        if (el.classList) el.classList.add(className);
                        else if (!hasClass(el, className)) el.className += " " + className;
                    }

                    function removeClass(el, className) {
                        if (el.classList) el.classList.remove(className);
                        else if (hasClass(el, className)) {
                            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
                            el.className = el.className.replace(reg, ' ');
                        }
                    }
                })();



            });



            $(document).ready(function() {


                var container = document.querySelector('[data-ref="previews"]');
                var inputSearch = document.querySelector('[data-ref="input-search"]');

                var keyupTimeout;

                var mixer = mixitup(container, {
                    multifilter: {
                        enable: true
                    },
                    animation: {
                        //duration: 350
                        animateResizeContainer: false
                    },
                    callbacks: {
                        onMixClick: function() {
                            // Reset the search if a filter is clicked

                            if (this.matches('[data-filter]')) {
                                inputSearch.value = '';
                            }
                        },
                    }
                });


                // Set up a handler to listen for "keyup" events from the search input

                inputSearch.addEventListener('keyup', function() {
                    var searchValue;

                    if (inputSearch.value.length < 3) {
                        // If the input value is less than 3 characters, don't send

                        searchValue = '';
                    } else {
                        searchValue = inputSearch.value.toLowerCase().trim();
                    }

                    // Very basic throttling to prevent mixer thrashing. Only search
                    // once 350ms has passed since the last keyup event

                    clearTimeout(keyupTimeout);

                    keyupTimeout = setTimeout(function() {
                        filterByString(searchValue);
                    }, 350);
                });

                /**
                 * Filters the mixer using a provided search string, which is matched against
                 * the contents of each target's "class" attribute. Any custom data-attribute(s)
                 * could also be used.
                 *
                 * @param  {string} searchValue
                 * @return {void}
                 */

                function filterByString(searchValue) {
                    if (searchValue) {
                        // Use an attribute wildcard selector to check for matches

                        mixer.filter('[class*="' + searchValue + '"]');
                    } else {
                        // If no searchValue, treat as filter('all')

                        mixer.filter('all');
                    }
                }


             

                $('#create-tag').click(function(e) {
                    $(".frontend-submit").text('Creating your tag...');

                    e.preventDefault();
                    parent = $("#parent-tags").val();
                    tag = $("#tags").val();
                    console.log(tag);
                    form_data = new FormData(); // added
                    form_data.append('parent', parent); // added
                    form_data.append('tag', tag); // added


                    $.ajax({
                        type: 'POST',
                        data: form_data,
                        contentType: false,
                        processData: false,
                        url: '/development/projects/email-inspiration/ajax/create-tag/',
                        success: function(data) {
                            $('#tag-modal').iziModal('close');
                            console.log("Woo");
                            iziToast.show({
                                title: 'Your tag has been created.',
                                titleColor: '#363839',
                                progressBar: true,
                                backgroundColor: '#C9E202',
                                position: 'topCenter',
                                timeout: 5000,

                            });
                            document.getElementById("form-tags").reset();
                            $(".frontend-submit").text('Create Tag');


                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);

                        }
                    });
                });



                $('#submit-preview').click(function(e) {
                    e.preventDefault();
                    title = $("#preview_title").val();
                    tags = $("#select-tags").val();
                    image = $('input[name=preview_name]').prop('files')[0]; // modified
                    form_data = new FormData(); // added
                    form_data.append('preview_name', image); // added
                    form_data.append('title', title); // added
                    form_data.append('tags', tags); // added



                    console.log(title);
                    console.log(tags);
                    console.log(image);
                    $.ajax({
                        type: 'POST',
                        data: form_data,
                        contentType: false,
                        processData: false,
                        url: '/development/projects/email-inspiration/ajax/upload-preview/',
                        success: function(data) {
                            console.log("Woo");
                            document.getElementById("form-preview").reset();

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);

                        }
                    });
                });




                function createVariables() {
                    tags = $("#select-tags").val();

                    for (i = 0, len = tags.length; i < len; i++) {
                        tags[i] = "tags" + i;
                        console.log(tags[i]);
                    }
                    return tags;

                }

            });
        </script>

</body>

</html>