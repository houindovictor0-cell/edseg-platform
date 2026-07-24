@extends('layouts.main')

@section('title','Ajouter une thèse')


@section('content')


<div class="page-header">

    <div class="page-label">
        Espace Enseignant
    </div>

    <h1 class="page-title">
        Nouvelle thèse
    </h1>

    <p class="page-desc">
        Ajouter une nouvelle thèse encadrée.
    </p>

</div>



<div class="card these-form-card">


    <div class="card-header">

        <span class="card-title">
            Informations de la thèse
        </span>

    </div>



    <div class="form-container">


        <form method="POST"
              action="{{ route('enseignant.theses.store') }}">

            @csrf



            {{-- Titre --}}

            <div class="form-group">

                <label>
                    Titre de la thèse
                </label>

                <textarea
                    name="titre"
                    class="form-input form-textarea"
                    style="min-height:80px;"
                    placeholder="Titre complet ou provisoire de la thèse..."
                    required>{{ old('titre') }}</textarea>


            </div>




            {{-- Doctorant --}}

            <div class="form-group">

                <label>
                    Doctorant
                </label>


                <select
                    name="doctorant_id"
                    class="form-input form-select"
                    required>


                    <option value="">
                        -- Sélectionner un doctorant --
                    </option>


                    @foreach($doctorants as $d)

                    <option value="{{ $d->id }}"
                        {{ old('doctorant_id') == $d->id ? 'selected' : '' }}>

                        {{ $d->prenom }} {{ $d->nom }}

                    </option>

                    @endforeach


                </select>


            </div>




            {{-- Directeur automatique --}}

            <div class="form-group">

                <label>
                    Directeur de thèse
                </label>


                <input
                    type="text"
                    class="form-input"
                    value="{{ $enseignant->prenom }} {{ $enseignant->nom }}"
                    disabled>


                {{-- Envoi automatique au contrôleur --}}
                <input type="hidden"
                       name="directeur_id"
                       value="{{ $enseignant->id }}">


            </div>




            {{-- Date début --}}

            <div class="form-group">

                <label>
                    Date de début
                </label>


                <input
                    type="date"
                    name="date_debut"
                    class="form-input"
                    value="{{ old('date_debut') }}"
                    required>


            </div>




            {{-- Mots clés --}}

            <div class="form-group">

                <label>
                    Mots-clés
                </label>


                <input
                    type="text"
                    name="mot_cles"
                    class="form-input"
                    value="{{ old('mot_cles') }}"
                    placeholder="Ex : intelligence artificielle, éducation">


            </div>




            {{-- Résumé --}}

            <div class="form-group">

                <label>
                    Résumé scientifique
                </label>


                <textarea
                    name="resume"
                    class="form-input form-textarea"
                    placeholder="Résumé du projet de thèse...">{{ old('resume') }}</textarea>


            </div>




            {{-- Statut --}}

            <div class="form-group">

                <label>
                    Statut
                </label>


                <select
                    name="statut"
                    class="form-input form-select"
                    required>


                    <option value="en_cours">
                        En cours
                    </option>


                    <option value="soutenue">
                        Soutenue
                    </option>


                    <option value="abandonnee">
                        Abandonnée
                    </option>


                </select>


            </div>




            {{-- Boutons --}}

            <div class="form-actions">


                <a href="{{ route('enseignant.theses') }}"
                   class="btn-secondary">
                    Annuler
                </a>



                <button type="submit"
                        class="btn-add-these">

                    Enregistrer la thèse

                </button>


            </div>



        </form>


    </div>


</div>


@endsection

