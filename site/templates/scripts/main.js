// Well hello there. Looks like we don't have any Javascript.
// Maybe you could help a friend out and put some in here?
// Or at least, when ready, this might be a good place for it.

$(document).ready(function () {


    // Select style
    new SlimSelect({select: '#parent-tags'});
    new SlimSelect({select: '#select-tags'});



    // Slide out panel
    (function () {
        // Slide In Panel - by CodyHouse.co
        var panelTriggers = document.getElementsByClassName('js-cd-panel-trigger');
        if (panelTriggers.length > 0) {
            for (var i = 0; i < panelTriggers.length; i++) {
                (function (i) {
                    var panelClass = 'js-cd-panel-' + panelTriggers[i].getAttribute('data-panel'),
                        panel = document.getElementsByClassName(panelClass)[0];
                    // open panel when clicking on trigger btn
                    panelTriggers[i].addEventListener('click', function (event) {
                        event.preventDefault();
                        addClass(panel, 'cd-panel--is-visible');
                    });
                    //close panel when clicking on 'x' or outside the panel
                    panel.addEventListener('click', function (event) {
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



    // Mixitup
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
            onMixClick: function () {
                // Reset the search if a filter is clicked

                if (this.matches('[data-filter]')) {
                    inputSearch.value = '';
                }
            },
        }
    });


    // Set up a handler to listen for "keyup" events from the search input

    inputSearch.addEventListener('keyup', function () {
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

        keyupTimeout = setTimeout(function () {
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



    // Ajax
    $('#create-tag').click(function (e) {
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
            success: function (data) {
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
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);

            }
        });
    });
    
    $('#submit-preview').click(function (e) {
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
            success: function (data) {
                console.log("Woo");
                document.getElementById("form-preview").reset();

            },
            error: function (xhr, ajaxOptions, thrownError) {
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
