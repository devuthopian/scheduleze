@extends('layouts.front')

@section('content')
<div class="banner_section">
    <div class="container">
        <h2>FAQ</h2> 
        <p>Here are some FAQs</p>     
    </div>
</div>
<div class="content_section">
    <div class="container">
        <div class="content_left">
            @foreach($items as $category)
                <h3 class="faq-category">{!! $category->name !!}</h3>
                    <div class="body col-lg-12">
                        <div id="faq-box" class="row mt-3">
                            <div class="{{ $category->slug }}">
                                @foreach($category->faqs as $faq)

                                    <div class="mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent=".{{ $category->slug }}" href="#faq-{{ $faq->id }}">{!! $faq->question !!}</a>
                                            </h4>
                                        </div>
                                        <div id="faq-{{ $faq->id }}" class="card-collapse collapse" data-id="{{ $faq->id }}">
                                            <div class="card-body">
                                                {!! $faq->answer !!}
                                            </div>
                                            <div id="faq-footer-{{ $faq->id }}" class="card-footer" style="border-top: 1px solid #ddd;">
                                                <div class="btn-group btn-group-sm">
                                                    <span class="btn" style="padding-left: 0px;">Was this question helpful?</span>
                                                    <a class="btn btn-success btn-helpful" href="#" data-id="{{ $faq->id }}" data-type="helpful_yes">
                                                        <i class="fa fa-thumbs-up"></i> Yes
                                                    </a>
                                                    <a class="btn btn-danger btn-helpful" href="#" data-id="{{ $faq->id }}" data-type="helpful_no">
                                                        <i class="fa fa-thumbs-down"></i> No
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
        <div class="content_right">
            <h2>About Scheduleze</h2> 
            <ul>
                <li><a href="#">Can I use Scheduleze on my website?</a></li>
                <li><a href="#">I don't have a website, what now?</a></li>
                <li><a href="#">How much does Scheduleze cost?</a></li>
                <li><a href="#">What's included with my sign up fee?</a></li>
                <li><a href="#">Is Scheduleze expandable?</a></li>
                <li><a href="#">Sign up for Scheduleze now »</a></li>         
            </ul> 
        </div> 
    </div>
</div>
@endsection