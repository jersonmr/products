@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1 style="margin: 0; padding: 0;" class="pull-left">My WishList</h1>
                <div class="pull-right">
                    <a href="{{ url('/') }}" class="btn btn-default btn-lg">Continue Shopping</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="items">
                @if (Session::has('message'))
                    <div class="alert alert-success text-center">
                        <i class="fa fa-info-circle fa-2x"></i> <strong>{{ strtoupper(Session::get('message')) }}</strong>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2">ITEMS</th>
                            <th>PRICE</th> 
                            <th>&nbsp;</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wish_list as $wl)
                                        
                        <tr>
                            <td>
                               <img src="{{ $wl->image }}" alt="{{ $wl->title }}" style="width: 150px;">
                            </td>
                            <td>
                                <h4 class="media-heading" style="color: black; ">{{ $wl->title }}</h4>
                            </td>
                            <td>
                                <h4 style="margin: 0; padding: 0;">{{ $wl->price }}</h4>
                            </td>
                            <td><a href="{{ route('delete-item', $wl->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a></td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

@endsection