@extends('layouts.dashboard')
@section('title', 'Album photo')
@section('breadcrumb', 'Album photo')

@section('content')

<div class="page-header">
    <div class="page-label">Communication</div>
    <h1 class="page-title">Album photo</h1>
    <p class="page-desc">Gérez les photos affichées dans l'album de la page d'accueil.</p>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="grid-sidebar">

    {{-- Liste --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">{{ $photos->count() }} photo(s)</span>
        </div>
        <div class="card-body">
            @if($photos->isEmpty())
                <p style="color:var(--text-muted); text-align:center; padding:40px;">Aucune photo dans l'album.</p>
            @else
                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(160px, 1fr)); gap:16px;">
                    @foreach($photos as $photo)
                    <div style="border:1px solid var(--border); border-radius:10px; overflow:hidden;">
                        <img src="{{ $photo->image_url }}" alt="{{ $photo->legende }}"
                             style="width:100%; height:120px; object-fit:cover; display:block;">
                        <div style="padding:10px;">
                            <p style="font-size:11px; color:var(--text-secondary); min-height:16px; margin-bottom:8px;">
                                {{ $photo->legende ?: '—' }}
                            </p>
                            <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="width:100%; justify-content:center;"
                                        data-confirm="Supprimer cette photo ?">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Formulaire ajout --}}
    <div class="card">
        <div class="card-header"><span class="card-title">Ajouter une photo</span></div>
        <div class="card-body">
            <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" accept="image/*" class="form-input" required
                           style="padding:8px 14px; cursor:pointer;">
                </div>
                <div class="form-group">
                    <label class="form-label">Légende (optionnel)</label>
                    <input type="text" name="legende" class="form-input" placeholder="Ex: Séminaire doctoral 2026">
                </div>
                <div class="form-group">
                    <label class="form-label">Ordre d'affichage</label>
                    <input type="number" name="ordre" class="form-input" value="0" min="0">
                </div>
                <button type="submit" class="btn btn-gold">Ajouter la photo</button>
            </form>
        </div>
    </div>

</div>

@endsection
