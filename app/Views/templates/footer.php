 <footer class="site-footer bg-primary p-5 pb-4 mt-4 border-top inline-gap">
     <div class="row justify-content-between">
         <div class="col-md-4">
             <div class="footer-element">
                 <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                     <a class="footer-icon icon-main mx-0 mb-2" href="<?=base_url()?>">
                         <img class="img-fluid" src="<?=base_url()?>assets/images/lottery-logo.png" alt="Logo" />
                     </a>
                     <h5 class="fs-14 text-center text-white mb-2"><?= ucwords(strtolower(STATENAME)) ?> State Lotteries
                     </h5>
                 </div>
                 <p class="text-center text-white fs-14">
                     Directorate of Maharashtra State Lotteries,<br>
                     New Administrative Building,<br>
                     Opposite Mantralaya, Mumbai 400 032<br>
                     Telephone Number 022- 22025470</p>
             </div>
         </div>
         <div class="col-md-4">
             <div class="office-desc footer-element">
                 <h5 class="text-white text-center fs-14 mb-2">Office</h5>
                 <p class="text-white text-center fs-14">

                     Office of Dy. Director ( F & A)<br>
                     <span class="fw-bold">Maharashtra State Lotteries</span> ,<br>
                     T-Block, 1st Floor,Plot No7,<br>
                     Dana Bazar, A P M C Market,Sector-19B, Vashi,<br>
                     Navi Mumbai -400 705 <br>
                     <a class="fw-bold" href="<?=base_url()?>"><?=base_url()?></a>
                 </p>
             </div>
         </div>
         <div class="col-md-4">

             <div class="footer-element">
                 <h5 class="text-white text-center fs-15 mb-2">Locate us</h5>

                 <iframe class="iframe w-100" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                     src="https://maps.google.com/maps?width=600&height=400&hl=en&q=Office%20of%20Dy.%20Director%20(%20F%20%26%20A)%20Maharashtra%20State%20Lottery%2C%20T-Block%2C%201st%20Floor%2CPlot%20No7%2C%20Dana%20Bazar%2C%20A%20P%20M%20C%20Market%2CSector-19B%2C%20Vashi%2C%20Navi%20Mumbai%20-400%20705%20&t=&z=14&ie=UTF8&iwloc=B&output=embed"></iframe>
             </div>
         </div>
     </div>
     <hr class="thick w-75 text-ligh mx-auto">
     <p class="text-center font-body text-white draw-terms-para mb-0">
         © <?=date('Y')?> - <?= ucwords(strtolower(STATENAME)); ?> State Lotteries
     </p>

 </footer>
 </div>

 <script src="assets/plugins/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
 <script src="assets/plugins/jquery/jquery-3.7.1.min.js"></script>
 <script>
jQuery(document).ready(function() {
    jQuery(document).on("click", ".menubar-toggle", function() {
        var expanded = jQuery(this).attr("aria-expanded") === "true";
        if (expanded) {
            jQuery("#mainBody-content").addClass("toggle-show");
            jQuery(".menu-backdrop").show();
        } else {
            jQuery("#mainBody-content").removeClass("toggle-show");
            jQuery(".menu-backdrop").hide();
        }
    });
    const $text = $('.marquee-text');
    const $container = $('.marquee-container');
    const containerWidth = $container.width();
    const textWidth = $text.width();
    let left = containerWidth;

    function scroll() {
        left--;
        $text.css('left', left + 'px');

        if (left < -textWidth) {
            left = containerWidth;
        }

        requestAnimationFrame(scroll);
    }

    scroll();
    // jQuery(document).on("click", ".menu-backdrop", function () {
    //   jQuery(".menubar-toggle").trigger("click");
    // });
});
 </script>
 </body>

 </html>