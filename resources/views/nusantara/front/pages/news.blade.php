@extends('nusantara.front.layout.main')
    @section('content')
    <div id="app-news">
    	<div id="content">
            <div class="container">

                <div class="col-sm-9" id="blog-post">
                    <div class="box" v-for="news in news">

                        <h1>@{{ news.title }}</h1>
                        <p class="author-date">By <a href="#">John Slim</a> | June 20, 2013</p>

                        <div id="post-content">
                            <p>@{{ news.side_description }}</p>

                            <p>
                                <img :src='news.images' class="img-responsive" alt="@{{ news.title }}">
                            </p>

                            <blockquote>
                                <p>@{{ news.quote_description }}</p>
                            </blockquote>

                            <p>@{{ news.description }}</p>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
    </div>
 	@endsection

