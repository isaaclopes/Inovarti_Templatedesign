;
(function($, window, undefined) {
        // don't do anything if touch is supported
        // (plugin causes some issues on mobile)
        if('ontouchstart' in document) return;

        // outside the scope of the jQuery plugin to
        // keep track of all dropdowns
        var $allDropdownmenus = $();

        // if instantlyCloseOthers is true, then it will instantly
        // shut other nav items when a new one is hovered over
        $.fn.dropdownmenuHover = function(options) {

            // the element we really care about
            // is the dropdown-toggle's parent
            $allDropdownmenus = $allDropdownmenus.add(this.parent());

            return this.each(function() {
                var $this = $(this),
                $parent = getParent($this),
                defaults = {
                    delay: 500,
                    instantlyCloseOthers: true
                },
                data = {
                    delay: $(this).data('delay'),
                    instantlyCloseOthers: $(this).data('close-others')
                },
                settings = $.extend(true, {}, defaults, options, data),
                timeout;

                $parent.hover(function(event) {
                    // so a neighbor can't open the dropdown
                    if(!$parent.hasClass('active') && !$this.is(event.target)) {
                        return true;
                    }

                    if(settings.instantlyCloseOthers === true)
                        $allDropdownmenus.removeClass('active');

                    window.clearTimeout(timeout);
                    $parent.addClass('active');
                }, function() {
                    timeout = window.setTimeout(function() {
                        $parent.removeClass('active');
                    }, settings.delay);
                });

                // this helps with button groups!
                $this.hover(function() {
                    if(settings.instantlyCloseOthers === true)
                        $allDropdownmenus.removeClass('active');

                    window.clearTimeout(timeout);
                    $parent.addClass('active');
                });
            });
        };
        function getParent($this) {
            var selector = $this.attr('data-target')

            if (!selector) {
                selector = $this.attr('href')
                selector = selector && /#/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
            }

            var $parent = selector && $(selector)

            return $parent && $parent.length ? $parent : $this.parent()
        }
        $(document).ready(function() {
            // apply dropdownHover to all elements with the data-hover="dropdown" attribute
            $('.menu-item-link').dropdownmenuHover();
        });
    })(jQuery, this);