@extends('Front.main')
    @section('content')
    <div id="app-contact-us">
    	<div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Contact</li>
                    </ul>

                </div>
                <div class="col-md-12">
                    <div class="box" id="contact" v-for="pageContactUs in pageContactUs.data">
                        <h1>@{{ pageContactUs.title }}</h1>
                        <p class="lead">
                            @{{ pageContactUs.subtitle }}
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Address</h3>
                                <p>
                                @{{ pageContactUs.address }}
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-phone"></i> Call center</h3>
                                <p class="text-muted">
                                <p>
                                <strong>
                                    @{{ pageContactUs.call_center }}
                                </strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3>
                                <i class="fa fa-envelope"></i> 
                                Electronic support
                                </h3>
                                <strong>
                                <a href="mailto:">@{{ pageContactUs.email }}</a>
                                </strong>
                                
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->
                        <hr>

                        <div id="map">

                        </div>

                        <hr>
                        <h2>Contact form</h2>

                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="storeData">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" name="firstname" class="form-control" id="firstname" v-model="formAttr.firstname">
                                        <span v-if="formErrors['firstname']" class="error text-danger"></span>
                                        <div class="form--error--message" id="form--error--message--firstname"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" class="form-control" id="lastname" v-model="formAttr.lastname">
                                        <span v-if="formErrors['lastname']" class="error text-danger"></span>
                                        <div class="form--error--message" id="form--error--message--lastname"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" v-model="formAttr.email">
                                        <span v-if="formErrors['email']" class="error text-danger"></span>
                                        <div class="form--error--message" id="form--error--message--email"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" class="form-control" id="subject" v-model="formAttr.subject">
                                        <span v-if="formErrors['subject']" class="error text-danger"></span>
                                        <div class="form--error--message" id="form--error--message--subject"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea v-model="formAttr.message" id="message" name="message" class="form-control"></textarea>
                                        <span v-if="formErrors['message']" class="error text-danger"></span>
                                        <div class="form--error--message" id="form--error--message--message"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send message</button>

                                </div>
                            </div>
                            <!-- /.row -->
                        </form>


                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
    </div>
 	@endsection

