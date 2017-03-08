@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Top 10 expensive products</h1>
            </div>
            @foreach ($dataCollection as $data)
            
            <div class="row">                               
                                      
                <div class="col-xs-3 col-sm-3">
                    <img src="{{ $data[0] }}" alt="">
                </div>

                <div class="col-xs-7 col-sm-7">
                    <h4>{{ $data[1] }}</h4>
                    <ul>{{ $data[2] }}</ul>
                </div>

                <div class="col-xs-2 col-sm-2">
                    <h2 style="margin: 0; margin-bottom: 10px; padding: 0;">{{ $data[3] }}</h2>
                    
                    @if(Auth::check())
                        <a href="{{ url('wish-list', $data[4]) }}" class="btn btn-primary">
                            <i class="fa fa-shopping-cart"></i> Add 
                        </a>
                    @endif
                    
                </div>                      

                <div class="col-xs-1 col-sm-1">
                    
                </div>
                
            </div>
            
            @if($loop->remaining)
                <hr>
            @endif

            @endforeach

            <div class="page-header">
                <h1>Top 10 cheapest products</h1>
            </div>

        </div>
    </div>
</div>

@endsection