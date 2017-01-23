<div class="container" id="contact" name="contact" data-scrollreveal="enter top after 0.5s">
    <div class="row">
    <br>
        <h1 class="centered">THANKS FOR VISITING US</h1>
        <hr>
        <br>
        <br>
        <div class="col-lg-6">
            <h3>Contact Information</h3>
            <p>
            {{ $footer_content['footer_box_center'] or '' }}
            </p>
        </div><!-- col -->
                
        <div class="col-lg-6">
        <div id="footer-content-js">
            <h3>Newsletter</h3>
            <p>Register to our newsletter and be updated with the latests information regarding our services, offers and much more.</p>
            <p>
                <form method="post" class="form-horizontal" enctype="multipart/form-data" v-on:submit.prevent="storeSubscribe">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label"></label>
                        <div class="col-lg-10">
                            <input v-model="formAttr.email" type="email" name="email" id="email" class="form-control">
                            <div class="form--error--message" id="form--error--message--email"></div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-success">Subscribe</button>
                        </div>
                    </div>
                </form><!-- form -->
            </p>
        </div><!-- col -->
        </div>

    </div><!-- row -->   
</div><!-- container -->

<div id="footerwrap">
    <div class="container">
        <h4 align="left">Created by <a href="http://nusantara-group.co.id">Nusantara Group</a> - Copyright 2016</h4>
    </div>
</div>