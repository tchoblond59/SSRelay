@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>SSRelay configuration</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Historique des dernières actions</h3>
                <ul>
                    @foreach($messages as $message)
                        <li>
                            {{$message->created_at}}
                            @if($message->value)
                                Relay On
                            @else
                                Relay Off
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <div class="card bg-secondary text-white">
                    <div class="card-header">
                        <h5>{{$widget->name}} <span class="label label-info">{{ucfirst($ssrelay_config->type)}}</span>
                            @can('update sensor')
                                <a class="pull-right" href="{{url('/SSRelay/update/'.$widget->id)}}"><i
                                            class="fa fa-cogs"></i></a>
                            @endcan
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5><strong>Plugin:</strong> {{$widget->sensor->classname}}</h5>
                        <h5><strong>Capteur:</strong> {{$widget->sensor->name}}</h5>
                        <h5><strong>Adresse du noeud:</strong> {{$widget->sensor->node_address}}</h5>
                        <h5><strong>Adresse secondaire:</strong> {{$widget->sensor->sensor_address}}</h5>
                        @if($ssrelay_config->type=='temporisé')
                            <h5><strong>Délai tempo:</strong> {{$ssrelay_config->delay}} ms</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="post"
                              action="{{url('/SSRelay/action/create/'.$widget->id)}}">
                            <fieldset>
                            {{csrf_field()}}
                            <!-- Form Name -->
                                <legend>Créer une action</legend>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @endif
                            <!-- Text input-->
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="name">Nom</label>
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="Ma commande"
                                               class="form-control input-md" required="">
                                        <span class="help-block">Le nom sous lequel votre commande va apparaitre</span>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="command">Commande</label>
                                    <div class="col-md-4">
                                        <select id="command" name="command" class="form-control">
                                            <option value="1">Activer Relais</option>
                                            <option value="0">Désactiver Relais</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <button class="btn btn-secondary float-right">Ajouter</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection