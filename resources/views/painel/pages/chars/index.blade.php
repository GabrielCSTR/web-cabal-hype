@extends('painel.layouts.master')

@section('header')
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Personagems - Account ( {{ mb_strtoupper(Auth::user()->ID) }} )</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Personagems
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
        <div class="media width-250 float-right">
            <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
            </media-left>
            <div class="media-body media-right text-right">
                <h3 class="m-0"> </h3>
                <span class="text-muted"></span>
            </div>
        </div>
    </div>
@endsection

@section('content')

<section id="social-cards">
    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h4 class="text-uppercase">Lista de Personagems</h4>
        <p>Lista de todos os seus personagems</p>
        <div class="animated bounceInRight alert bg-warning alert-icon-left mb-2" role="alert">
            <span class="alert-icon"><i class="ft-alert-octagon"></i></span>
            <strong>Importante!</strong>
            <p>Para fazer qualquer modificação em seu personagem você deve esta OFFLINE do JOGO!</p>
        </div>
      </div>
    </div>
    <div class="row mt-2">
        @if ($chars->count() > 0 )
        @foreach ($chars as $char)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card profile-card-with-cover">
                <div class="card-content">
                    <div class="card-img-top img-fluid bg-cover height-200" style="background: url('images/logo-footer.png') 0 80%;"></div>
                    <div class="card-profile-image">
                    <img src="images/avatar/avatar-{{ getClass($char->Style) }}.png" class="rounded-circle img-border box-shadow-1" alt="Card image">
                    </div>
                    <div class="profile-card-with-cover-content text-center">
                    <div class="profile-details mt-2">
                        @if ($char->Login)
                            <h4 class="card-title"><img src="images/online.png" height="20"></h4>
                        @else
                            <h4 class="card-title"><img src="images/offline.png" height="20"></h4>
                        @endif
                        <h4 class="card-title">{{ $char->Name }}</h4>
                        <ul class="list-inline clearfix mt-2">
                        <li class="mr-3">
                            <h2 class="block">{{ $char->LEV }}</h2> Level</li>
                        <li class="mr-3">
                            <h2 class="block">
                                {{-- {{ $char->Reputation > 10000 ? formatReputation(number_format($char->Reputation)) : $char->Reputation ?? 'N/A'  }} --}}
                                @php
                                if ($char->Reputation<=10000) { echo '(0)';}
                                if ($char->Reputation>=10000 and $char->Reputation<20000) { echo '(1 M)';}
                                if ($char->Reputation>=20000 and $char->Reputation<40000) { echo '(2 M)';}
                                if ($char->Reputation>=40000 and $char->Reputation<80000) { echo ' (3 M)';}
                                if ($char->Reputation>=80000 and $char->Reputation<160000) { echo ' (4 M)';}
                                if ($char->Reputation>=160000 and $char->Reputation<320000) { echo ' (5 M)';}
                                if ($char->Reputation>=320000 and $char->Reputation<640000) { echo ' (6 M)';}
                                if ($char->Reputation>=640000 and $char->Reputation<1280000) { echo ' (7 M)';}
                                if ($char->Reputation>=1280000 and $char->Reputation<2560000) { echo ' (8 M)';}
                                if ($char->Reputation>=2560000 and $char->Reputation<5120000) { echo ' (9 M)';}
                                if ($char->Reputation>=5120000 and $char->Reputation<10000000) { echo ' (10 M)';}
                                if ($char->Reputation>=10000000 and $char->Reputation<20000000) { echo ' (11 M)';}
                                if ($char->Reputation>=20000000 and $char->Reputation<50000000) { echo ' (12 M)';}
                                if ($char->Reputation>=50000000 and $char->Reputation<80000000) { echo ' (13 M)';}
                                if ($char->Reputation>=80000000 and $char->Reputation<150000000) { echo ' (14 M)';}
                                if ($char->Reputation>=150000000 and $char->Reputation<300000000) { echo ' (15 M)';}
                                if ($char->Reputation>=300000000 and $char->Reputation<500000000) { echo ' (16 M)';}
                                if ($char->Reputation>=500000000 and $char->Reputation<1000000000) { echo ' (17 M)';}
                                if ($char->Reputation>=1000000000 and $char->Reputation<1500000000) { echo ' (18 M)';}
                                if ($char->Reputation>=1500000000 and $char->Reputation<2000000000) { echo ' (19 M)';}
                                if ($char->Reputation>=2000000000) { echo ' (20 M)';}
                            @endphp
                            </h2> Reputação</li>
                        <li>
                            <h2 class="block">{{ getClassName($char->Style) }}</h2> Classe</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <span class="dropdown">
                            <button id="btnSearchDrop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-warning  btn-md dropdown-toggle dropdown-menu-right"><i class="ft ft-edit"></i> EDIT</button>
                            <span aria-labelledby="btnSearchDrop" class="dropdown-menu mt-1 dropdown-menu-center">
                            <button type="button" class="dropdown-item btn" data-toggle="modal" data-target="#editPoints-{{ $char->CharacterIdx }}">
                                <i class="ft-x"></i>Destribuir Pontos
                            </button>
                            <button type="button" class="dropdown-item btn" data-toggle="modal" data-target="#cleanPK-{{ $char->CharacterIdx }}">
                                <i class="ft ft-shield"></i>Limpar PK
                            </button>
                            </span>
                        </span>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            @include('painel.pages.chars.modals.modal')

        @endforeach
        @else
        <div class="col-md-12">
            <div class="alert bg-warning alert-icon-left mb-2" role="alert">
                <span class="alert-icon"><i class="ft-alert-octagon"></i></span>
                <strong>Mensagem!</strong>
                <p>Nenhum personagem criado no momento! <br>
                Entre no jogo e crie agora mesmo seu personagem!</p>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
      <div class="col-xl-4 col-md-12">
        <div class="card bg-twitter white">
          <div class="card-content p-2">
            <div class="card-body">
              <div class="text-center mb-1">
                <i class="la la-twitter font-large-3"></i>
              </div>
              <div class="tweet-slider carousel slide text-center" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item">
                    <p>Mantenha suas informações sempre atualizadas
                      <span class="yellow">#CABAL</span> HYPE!</p>
                  </div>
                  <div class="carousel-item active">
                    <p>Sempre que for editar seu personagem faza com seu char OFFLINE
                      <span class="yellow">#CABAL</span> HYPE.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">
        <div class="card bg-facebook white">
          <div class="card-content p-2">
            <div class="card-body">
              <div class="text-center mb-1">
                <i class="la la-facebook font-large-3"></i>
              </div>
              <div class="fb-post-slider carousel slide text-center" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                    <p>Mantenha suas informações sempre atualizadas
                        <span class="yellow">#CABAL</span> HYPE!</p>
                    </div>
                    <div class="carousel-item active">
                    <p>Sempre que for editar seu personagem faza com seu char OFFLINE
                        <span class="yellow">#CABAL</span> HYPE.</p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">
        <div class="card bg-linkedin white">
          <div class="card-content p-2">
            <div class="card-body">
              <div class="text-center mb-1">
                <i class="la la-linkedin font-large-3"></i>
              </div>
              <div class="linkedin-post-slider carousel slide text-center" data-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item">
                    <p>Mantenha suas informações sempre atualizadas
                        <span class="yellow">#CABAL</span> HYPE!</p>
                    </div>
                    <div class="carousel-item active">
                    <p>Sempre que for editar seu personagem faza com seu char OFFLINE
                        <span class="yellow">#CABAL</span> HYPE.</p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

