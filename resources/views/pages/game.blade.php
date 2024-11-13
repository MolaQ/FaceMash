@extends('app')

@section('title', 'Game | FaceMash v1.0')

@section('content')

    <div class="home">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-50">
                    <ul class="list-inline pull-right">
                        <li class="active"><a href="{{ url('game') }}" class="btn btn-sm btn-green">Play Game</a></li>
                        <li><a href="{{ url('stats') }}" class="btn btn-sm btn-orange">View Statistics</a></li>
                        <li><a href="{{ url('share') }}" class="btn btn-sm btn-cyan">Share</a></li>
                    </ul>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if (count($images) >= 2)
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" action="{{ route('game.update', $images->last()->id) }}"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">

                                    <input type="hidden" class="form-control" name="winner"
                                        id="{{ $images->first()->id }}" value="{{ $images->first()->id }}"></input>
                                    <input type="hidden" class="form-control" name="loser" id="{{ $images->last()->id }}"
                                        value="{{ $images->last()->id }}"></input>
                                </div>

                                <div id="left" class="animated bounceInLeft">
                                    <a href="#" class="pickoption">
                                        <div class="view view-first">
                                            <img src="{{ asset('img/models/' . $images->first()->filename) }}"
                                                width="600" class="img-responsive" alt="{{ $images->first()->name }}">
                                            <div class="mask">
                                                <h2>Rank: {{ $images->first()->rank }}</h2>
                                                <p class="lead">Her bio is here.</p>
                                                <table class="table bg-inherit text-center">
                                                    <thead>
                                                        <tr>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="font120">Won:
                                                                    {{ $images->first()->wins }}</span>
                                                            </td>
                                                            <td><span class="font120">Lost:
                                                                    {{ $images->first()->losses }}</span>
                                                            </td>
                                                            <td><span class="font120">Score:
                                                                    {{ $images->first()->score }}</span>
                                                            </td>
                                                            <td><span class="font120">Rank:
                                                                    {{ $images->first()->rank }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" action="{{ route('game.update', $images->last()->id) }}"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">

                                    <input type="hidden" class="form-control" name="winner"
                                        id="{{ $images->last()->id }}" value="{{ $images->last()->id }}"></input>
                                    <input type="hidden" class="form-control" name="loser"
                                        id="{{ $images->first()->id }}" value="{{ $images->first()->id }}"></input>
                                </div>

                                <div id="right" class="animated bounceInRight">
                                    <a href="#" class="pickoption">
                                        <div class="view view-first">
                                            <img src="{{ asset('img/models/' . $images->last()->filename) }}"
                                                width="600" class="img-responsive" alt="{{ $images->last()->name }}">
                                            <div class="mask">
                                                <h2>Rank: {{ $images->last()->rank }}</h2>
                                                <p class="lead">Her bio is here.</p>
                                                <table class="table bg-inherit text-center">
                                                    <thead>
                                                        <tr>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="font120">Won:
                                                                    {{ $images->last()->wins }}</span>
                                                            </td>
                                                            <td><span class="font120">Lost:
                                                                    {{ $images->last()->losses }}</span>
                                                            </td>
                                                            <td><span class="font120">Score:
                                                                    {{ $images->last()->score }}</span>
                                                            </td>
                                                            <td><span class="font120">Rank:
                                                                    {{ $images->last()->rank }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
                <ul class="list-inline">
                    @foreach ($top6 as $image)
                        <li class="col-lg-2">
                            <p><strong>Rank: {{ $image->rank }}</strong></p>
                            <img src="{{ asset('img/models/' . $image->filename) }}" alt="{{ $image->name }}"
                                class="img-responsive">
                            <ul class="list-inline list-unstyled margin-top-10">

                                <li><strong>Won: <span class="text-success">{{ $image->wins }}</span> </strong></li>
                                <li><strong>Lose: <span class="text-danger">{{ $image->losses }}</span> </strong></li>
                                <li><strong>Score: <span class="text-info">{{ $image->score }}</span> </strong></li>

                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@stop
