{{ include('layouts/header.php', {title:'My Collection'})}}


<h1>Your Stamp Collection</h1>
<div class="collection-links">
    <a href="{{ base }}/user/edit" class="bid-now news-btn">Retour à votre profil
        <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/back.png" alt="arrow-back"></i>
    </a>
</div>
    

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
                    <button class="bid-now" href="">Chercher</button>
                </div>
            </section>

            <section class="catalog__auctions--section">
                <div class="grid-container">
                {% if stamps is empty %}
                    <p>You have not created any stamps yet.</p>
                    {% else %}
                        {% for stamp in stamps %}
                            <div class="card__news card_catalog" style="animation-delay: 0.3s;">
                                <div class="news__img">
                                {% if stamp.images is not empty %}
                                    <img src="{{ base ~ '/' ~ stamp.images[0].image_path }}" alt="{{ stamp.name }}">
                                {% else %}
                                    <img src="{{ asset ~ 'img/timbres/produits/default-image.jpg' }}" alt="{{ stamp.name }}">
                                {% endif %}
                                </div>
                                <div class="news__title">
                                    <h1>{{ stamp.name }}</h1>
                                </div>
                                <div class="news__details">
                                    <p>Date de création: {{ stamp.creation_date }}</p>
                                    <p>Couleur(s): {{ stamp.colors }}</p>
                                    <p>Pays d’origine: {{ stamp.country_of_origin }}</p>
                                    <p>Condition: {{ stamp.stamp_condition }}</p>
                                    <p>Tirage: {{ stamp.print_run }}</p>
                                    <p>Dimensions: {{ stamp.dimensions }}</p>
                                    <p>Certifié: {{ stamp.certified == 'Oui' ? 'Oui' : 'Non' }}</p>
                                </div>
                
                                <div class="news__read--more">
                                    <a href="{{ base }}/auctioning/create?id={{ stamp.id }}" class="bid-now news-btn">Créer une enchère<i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                                </div>
                            </div>
                        {% endfor %}  
                    {% endif %}
                    
                    
                </div>
            </section>
        </div>
    </section>

<!---Footer-->
{{ include('layouts/footer.php')}}