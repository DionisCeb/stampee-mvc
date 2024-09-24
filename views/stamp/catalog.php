{{ include('layouts/header.php', {title:'Enchères'})}}


    <section class="catalog flex-center">
        <div class="catalog-wrapper">
            <section class="catalog__filter--section">
                <div class="filter-box">
                    <div class="filter__option--box">
                        <label class="filter__title--value" for="filter">Trier Par <span class="arrow-value-box">↑</span></label>
                        <div class="value-box">
                            <select name="filter" id="" class="filter--box__select">
                                <option value="default">default</option>
                                <option value="price-h">recents</option>
                                <option value="price-h">prix croissant</option>
                                <option value="price-l">prix décroissant</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter__option--box">
                            <label class="filter__title--value" for="category">Catégories <span class="arrow-value-box">↑</span></label>
                        <div class="value-box">
                            <div>
                                <label for="antiquity">Antiquité (45)</label>
                                <input type="checkbox" name="antic" id="antic">
                            </div>
                            <div>
                                <label for="Modern">Moderne (50)</label>
                                <input type="checkbox" name="modern" id="Modern">
                            </div>
                            <div>
                                <label for="Contemporary">Contemporain (80)</label>
                                <input type="checkbox" name="contemporary">
                            </div>
                        </div>
                    </div>

                    <div class="filter__option--box">
                            <label class="filter__title--value" for="category">Pays d'origine <span class="arrow-value-box">↑</span></label>
                        <div class="value-box">
                            <div>
                                <label for="uk">Royaume-Uni <span>(723)</span></label>
                                <input type="checkbox" name="uk" id="uk">
                            </div>
                            <div>
                                <label for="ca">Canada <span>(409)</span></label>
                                <input type="checkbox" name="ca" id="ca">
                            </div>
                            <div>
                                <label for="usa">États-Unis <span>(250)</span></label>
                                <input type="checkbox" name="usa" id="usa">
                            </div>
                            <div>
                                <label for="aus">Australie <span>(250)</span></label>
                                <input type="checkbox" name="aus" id="aus">
                            </div>
                        </div>
                    </div>

                    <div class="filter__option--box">
                        <label class="filter__title--value" for="category">Type <span class="arrow-value-box">↓</span></label>
                    </div>

                    <div class="filter__option--box rangePrice">
                        <h3 class="filter__title--value">Prix <span class="arrow-value-box">↑</span></h3>
                        <div class="value-box">
                            <small>Montant maximum : <span class="filter-box__price-range-value"></span> $</small>
                            <input type="range" name="price" id="price" min="0" max="1000" value="300" step="100">
                        </div>
                    </div>
                    <button class="bid-now" href="">Chercher</button>
                </div>
            </section>

            <section class="catalog__auctions--section">
                <div class="grid-container">
                    <!-- <div class="card__news card_catalog" style="animation-delay: 0.3s;">
                        <div class="news__img">
                            <img src="{{ asset }}img/timbres/produits/small-img_4.jpg" alt="Découverte d'un Timbre Rare">
                        </div>
                        <div class="news__title">
                            <h1>Découverte d'un Timbre Rare</h1>
                        </div>
                        <div class="news__description">
                            Nous avons le plaisir de vous présenter un timbre rare, récemment découvert. Ce timbre est un ajout précieux pour tout collectionneur passionné, avec des détails exquis et une histoire fascinante.
                        </div>
                        <div class="timer catalog-timer">
                        <div>
                            <div class="time">
                            <span>Jours:</span>
                            </div>
                            <div class="result">
                            <span class="days">28</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                            <span>Heures:</span>
                            </div>
                            <div class="result">
                            <span class="hours">23</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                            <span>Minutes:</span>
                            </div>
                            <div class="result">
                            <span class="minutes">59</span>
                            </div>
                        </div>
                        <div>
                            <div class="time">
                            <span>Secondes:</span>
                            </div>
                            <div class="result">
                            <span class="seconds">42</span>
                            </div>
                        </div>
                        </div>
                        <div class="news__read--more">
                            <a href="{{ base }}/stamp/index" class="bid-now news-btn">Placer une mise <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                        </div>
                    </div> -->
                    {% for stamp in stamps %}
                        <div class="card__news card_catalog" style="animation-delay: 0.3s;">
                            <div class="news__img">
                                {% if stamp.images is not empty %}
                                    <img src="{{ stamp.images[0].image_path }}" alt="{{ stamp.name }}">
                                {% else %}
                                    <img src="{{ asset ~ 'img/timbres/produits/default-image.jpg' }}" alt="{{ stamp.name }}">
                                {% endif %}
                            </div>
                            <div class="news__title">
                                <h1>{{ stamp.name }}</h1>
                            </div>
                            <div class="news__details">
                                <p>Date de création: {{ stamp.creation_date }}</p>
                                <p>Couleur(s): {{ stamp.color }}</p>
                                <p>Pays d’origine: {{ stamp.country }}</p>
                                <p>Condition: {{ stamp.stamp_condition }}</p>
                                <p>Tirage: {{ stamp.print_run }}</p>
                                <p>Dimensions: {{ stamp.dimensions }}</p>
                                <p>Certifié: {{ stamp.certified == 'Oui' ? 'Oui' : 'Non' }}</p>
                                <p>Auteur: {{ stamp.user_name }}</p>
                            </div>
                            <div class="timer" style="justify-content: center;">
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
                            <div class="news__read--more">
                                <a href="{{ base }}/stamp/details?id={{ stamp.id }}" class="bid-now news-btn">Placer une mise <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                            </div>
                        </div>
                    {% endfor %}
                    
                </div>

                <!-----Pagination----->
                <div class="catalog-pagination">
                    <div class="arrow-pagination"><i class="fa-solid fa-arrow-left"></i></div>
                    <div class="pagination-box">
                        <div class="pagination-box-item">
                            1
                        </div>
                        <div class="pagination-box-item">
                            2
                        </div>
                        <div class="pagination-box-item">
                            3
                        </div>
                        <div class="pagination-box-item">
                            4
                        </div>
                        <div class="pagination-box-item">
                            5
                        </div>
                        <div class="pagination-box-item">
                            6
                        </div>
                    </div>
                    <div class="arrow-pagination"><i class="fa-solid fa-arrow-right"></i></div>
                    
                </div>
            </section>


            
            
            
            
            
            
        </div>
    </section>

     <!---Footer-->
     {{ include('layouts/footer.php')}}