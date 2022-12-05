<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                 Copyright &copy;{{ date('Y') }} Pluckit | Powered by : Fusion Web Design
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->


<!-- jQuery  -->

<script src="{{ ('/public') }}/assets/js/jquery.min.js"></script>
<script src="{{ ('/public') }}/assets/js/popper.min.js"></script>
<script src="{{ ('/public') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ ('/public') }}/assets/js/modernizr.min.js"></script>
<script src="{{ ('/public') }}/assets/js/waves.js"></script>
<script src="{{ ('/public') }}/assets/js/jquery.slimscroll.js"></script>
<script src="{{ ('/public') }}/assets/js/jquery.nicescroll.js"></script>
<script src="{{ ('/public') }}/assets/js/jquery.scrollTo.min.js"></script>
<script src="{{ ('/public') }}/assets/js/jquery.fancybox.min.js"></script>
<script src="{{ ('/public') }}/assets/js/thumbs.js"></script>
<script src="{{ ('/public') }}/assets/js/jquery.matchHeight.js"></script>

<script src="{{ ('/public') }}/assets/plugins/skycons/skycons.min.js"></script>
<script src="{{ ('/public') }}/assets/plugins/raphael/raphael-min.js"></script>
<script src="{{ ('/public') }}/assets/plugins/morris/morris.min.js"></script>
<script src="{{ ('/public') }}/assets/plugins/select2/select2.min.js"></script>

<script src="{{ ('/public') }}/assets/pages/dashborad.js"></script>
<script type="text/javascript" src="{{ ('/public') }}/assets/lib/parsleyjs/parsley.min.js"></script>
<script src="{{ ('/public') }}/assets/plugins/jquery.filer/js/jquery.filer.js"/></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


<!-- App js -->
<script src="{{ ('/public') }}/assets/js/app.js"></script>
<!-- Custom js -->
<script src="{{ ('/public') }}/assets/js/custom.js"></script>
<script>

    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons(
                {"color": "#fff"},
        {"resizeClear": true}
        ),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

        for (i = list.length; i--; )
            icons.set(list[i], list[i]);
        icons.play();
    }
    ;

    // scroll

    $(document).ready(function () {

$('#business_id').selectpicker();
        $("#boxscroll").niceScroll({cursorborder: "", cursorcolor: "#cecece", boxzoom: true});
        $("#boxscroll2").niceScroll({cursorborder: "", cursorcolor: "#cecece", boxzoom: true});

    });
</script>
