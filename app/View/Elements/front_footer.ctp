<!-- FOOTER-->
<div id="footer">
    <div class="section" id="section-footer">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-4 prl">
                        <div class="logo">
                            <a href="#">
                                <?php echo $this->Html->image('logo.png', array("class" => "img-responsive")); ?>
                            </a>
                        </div>

                        <div class="contact-info" style="clear:both;">
                            <ul class="list-unstyled mbn">
                                <li>
                                    <i class="fa fa-map-marker fa-fw">
                                    </i>
                                    D-26, Sector -2, Gautam Budh nagar, Noida , UP, India
                                </li>
                                <li>
                                    <i class="fa fa-mobile fa-fw"></i>
                                    7379-825-666
                                </li>
                            </ul>
                        </div>
<!--                        <div class="app_download">
                            <div class="heading">Download The App</div><br/>
                            <a class="google_play col-md-6" href="#">
                                <?php echo $this->Html->image('google_play.png', array("class" => "img-responsive")); ?>
                            </a>
                            <a class="apple_store col-md-6" href="#">
                                <?php echo $this->Html->image('apple_store.png', array("class" => "img-responsive")); ?>
                            </a>
                        </div>-->
                        <br/>
                        <div class="newsletter-sub">
                        <input type="text" class="form-control" name="newsletter" id="newsletter" title="newsletter" placeholder="Enter your Email-ID">
                        <button class="btn btn-search-comp" id="subscribe">Subscribe</button>
                        <div id="loader" style="display:none"><img src="<?php echo $this->webroot?>img/loader.gif" height="35" ></div>
                        <div id="newsletterErr" class="errors" ></div>
                        </div>
                    </div>
                    <div class="col-md-4 pll prl">                       
                        <div class="fb-page" data-href="https://www.facebook.com/myfeish/" data-tabs="timeline" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/myfeish/">
                                    <a href="https://www.facebook.com/myfeish/">FEISH</a>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pll">
                        <a class="twitter-timeline" href="https://twitter.com/my_feish" data-widget-id="725024429948985344">Tweets by @my_feish</a>
                        <script>!function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + "://platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, "script", "twitter-wjs");</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="section-copyright">
        <div class="container">
            <div class="col-md-8">
                <p class="text-center mbn">
                    &copy; <?php echo date('Y'); ?> Feish.online, product of B3 Digital Solutions Pvt Ltd. All Rights Reserved</p>
                <p class="text-center mbn dscl" style="display: none; font-weight: normal;"> This works best with IE, Mozilla and Chrome browser</p>
            </div>
            <div class="col-md-4">
                <a class="iconss" href="https://www.facebook.com/myfeish/">
                    <i class="fa fa-facebook">
                    </i>
                </a>
                <a class="iconss" href="https://twitter.com/my_feish">
                    <i class="fa fa-twitter">
                    </i>
                </a>
                <a class="iconss" href="#">
                    <i class="fa fa-google-plus">
                    </i>
                </a>
                <a class="iconss" href="https://www.linkedin.com/in/feish-m-b5922a11b">
                    <i class="fa fa-linkedin-square">
                    </i>
                </a>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
    
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
        if(isSafari) {
            $('.dscl').show();
        } else {
            $('.dscl').hide();
        }
        
        $('#subscribe').click(function(){ //alert('click');

            document.getElementById('loader').style.display='block';
            $("#newsletterErr").html(""); 

            var email_id =document.getElementById('newsletter').value;

           // alert('email_id='+email_id);

            if(email_id.trim()=='') {

                     document.getElementById('loader').style.display='none';   
                    
                     $("#newsletterErr").html("Please enter the email Id."); return false;
                }

             var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;               

             if(!emailReg.test( email_id )){

                $("#newsletterErr").html("Please enter a valid email id."); 

              //  $('#newsletter').val('');

                document.getElementById('loader').style.display='none'; 

                return false;
             
             } 

         $.ajax
            ({ 
                url: '<?php echo $this->webroot?>users/ajaxNewsletter',
                data: {"emailid": email_id},
                type: 'post',
                success: function(result)
                { $('#newsletter').val('');
                document.getElementById('loader').style.display='none'; 
                   // $("#newsletterErr").html(result); 

                    if(parseInt(result)){
                    $("#newsletterErr").html('Thanks for subscribing for newsletter'); 
                    }else{
                    $("#newsletterErr").html('Sorry, We have encountered some error in sending your request.Please try later.'); 
                    }
                }
            });
        
        });
        
        //////tawk.to sript
        //<!--Start of Tawk.to Script-->
        var $_Tawk_API={},$_Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/576a36d7e37a3988425344b5/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        //<!--End of Tawk.to Script-->
     </script>

     
</div>

<style>
    .iconss:hover {
        background-color: #006ec3;
        border-color: #006ec3;
        color: #ffffff;
    }
    .iconss {
        width: 40px;
        height: 40px;
        line-height: 40px;
        margin-right: 12px;
        text-align: center;
        border-radius: 50%;
        background-color: transparent;
        border: 1px solid #5ca5dd;
        color: #5ca5dd;
        display: inline-block;
        vertical-align: top;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
        transition: all 0.2s;
    }
</style>
     <span id="cdSiteSeal1"><script type="text/javascript" src="//tracedseals.starfieldtech.com/siteseal/get?scriptId=cdSiteSeal1&amp;cdSealType=Seal1&amp;sealId=55e4ye7y7mb73b781276bdeeb54c1dbzapy7mb7355e4ye705e4caf43f0d82a4d">
</script></span>
     
<script type="text/javascript">
    var _smid = "56sxihzls5wnwv73";
    (function() {
      var sm = document.createElement('script'); sm.type = 'text/javascript'; sm.async = true;
      sm.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.salesmanago.pl/static/sm.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sm, s);
    })();
</script>
<script type="text/javascript">
        var _smid = "56sxihzls5wnwv73"
        //Facebook APP ID - enter only if you do not initialize script earlier
            var _smFbAppId = "539931586214124";
        (function() {
          var smfb = document.createElement('script'); smfb.type = 'text/javascript'; smfb.async = true;
          smfb.onload = smfb.onreadystatechange = function() {smSocInit();smfb.onload = null; smfb.onreadystatechange = null;};
          smfb.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.salesmanago.pl/static/sm_fb.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(smfb, s);
        })();
 </script>
        