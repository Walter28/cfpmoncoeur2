<div>
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">À propos de nous</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Accueil</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">À propos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Pourquoi Nous Choisir</h6>
                <h1 class="mb-5">Nos Avantages</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Formateurs Experts</h5>
                            <p>Des professionnels expérimentés avec une expertise pratique dans leurs domaines.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-laptop-code text-primary mb-4"></i>
                            <h5 class="mb-3">Formation Pratique</h5>
                            <p>Apprentissage par la pratique avec des projets concrets et réalistes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-certificate text-primary mb-4"></i>
                            <h5 class="mb-3">Certification Reconnue</h5>
                            <p>Certificats valorisés sur le marché de l'emploi local et international.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-handshake text-primary mb-4"></i>
                            <h5 class="mb-3">Suivi Personnalisé</h5>
                            <p>Accompagnement individuel pour maximiser vos chances de réussite.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100 rounded" 
                            src="{{ asset('assets_frontend/img/about.jpg') }}"  
                            alt="À propos de CFP MON CŒUR" 
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Notre Histoire</h6>
                    <h1 class="mb-4">Bienvenue à CFP MON CŒUR</h1>
                    <p class="mb-4">Fondé avec la passion de transformer des vies par l'éducation, CFP MON CŒUR est un centre de formation professionnelle d'excellence en République Démocratique du Congo. Notre mission est de préparer la nouvelle génération aux défis du marché du travail moderne.</p>
                    
                    <p class="mb-4">Nous combinons théorie et pratique pour offrir une expérience d'apprentissage complète qui donne à nos étudiants les compétences nécessaires pour réussir dans leurs carrières.</p>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Pédagogie innovante</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Équipements modernes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Partenariats professionnels</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Insertion professionnelle</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Communauté active</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Environnement inclusif</p>
                        </div>
                    </div>
                    
                    <a href="/contact" class="btn btn-primary py-3 px-5 mt-2">Nous Contacter</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Stats Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-users text-primary mb-4"></i>
                            <h1 class="mb-2" data-toggle="counter-up">{{ $stats['etudiants'] }}+</h1>
                            <h5 class="mb-0">Étudiants Formés</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-chalkboard-teacher text-primary mb-4"></i>
                            <h1 class="mb-2" data-toggle="counter-up">{{ $stats['formateurs'] }}+</h1>
                            <h5 class="mb-0">Formateurs Experts</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h1 class="mb-2" data-toggle="counter-up">{{ $stats['formations'] }}+</h1>
                            <h5 class="mb-0">Programmes de Formation</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-award text-primary mb-4"></i>
                            <h1 class="mb-2" data-toggle="counter-up">{{ $stats['taux_reussite'] }}%</h1>
                            <h5 class="mb-0">Taux de Réussite</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Notre Équipe</h6>
                <h1 class="mb-5">Nos Formateurs Experts</h1>
            </div>
            
            @if($formateurs->count() > 0)
                <div class="row g-4">
                    @foreach($formateurs as $formateur)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                            <div class="team-item bg-light rounded overflow-hidden">
                                <div class="position-relative overflow-hidden" style="height: 250px;">
                                    @if($formateur->photo && file_exists(public_path('storage/' . $formateur->photo)))
                                        <img class="img-fluid w-100 h-100" 
                                             src="{{ asset('storage/' . $formateur->photo) }}" 
                                             alt="{{ $formateur->prenom }} {{ $formateur->nom }}"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="bg-primary d-flex align-items-center justify-content-center h-100 w-100">
                                            <span class="text-white fw-bold display-5">
                                                {{ substr($formateur->prenom, 0, 1) }}{{ substr($formateur->nom, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <div class="team-social">
                                        @if($formateur->email)
                                            <a class="btn btn-square btn-primary mx-1" href="mailto:{{ $formateur->email }}" title="Envoyer un email">
                                                <i class="fab fa-envelope"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="text-center p-4">
                                    <h5 class="mb-0">{{ $formateur->prenom }} {{ $formateur->nom }}</h5>
                                    <small class="text-primary">{{ $formateur->domaine ?? 'Formateur' }}</small>
                                    
                                    @if($formateur->email)
                                        <p class="mt-2 mb-0 small text-muted">
                                            <i class="fas fa-envelope me-1"></i> {{ \Illuminate\Support\Str::limit($formateur->email, 25) }}
                                        </p>
                                    @endif
                                    
                                    @if($formateur->contact)
                                        <p class="mt-1 mb-0 small text-muted">
                                            <i class="fas fa-phone me-1"></i> {{ $formateur->contact }}
                                        </p>
                                    @endif
                                    
                                    <div class="mt-3">
                                        @if($formateur->domaine)
                                            <span class="badge bg-success rounded-pill">{{ $formateur->domaine }}</span>
                                        @endif
                                        @if($formateur->sexe)
                                            <span class="badge bg-info rounded-pill ms-1">{{ ucfirst($formateur->sexe) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="alert alert-info">
                        <i class="fas fa-user-tie fa-3x mb-3"></i>
                        <h4>Nos formateurs arrivent bientôt</h4>
                        <p>Nous recrutons actuellement les meilleurs experts pour vous accompagner.</p>
                    </div>
                </div>
            @endif
            
            @if($formateurs->count() > 0)
                <div class="text-center mt-5">
                    <a href="{{ route('acceuil') }}#formateurs" class="btn btn-primary py-3 px-5">
                        <i class="fas fa-users me-2"></i> Voir Tous les Formateurs
                    </a>
                </div>
            @endif
        </div>
    </div>
    <!-- Team End -->

    <!-- Mission & Vision Start -->
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-light text-center text-primary px-3">Notre Engagement</h6>
                <h1 class="mb-5">Mission & Vision</h1>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <i class="fa fa-3x fa-bullseye text-primary mb-3"></i>
                                <h3 class="card-title">Notre Mission</h3>
                            </div>
                            <p class="card-text">
                                Fournir une éducation professionnelle de qualité qui équipe les apprenants avec les compétences pratiques, 
                                les connaissances théoriques et l'état d'esprit nécessaires pour exceller dans leurs carrières et contribuer 
                                positivement au développement socio-économique de notre pays.
                            </p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Former des professionnels compétents</li>
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Promouvoir l'innovation et la créativité</li>
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Faciliter l'insertion professionnelle</li>
                                <li><i class="fa fa-check text-primary me-2"></i>Encourager l'esprit entrepreneurial</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <i class="fa fa-3x fa-eye text-primary mb-3"></i>
                                <h3 class="card-title">Notre Vision</h3>
                            </div>
                            <p class="card-text">
                                Devenir le centre de formation professionnelle de référence en RDC, reconnu pour l'excellence de ses programmes, 
                                la qualité de son enseignement et l'impact positif de ses diplômés sur le marché du travail et dans la société.
                            </p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Excellence académique reconnue</li>
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Innovation pédagogique constante</li>
                                <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Partenariats stratégiques nationaux et internationaux</li>
                                <li><i class="fa fa-check text-primary me-2"></i>Leadership dans la formation professionnelle</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mission & Vision End -->

    <!-- CTA Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-primary rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-primary d-flex flex-column justify-content-center p-5 h-100">
                            <h1 class="text-white mb-4">Prêt à Transformer Votre Avenir ?</h1>
                            <p class="text-white mb-0">
                                Rejoignez notre communauté d'apprenants motivés et commencez votre parcours vers le succès professionnel.
                                Nos conseillers pédagogiques sont disponibles pour vous guider dans le choix de la formation qui correspond à vos ambitions.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-white p-5 h-100 d-flex flex-column justify-content-center">
                            <h3 class="mb-4">Commençons Ensemble</h3>
                            <div class="d-flex flex-column gap-3">
                                <a href="{{ route('nos-formations') }}" class="btn btn-primary py-3">
                                    <i class="fas fa-book me-2"></i> Découvrir Nos Formations
                                </a>
                                <a href="/contact" class="btn btn-outline-primary py-3">
                                    <i class="fas fa-comments me-2"></i> Demander des Renseignements
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-primary py-3">
                                    <i class="fas fa-user-plus me-2"></i> S'inscrire Maintenant
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA End -->
</div>