<!--     <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>   -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> 
   <script>  
    (function () {  
        var  
         form = $('#html2pdfwrapper'),  
         cache_width = form.width(),  
         a4 = [595.28, 841.89]; // for a4 size paper width and height  
  
        $('#downloadpdf').on('click', function (e) {
            e.preventDefault();  
            $('body').scrollTop(0);  
            $('.panel-collapse:not(".in")').css({'height':'auto'});
            $('.panel-collapse:not(".in")').addClass('in')
            $('.glyphicon-menu-right').addClass('glyphicon-menu-down').removeClass('glyphicon-menu-right');
            createPDF();  
        });  
        //create pdf  
        function createPDF() {  
            getCanvas().then(function (canvas) {  
                var  
                 img = canvas.toDataURL("image/png"),  
                 doc = new jsPDF('a4', 'px', [715, 2241.89]);
                doc.addImage(img, 'JPEG', 0, 0);  
                doc.save('google-business-account-report.pdf');  
                form.width(cache_width);  
            });  
        }  
  
        // create canvas object  
        function getCanvas() {  
            form.width((a4[0] * 1.33333) - 80).css({'max-width':'100%','min-width':'100%'});  
            return html2canvas(form, {  
                imageTimeout: 2000,  
                removeContainer: false  
            });  
        }  
  
    }());  
    $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> 