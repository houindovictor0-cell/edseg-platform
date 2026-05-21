@extends('layouts.dashboard')
@section('title', 'Chiffres clés')
@section('breadcrumb', 'Chiffres clés')

@section('content')

<div class="page-header">
    <div class="page-label">Données de l'école</div>
    <h1 class="page-title">Chiffres clés</h1>
    <p class="page-desc">Ces chiffres s'affichent sur la page d'accueil du site public.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.chiffres.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="stat-grid" style="margin-bottom: 24px;">
        @foreach($chiffres as $c)
        <div class="stat-card">
            <div class="stat-label">{{ $c->label }}</div>
            <input type="text" name="chiffres[{{ $c->id }}][valeur]"
                   value="{{ $c->valeur }}"
                   style="font-family:'EB Garamond', serif; font-size:40px; font-weight:400;
                          color:var(--text-primary); background:transparent; border:none;
                          border-bottom: 1px solid var(--border); width:100%; outline:none;
                          padding: 4px 0; margin-bottom:6px; transition: border-color 0.2s;"
                   onfocus="this.style.borderColor='var(--gold)'"
                   onblur="this.style.borderColor='var(--border)'">
            <div class="stat-desc">{{ $c->description }}</div>
        </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-gold">
        Enregistrer les modifications
    </button>
</form>

@endsection

