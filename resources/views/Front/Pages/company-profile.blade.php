@extends('Front.main')
    @section('content')
    <div id="app-company-profile">
    	<div id="content">
            <div class="container">

                <div class="col-sm-9" id="blog-post">
                    <div class="box" v-for="companyProfile in profile_page">

                        <h1>@{{ companyProfile.title }}</h1>
                        <p class="author-date">By <a href="#">John Slim</a> | June 20, 2013</p>

                        <div id="post-content" style="text-align: justify;">
                            <p>@{{ companyProfile.side_description }}</p>

                            <p>
                                <img :src='companyProfile.images' class="img-responsive" alt="@{{ companyProfile.title }}">
                            </p>

                            <p>@{{ companyProfile.description }}</p>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
    </div>
 	@endsection