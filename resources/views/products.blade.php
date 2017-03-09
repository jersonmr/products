@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Top 10 expensive products</h1>
            </div>
            @foreach ($expensiveData as $data)
            
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
                        {!! Form::open(['route' => 'add-item']) !!}  
                            {!! Form::hidden("image", $data[0]) !!}
                            {!! Form::hidden("title", $data[1]) !!}
                            {!! Form::hidden("price", $data[3]) !!}
                        
                            <button class="btn btn-primary" type="submit"><i class="fa fa-shopping-cart"></i> Add </button>
                        {!! Form::close() !!}
                        
                    @endif
                    
                </div>                      

                <div class="col-xs-1 col-sm-1">
                    
                </div>
                
            </div>
            
            @if($loop->remaining)
                <hr>
            @endif

            @endforeach
            
            {{-- Cheapest Products --}}
            <div class="page-header">
                <h1>Top 10 cheapest products</h1>
            </div>

            @foreach ($cheapestData as $data)
            
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
                        {!! Form::open(['route' => 'add-item']) !!}  
                            {!! Form::hidden("image", $data[0]) !!}
                            {!! Form::hidden("title", $data[1]) !!}
                            {!! Form::hidden("price", $data[3]) !!}
                        
                            <button class="btn btn-primary" type="submit"><i class="fa fa-shopping-cart"></i> Add </button>
                        {!! Form::close() !!}
                        
                    @endif
                    
                </div>                       
                
            </div>
            
            @if($loop->remaining)
                <hr>
            @endif

            @endforeach

        </div>
    </div>
</div>

@endsection