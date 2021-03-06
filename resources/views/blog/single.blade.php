@extends('main')

@section('title', "| $post->title") <!-- Double quotation interpolation. Look at the variable inside the double quote! -->

@section('stylesheets')

  {!! Html::script('js/prism.js') !!}
  {!! Html::style('css/prism.css') !!}

@endsection


<style>
	.comment{
		margin-bottom: 30px;
	}
	.author-image
	{
		border-radius: 50%;
		width: 50px;
		height: 50px;
		float: left;
	}
	.author-name
	{
		float: left;
		margin-left: 15px;
	}
	.author-name>h4
	{
		margin: 0px 0px;
	}
	.author-time{
		font-size: 10px;
		color: #aaa;
	}
	.comment-content
	{
		clear:both;
		margin-left: 65px;
	}
</style>



<!-- Page Content -->
    <div class="container">

        <div class="row">





            <!-- Blog Post Content Column -->
            <div class="col-md-12">
              <div class="well">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    in <a href="{{ route('categories.show', @$post->category->id) }}">{{ @$post->category->name }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ date('M j, Y', strtotime($post->created_at)) }}</p>

                <hr>

                <!-- Preview Image -->
                @if($post->image == null)
                  <img class="img-responsive" src="http://placehold.it/900x300" alt="">
          			@else
          				<img src="{{ asset('images/' . $post->image) }}" width="100%">
          			@endif
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $post->body !!}</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well ">
                    {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

            					<div class="row">
            						<div class="col-md-6">
            						 	{{ Form::label('name', 'Name:') }}
            						 	{{ Form::text('name', null, ['class' => 'form-control']) }}
            						</div>
            						<div class="col-md-6">
            							{{ Form::label('email', 'Email:') }}
            							{{ Form::text('email', null, ['class' => 'form-control']) }}
            						</div>
            						<div class="col-md-12">
            							{{ Form::label('comment', 'Comment:') }}
            							{{ Form::textarea('comment', null, ['class' => 'form-control']) }}

            							{{ Form::submit('Send', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top: 20px;']) }}
            						</div>

            				{{ Form::close() }}
                </div></div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                  <h4>{{ $post->comments()->count() }} Comments</h4><br>

                  @foreach ($post->comments as $comment)
            				<div class="comment">
            					<div class="author-info">
            						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm" }}" class="author-image"><!-- trim to remove whitepace-->
            						<div class="author-name">
            							<h4>{{ $comment->name }}</h4>
            							<p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
            						</div>
            					</div>
            					<div class="comment-content">
            						<p>{{ $comment->comment }}</p>
            					</div>
            				</div>
            			@endforeach
            </div>


        </div>
        <!-- /.row -->


    </div>
  </div>
    <!-- /.container -->

@section('content')



@endsection
