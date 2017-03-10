@extends('nusantara.front.layout.main')
    @section('content')
    <div id="app-company-visi-misi">
    	<div id="content">
            <div class="container">

                <div class="col-sm-9" id="blog-post">
                    <div class="box" v-for="visi_misi in visi_misi_page">

                        <h1>@{{ visi_misi.title }}</h1>
                        <p class="author-date">By <a href="#">John Slim</a> | June 20, 2013</p>

                        <div id="post-content" style="text-align: justify;">
                            <p>@{{ visi_misi.side_description }}</p>

                            <p>
                                <img :src='visi_misi.images' class="img-responsive" alt="@{{ visi_misi.title }}">
                            </p>

                            <p>@{{ visi_misi.description }}</p>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
    </div>
 	@endsection