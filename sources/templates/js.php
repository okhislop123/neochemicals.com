<?php
?>
<script src="<?= URLPATH ?>templates/module/slick/slick.js"></script>
<script src="<?= URLPATH ?>templates/module/aos/js/aos.js"></script>
<script src="<?= URLPATH ?>templates/module/bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<!-- <link href="<?= URLPATH ?>templates/module/font-awesome/css/font-awesome.min.css" rel="stylesheet"/> -->
<script src="<?= URLPATH ?>templates/module/owlcarousel/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="<?= URLPATH ?>templates/module/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
<script src="<?= URLPATH ?>templates/module/lightGallery-master/lib/jquery.mousewheel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.3/dist/js/uikit-icons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    (function($) {
        "use strict";

        $.fn.countUp = function(options) {
            // Defaults
            var settings = $.extend({
                    time: 2000,
                    delay: 10,
                },
                options
            );

            return this.each(function() {
                // Store the object
                var $this = $(this);
                var $settings = settings;

                var counterUpper = function() {
                    if (!$this.data("counterupTo")) {
                        $this.data("counterupTo", $this.text());
                    }
                    var time =
                        parseInt($this.data("counter-time")) > 0 ?
                        parseInt($this.data("counter-time")) :
                        $settings.time;
                    var delay =
                        parseInt($this.data("counter-delay")) > 0 ?
                        parseInt($this.data("counter-delay")) :
                        $settings.delay;
                    var divisions = time / delay;
                    var num = $this.data("counterupTo");
                    var nums = [num];
                    var isComma = /[0-9]+,[0-9]+/.test(num);
                    num = num.replace(/,/g, "");
                    var isInt = /^[0-9]+$/.test(num);
                    var isFloat = /^[0-9]+\.[0-9]+$/.test(num);
                    var decimalPlaces = isFloat ? (num.split(".")[1] || []).length : 0;

                    // Generate list of incremental numbers to display
                    for (var i = divisions; i >= 1; i--) {
                        // Preserve as int if input was int
                        var newNum = parseInt(Math.round((num / divisions) * i));

                        // Preserve float if input was float
                        if (isFloat) {
                            newNum = parseFloat((num / divisions) * i).toFixed(decimalPlaces);
                        }

                        // Preserve commas if input had commas
                        if (isComma) {
                            while (/(\d+)(\d{3})/.test(newNum.toString())) {
                                newNum = newNum
                                    .toString()
                                    .replace(/(\d+)(\d{3})/, "$1" + "," + "$2");
                            }
                        }

                        nums.unshift(newNum);
                    }

                    $this.data("counterup-nums", nums);
                    $this.text("0");

                    // Updates the number until we're done
                    var f = function() {
                        $this.text($this.data("counterup-nums").shift());
                        if ($this.data("counterup-nums").length) {
                            setTimeout($this.data("counterup-func"), delay);
                        } else {
                            delete $this.data("counterup-nums");
                            $this.data("counterup-nums", null);
                            $this.data("counterup-func", null);
                        }
                    };
                    $this.data("counterup-func", f);

                    // Start the count up
                    setTimeout($this.data("counterup-func"), delay);
                };

                // Perform counts when the element gets into view
                $this.waypoint(counterUpper, {
                    offset: "100%",
                    triggerOnce: true
                });
            });
        };
    })(jQuery);
    $('.counter').countUp();
</script>
<script src="<?= URLPATH ?>templates/js/main.js"></script>
