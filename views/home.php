{{ include('layouts/header.php', {title:'Accueil'})}}

    <!--https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_slideshow-->
    <section class="carousel-main-section">
        <div class="carousel-container">
            <div class="mySlides fade">
                <img src="{{ asset }}img/carousel/stamp_2.jpg" style="width:100%">

                <div class="info-product-promoted">
                    <div class="promoted-product__title">
                        <h1>Timbre ancien</h1>
                    </div>
                    <div class="promoted-product__description">
                        <p>Timbre ancien! Offre exclusive!</p>
                    </div>
                </div>

                <div class="promotion-card">
                    <div class="promotion-card__title">
                        <h1>Timbre ancien</h1>
                    </div>
                    <div class="timer">
                        <div>
                            <div class="time">
                                <span>Jours:</span>
                            </div>
                            <div class="result">
                                <span class="days">02</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                                <span>Heures:</span>
                            </div>
                            <div class="result">
                                <span class="hours">10</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                                <span>Minutes:</span>
                            </div>
                            <div class="result">
                                <span class="minutes">02</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                                <span>Secondes:</span>
                            </div>
                            <div class="result">
                                <span class="seconds">32</span>
                            </div>
                        </div>
                    </div>
                    <div class="bid-now-wrapper">
                        <a href="{{base}}/stamp/details?id=1" class="bid-now">Placer une Mise</a>
                    </div>
                </div>
            </div>
        
            <div class="mySlides fade">
              <img src="{{ asset }}img/timbres/produits/small-img_2.jpg" style="width:100%">

              <div class="info-product-promoted">
                <div class="promoted-product__title">
                    <h1>Timbre antique</h1>
                </div>
                <div class="promoted-product__description">
                    <p>Timbre antique! Offre exclusive!</p>
                </div>
            </div>

            <div class="promotion-card">
                <div class="promotion-card__title">
                    <h1>Timbre antique</h1>
                </div>
                <div class="timer">
                    <div>
                        <div class="time">
                            <span>Jours:</span>
                        </div>
                        <div class="result">
                            <span class="days">02</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Heures:</span>
                        </div>
                        <div class="result">
                            <span class="hours">10</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Minutes:</span>
                        </div>
                        <div class="result">
                            <span class="minutes">02</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Secondes:</span>
                        </div>
                        <div class="result">
                            <span class="seconds">32</span>
                        </div>
                    </div>
                </div>
                <div class="bid-now-wrapper">
                    <a href="{{base}}/stamp/details?id=2" class="bid-now">Placer une Mise</a>
                </div>
            </div>
            </div>
        
            <div class="mySlides fade">
              <img src="{{ asset }}img/carousel/stamp_3.jpg" style="width:100%">

              <div class="info-product-promoted">
                <div class="promoted-product__title">
                    <h1>Timbre rare</h1>
                </div>
                <div class="promoted-product__description">
                    <p>Timbre rare! Offre exclusive!</p>
                </div>
            </div>

            <div class="promotion-card">
                <div class="promotion-card__title">
                    <h1>Timbre rare</h1>
                </div>
                <div class="timer">
                    <div>
                        <div class="time">
                            <span>Jours:</span>
                        </div>
                        <div class="result">
                            <span class="days">02</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Heures:</span>
                        </div>
                        <div class="result">
                            <span class="hours">10</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Minutes:</span>
                        </div>
                        <div class="result">
                            <span class="minutes">02</span>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <span>Secondes:</span>
                        </div>
                        <div class="result">
                            <span class="seconds">32</span>
                        </div>
                    </div>
                </div>
                <div class="bid-now-wrapper">
                    <a href="{{base}}/stamp/details?id=3" class="bid-now">Placer une Mise</a>
                </div>
            </div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
        
        </div>
        <br>
        
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </section>


    <section class="live-bidding">
                <div class="structure">
                    <div class="section-title">
                        <h3 class="live-bidding__title">Enchères en direct</h3>
                        <div class="line"></div>
                    </div>
                    
                    
                    <!-----Cards------>
                    <section class="slider-product slider-live">
                        <div class="wrapper">
                            <i id="left" class="fa-solid fas fa-angle-left"></i>
                            <div class="carousel">
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/small-img_1.jpg" alt="news_1" draggable="false">
                                    </div>
                                    <h2>
                                        Timbre Ancien
                                    </h2>
                                    <span>CANADA -1864</span>
                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>
                                    
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/small-img_2.jpg" alt="news_2" draggable="false">
                                    </div>
                                    <h2>
                                        Timbre Ancien
                                    </h2>
                                    <span>CANADA -1864</span>
                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/small-img_3.png" alt="news_3" draggable="false">
                                    </div>

                                    <h2>Timbre Antique</h2>
                                    <span>CANADA-1851</span>
                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/big-img.jpg" alt="news_4" draggable="false">
                                    </div>
                                   <h2>Timbre anglais</h2>
                                    <span>CANADA-1857</span>

                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/stamp_4.jpg" alt="stamp_4" draggable="false">
                                    </div>
                                    <h2>Timbre anglais</h2>
                                    <span>CANADA-1857</span>
                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>
                                <div class="card-product">
                                    <div class="news__img product_card--img">
                                        <img src="{{ asset }}img/timbres/produits/stamp_5.jpg" alt="stamp-1864" draggable="false">
                                    </div>
                                    <h2>Timbre limité</h2>
                                    <span>CANADA-1864</span>
                                    <div class="news__description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                                    </div>
                                    <a class="btn add_to_cart_btn card-slider-btn" href="{{ base }}/catalog">Voir Plus</a>
                                </div>

                                
                            </div>
                            <i id="right" class="fa-solid fas fa-angle-right"></i>
                        </div>
                    </section>
                </div>


                    
    </section>

    <section class="how-it-works">
        <div class="structure">

            <header class="header__title--with_line">
                <h2>Comment ça marche?</h2>
                <div class="line"></div>
            </header>
            <div class="how-it-works__container min-height70">
                <div class="how-it-works__block">
                    <div class="block__icon">
                        <img src="{{ asset }}img/icons/how-it-works/registration.png" alt="registration-icon">
                    </div>
                    <div class="block__title">
                        <h2>
                            Inscription et compte
                        </h2>
                    </div>
                    <div class="block__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis ullam deserunt et atque qui quod quo maxime ipsa incidunt enim!
                    </div>
                </div>
                <div class="arrow-blocks">
                    <img src="{{ asset }}img/icons/how-it-works/arrow.svg" alt="arrow-blocks">
                </div>
                <div class="how-it-works__block">
                    <div class="block__icon">
                        <img src="{{ asset }}img/icons/how-it-works/browse.png" alt="registration-icon">
                    </div>
                    <div class="block__title">
                        <h2>
                            Sélectionner un timbre
                        </h2>
                    </div>
                    <div class="block__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis ullam deserunt et atque qui quod quo maxime ipsa incidunt enim!
                    </div>
                </div>
                <div class="arrow-blocks">
                    <img src="{{ asset }}img/icons/how-it-works/arrow.svg" alt="arrow-blocks">
                </div>
                <div class="how-it-works__block">
                    <div class="block__icon">
                        <img src="{{ asset }}img/icons/how-it-works/bidding.png" alt="registration-icon">
                    </div>
                    <div class="block__title">
                        <h2>
                            Placer des offres et surveiller
                        </h2>
                    </div>
                    <div class="block__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis ullam deserunt et atque qui quod quo maxime ipsa incidunt enim!
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section__why-us">
        <div class="structure">
            <header class="header__title--with_line">
                <h2>Pourquoi nous?</h2>
                <div class="line"></div>
            </header>
            <div class="container__why-us min-height40">
                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>2K</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Membres inscrits</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>15000+</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Inventaire vendu</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>100%</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Garantie</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>90%</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Clients satisfaits</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section__news">
        <div class="structure">

            <header class="header__title--with_line">
                <h2>Les dernières nouvelles</h2>
                <div class="line"></div>
              </header>

            <div class="card__news--container">
                <div class="card__news">
                    <div class="news__img">
                        <img src="{{ asset }}img/timbres/produits/small-img_1.jpg" alt="news_1">
                    </div>
                    <div class="news__title">
                        <h1>Nouveau timbre rare en stock</h1>
                    </div>
                    <div class="news__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                    </div>
                    <div class="news__read--more">
                        <a href="{{ base }}/page/actual" class="bid-now news-btn">En savoir plus <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                    </div>
                </div>
                <div class="card__news">
                    <div class="news__img">
                        <img src="{{ asset }}img/timbres/produits/small-img_2.jpg" alt="news_2">
                    </div>
                    <div class="news__title">
                        <h1>Nouveau timbre ancien en stock</h1>
                    </div>
                    <div class="news__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                    </div>
                    <div class="news__read--more">
                        <a href="{{ base }}/page/actual" class="bid-now news-btn">En savoir plus <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                    </div>
                </div>

                <div class="card__news">
                    <div class="news__img">
                        <img src="{{ asset }}img/timbres/produits/small-img_3.png" alt="news_3">
                    </div>
                    <div class="news__title">
                        <h1>Nouveau timbre historique en stock</h1>
                    </div>
                    <div class="news__description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia perferendis ipsa nam numquam vero ex odio voluptate illum consequuntur in!
                    </div>
                    <div class="news__read--more">
                        <a href="{{ base }}/page/actual" class="bid-now news-btn">En savoir plus <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section__newsletter flex-center">
        <div class="structure">
            <div class="newsletter__img-box--container">
                <div class="newsletter__subtitle--title--box">
                    <div class="newsletter__subtitle">
                        <small>Soyez plus proche</small>
                    </div>
                    <div class="newsletter__title">
                        <h1>Recevez les actualités en vous abonnant à notre infolettre</h1>
                    </div>
                    <div class="newsletter__box">
                        <input type="text" class="newsletter__box--input" placeholder="Entrez votre email...">
                        <button class="btn btn-box newsletter-btn">Soumettre</button>
                    </div>
                </div>
                <div class="newsletter__img__box">
                    <img src="{{ asset }}img/news/news_1.svg" alt="">
                </div>
            </div>
        </div>
    </section>
    
    

    <section class="section__testimonials">
        <div class="structure">
            <header class="header__title--with_line">
              <h2>Nos clients ont été surpris</h2>
              <div class="line"></div>
            </header>
            <div class="testimonial-grid">
                <div class="testimonial">
                    <div class="nom-img-client">
                      <div>
                        <img src="{{ asset }}img/personages/image-saraah.jpg" alt="Sarah O’Maillet">
                      </div>
                      <div>
                        <h2 class="name">Sarah O’Maillet</h2>
                      </div>
                    </div>
                    <div class="desc-client">
                      <p>
                        Une Expérience d'Achat Parfaite
                      </p>
                      <p>
                        “ J'étais ravie de trouver le timbre parfait pour compléter ma collection sur ce site. Le processus d'achat était simple, et le service client était incroyablement utile. Le timbre est arrivé rapidement et en parfait état. Je ferai certainement d'autres achats ici ! ”
                      </p>
                    </div>
                  </div>
                  <div class="testimonial">
                    <div class="nom-img-client">
                      <div>
                        <img src="{{ asset }}img/personages/image-daniel.jpg" alt="daniel clifford">
                      </div>
                      <div>
                        <h2 class="name">Jonathan Walters</h2>
                        <!-- <p class="position">Verified Graduate</p> -->
                      </div>
                    </div>
                    <div class="desc-client">
                      <p>
                        Le Meilleur Site d'Enchères
                      </p>
                      <p>
                        “ « Je suis collectionneur de timbres depuis plus de 20 ans, et ce site d'enchères est de loin le meilleur que j'ai jamais utilisé. La plateforme est facile à naviguer, le processus d'enchères est fluide, et la variété de timbres disponibles est inégalée. Je recommande vivement ! ”
                      </p>
                    </div>
                  </div>
                  <div class="testimonial">
                    <div class="nom-img-client">
                      <div>
                        <img class="border-primary-400" src="{{ asset }}img/personages/image-patrick.jpg" alt="Patrick Abrams">
                      </div>
                      <div>
                        <h2 class="name">Patrick Abrams</h2>
                        <!-- <p class="position">Verified Graduate</p> -->
                      </div>
                    </div>
                    <div class="desc-client">
                      <p>
                        Une Première Enchère Réussie
                      </p>
                      <p>
                        “ En tant que premier acheteur, j'ai été impressionné par la facilité d'utilisation du système d'enchères. J'ai trouvé des offres incroyables sur des timbres que je cherchais depuis des années. Toute l'expérience a été passionnante et enrichissante ! ”
                      </p>
                    </div>
                  </div>
                  <div class="testimonial">
                    <div class="nom-img-client">
                      <div>
                        <img src="{{ asset }}img/personages/image-jeanette.jpg" alt="Jeanette Harmon">
                      </div>
                      <div>
                        <h2 class="name">Jeanette Harmon</h2>
                        <!-- <p class="position">Verified Graduate</p> -->
                      </div>
                    </div>
                    <div class="desc-client">
                      <p>
                        Un Trésor pour les Collectionneurs
                      </p>
                      <p>
                        “ Ce site d'enchères de timbres est un véritable trésor pour les collectionneurs. Les descriptions détaillées et les images de haute qualité facilitent la recherche de ce que vous cherchez. De plus, la communauté de collectionneurs ici est fantastique. C'est mon site de référence pour agrandir ma collection. ”
                      </p>
                    </div>
                  </div>
            
                  <div class="testimonial">
                    <div class="nom-img-client">
                      <div>
                        <img src="{{ asset }}img/personages/image-kira.jpg" alt="Kira Whittle">
            
                      </div>
                      <div>
                        <h2 class="name">Kira Whittle</h2>
                        <!-- <p class="position">Verified Graduate</p> -->
                      </div>
                    </div>
                    <div class="desc-client">
                      <p>
                        Transparence et Excitation
                      </p>
                      <p>
                        “ J'ai essayé d'autres sites d'enchères de timbres, mais aucun ne se compare à celui-ci. La transparence et l'équité du processus d'enchères me donnent confiance que j'obtiens la meilleure valeur. Le site est bien conçu, et les enchères sont toujours excitantes. Cinq étoiles ! ”
                      </p>
                    </div>
                  </div>
            </div>
            <div class="btn-centre">
              <a href="{{ base }}/page/about" class="btn-testimonial btn-box btn-no-bg">Voir toutes les critiques</a>
            </div>
        </div>
    </section>






    <!---Footer-->
    {{ include('layouts/footer.php')}}
