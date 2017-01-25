@extends('Front.main')
    @section('content')
    <div id="app-company-history">
    	<div id="content">
            <div class="container">

                <div class="col-sm-9" id="blog-post">
                    <div class="box" v-for="company_history in history_page">

                        <p class="author-date">Tahun <a href="#">@{{ company_history.year }}</a></p>

                        <div id="post-content" style="text-align: justify;">

                            <p>@{{ company_history.description }}</p>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
    </div>
 	@endsection