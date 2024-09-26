{{ include('layouts/header.php', {title:'Tes encheres'})}}


<h1>Tes encheres</h1>
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
                    {% if auctions is empty %}
                        <p>No auctions found.</p>
                    {% else %}
                        {% for auction in auctions %}
                        <div class="card__news card_catalog" style="animation-delay: 0.3s;">
                                <div class="news__img">
                                    {% if stamp.images is not empty %}
                                        <img src="{{ base ~ '/' ~ stamp.images[0].image_path }}" alt="{{ stamp.name }}">
                                    {% else %}
                                        <img src="{{ asset ~ 'img/timbres/produits/default-image.jpg' }}" alt="{{ stamp.name }}">
                                    {% endif %}

                                    {% if guest is empty %}
                                        <a href="{{ base }}/auctioning/delete?id={{ auction.id }}" class="delete-button"><img src="{{ asset }}img/icons/utils/bin.png" alt="delete-btn"></a>
                                    {% endif %}
                                </div>
                                <div class="auction-details">
                                    <h3>{{ auction.stamp.name }}</h3>
                                    <p>Start Date: {{ auction.start_date }}</p>
                                    <p>End Date: {{ auction.end_date }}</p>
                                    <p>Starting Price: ${{ auction.starting_price }}</p>
                                </div>
                                <div class="news__read--more">
                                    <a href="{{ base }}/auctioning/edit?id={{ auction.id }}" class="bid-now news-btn">Modifier l'enchère<i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                                </div>
                            </div>
                        {% endfor %}
                    {% endif %}      
                </div>
            </section>
        </div>
    </section>
{{ include('layouts/footer.php')}}