{{ include('layouts/header.php', {title:'Enchères'})}}

<script src="https://cdn.jsdelivr.net/npm/@mojs/core"></script>
    <section class="catalog flex-center">
        <div class="catalog-wrapper">
            <section class="catalog__filter--section">
                <div class="filter-box">
                    <!-- Sort By -->
                    <!-- <div class="filter__option--box">
                        <label class="filter__title--value" for="filter">Trier Par <span class="arrow-value-box">↑</span></label>
                        <div class="value-box">
                            <select name="filter" id="sortFilter" class="filter--box__select">
                                <option value="default">default</option>
                                <option value="creation_date">Date de création</option>
                            </select>
                        </div>
                    </div> -->
                    <!-- Certified Filter -->
                    <div class="filter__option--box">
                    <label class="filter__title--value" for="certified">Certifié</label>
                        <div class="value-box">
                            <div>
                                <label for="certifiedYes">Oui</label>
                                <input type="checkbox" name="certified" id="certifiedYes" value="Oui">
                            </div>
                            <div>
                                <label for="certifiedNo">Non</label>
                                <input type="checkbox" name="certified" id="certifiedNo" value="Non">
                            </div>
                        </div>
                </div>
                    <button class="bid-now" id="filter-btn">Chercher</button>
                </div>
            </section>


            <section class="catalog__auctions--section">
                <section class="catalog-category">
                    <div class="catalog-category-title">
                    <header class="header__title--with_line">
                        <h2>Coups de coeur de Lord</h2>
                        <div class="line"></div>
                    </header>
                        
                    </div>
                    <div class="grid-container">
                    {% for stamp in lordFavourites %}
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
                            <div class="news__read--more">
                                <a href="{{ base }}/stamp/details?id={{ stamp.id }}" class="bid-now news-btn">Placer une mise <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                            </div>
                        </div>
                    {% endfor %}
                    </div>

                </section>

                <section class="catalog-category">
                    <div class="catalog-category-title">
                        <header class="header__title--with_line">
                            <h3 class="live-bidding__title">Enchères en direct</h3>
                            <div class="line"></div>
                        </header>
                    </div>
                    <!-- Search Bar -->
                    <input type="text" id="searchInput" onkeyup="filterStamps()" placeholder="Rechercher un timbre..." title="Rechercher un nom de timbre">

                    <div class="grid-container" id="stampGrid">
                        {% for stamp in stamps %}
                            <div class="card__news card_catalog stamp-item" style="animation-delay: 0.3s;">
                                <div class="news__img">
                                    {% if session.privilege_id == 1 %} 
                                    <form action="{{ base }}/add-to-favourite" method="POST">
                                        <input type="hidden" name="stamp_id" value="{{ stamp.id }}">
                                        <input type="hidden" name="is_favourite" value="{{ stamp.is_favourite ? 0 : 1 }}"> 
                                        <!-- If already favorite, set to 0 to remove; otherwise, 1 to add -->
                                        <button type="submit" id='heart' class="button-heart {{ stamp.is_favourite ? 'active' : '' }}"></button>
    
                                    </form>

                                    {% if session.privilege_id == 1 %}
                                        <a href="{{ base }}/auctioning/delete?id={{ stamp.auction_id }}" class="delete-button"><img src="{{ asset }}img/icons/utils/bin.png" alt="delete-btn"></a>
                                    {% endif %}

                                    {% endif %}
                                    {% if stamp.images is not empty %}
                                        <img src="{{ stamp.images[0].image_path }}" alt="{{ stamp.name }}">
                                    {% else %}
                                        <img src="{{ asset ~ 'img/timbres/produits/default-image.jpg' }}" alt="{{ stamp.name }}">
                                    {% endif %}
                                </div>
                                

                                <div class="news__title">
                                    <h1 class="stamp-name">{{ stamp.name }}</h1>
                                </div>
                                <div class="news__details">
                                    <p>Date de création: {{ stamp.creation_date }}</p>
                                    <p>Couleur(s): {{ stamp.color }}</p>
                                    <p>Pays d’origine: {{ stamp.country }}</p>
                                    <p>Condition: {{ stamp.stamp_condition }}</p>
                                    <p>Tirage: {{ stamp.print_run }}</p>
                                    <p>Dimensions: {{ stamp.dimensions }}</p>
                                    <p>Certifié: <span class="certified-span">{{ stamp.certified == 'Oui' ? 'Oui' : 'Non' }}</span></p>
                                    <p>Auteur: {{ stamp.user_name }}</p>
                                </div>
                                <div class="news__read--more">
                                    <a href="{{ base }}/stamp/details?id={{ stamp.id }}" class="bid-now news-btn">Placer une mise <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                                </div>
                            </div>
                        {% endfor %}
                    </div>
                </section>

                <script>
                  


                </script>

                <section class="catalog__auctions--section">
                    <header class="header__title--with_line">
                        <h2>Archives des enchères passées</h2>
                        <div class="line"></div>
                    </header>

                    <div class="grid-container">
                        {% for auction in archivedAuctions %}
                            <div class="card__news card_catalog" style="animation-delay: 0.3s;">
                                <div class="news__img">
                                    {% if auction.images is not empty %}
                                        <img src="{{ base ~ '/' ~ auction.images[0].image_path }}" alt="{{ auction.name }}">
                                    {% else %}
                                        <img src="{{ asset ~ 'img/timbres/produits/default-image.jpg' }}" alt="{{ auction.name }}">
                                    {% endif %}
                                </div>
                                <div class="news__title">
                                    <h1>{{ auction.name }}</h1>
                                </div>
                                <div class="news__details">
                                    <p>Date de création: {{ stamp.creation_date }}</p>
                                    <p>Couleur(s): {{ stamp.color }}</p>
                                    <p>Pays d’origine: {{ stamp.country }}</p>
                                    <p>Condition: {{ stamp.stamp_condition }}</p>
                                    <p>Tirage: {{ stamp.print_run }}</p>
                                    <p>Dimensions: {{ stamp.dimensions }}</p>
                                    <p>Certifié: <span class="certified-span">{{ stamp.certified == 'Oui' ? 'Oui' : 'Non' }}</span></p>
                                    <p>Auteur: {{ stamp.user_name }}</p>
                                </div>

                                <div class="news__read--more">
                                    <a href="{{ base }}/stamp/details?id={{ auction.stamp_id }}" class="bid-now news-btn">Voir les détails <i class="arrow-right"><img src="{{ asset }}img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
                                </div>
                            </div>
                        {% endfor %}
                    </div>
                </section>


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

    <script>
    function filterStamps() {
        var input, filter, gridContainer, stamps, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        gridContainer = document.getElementById("stampGrid");
        stamps = gridContainer.getElementsByClassName("stamp-item");

        // Loop through all stamp items and hide those that don't match the search query
        for (i = 0; i < stamps.length; i++) {
            title = stamps[i].getElementsByClassName("stamp-name")[0];
            txtValue = title.textContent || title.innerText;
            
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                stamps[i].style.display = "";
            } else {
                stamps[i].style.display = "none";
            }
        }
    }
    </script>


    

     <!---Footer-->
     {{ include('layouts/footer.php')}}