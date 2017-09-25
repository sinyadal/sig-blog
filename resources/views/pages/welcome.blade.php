@extends('main')

@section('title', '| Home')

@section('content')

<!-- Start (Content) -->
<div class="container col-md-6 col-md-offset-3"> 
  <div class="row"> 
    <div class="col-md-12">
    <form action="search" method="POST">
        {{ csrf_field() }}
        <input name="search" type="text" class="form-control input-sm" placeholder="Search..">

    </form>
      <h3 class="text-center">SiG Blog</h3>

        @foreach($posts as $post)

            <!-- Two ways to link - 1.  (Curl) url('blog/'.$post->slug) (Curl) or 2. (Curl) route('blog.single', $post->slug) (Curl) -->
            <h4><a style='text-decoration: none;' href="{{ url('blog/'.$post->slug) }}">{{ $post->title }}</a></h4>
            <p>{{ date('M j, Y', strtotime($post->created_at)) }}</p>
            <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : ""}}</p>
            <!-- strip_tag function strip all tag, giving plain text -->
            <a style="text-decoration: none; font-size: 14px;" href="{{ url('blog/'.$post->slug) }}">Read more..</a>

            <hr>



        @endforeach

    </div>
  </div>
</div> <!-- End (Content) -->

@endsection