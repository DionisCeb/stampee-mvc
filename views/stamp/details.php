{{ include('layouts/header.php', {title:'Accueil'})}}
       
       <main class="content">
            <div class="structure">
                <section class="produit">
                    <div class="produit__image-container">
                        <div class="big-image">
                            <img src="{{ base ~ '/' ~ stamp.images[0].image_path }}" alt="Main Image" id="bigImg">
                        </div>
                        <div class="small-images">
                            {% for image in stamp.images %}
                                {% if not image.is_main %}
                                    <img src="{{ base ~ '/' ~ image.image_path }}" alt="Additional Image">
                                {% endif %}
                            {% endfor %}
                        </div>
                    </div>

                    <!-- Fullscreen Modal -->
                    <div id="fullscreenModal" class="modal">
                        <span class="close-modal" id="closeModal">&times;</span>
                        <img class="modal-content" id="modalImg">
                    </div>

                    <div class="produit__info">
                        <div class="info_main">
                            <h1 class="info__title">{{ stamp.name }}</h1>
                            <p>Auteur: {{ stamp.user_name }}</p>
                            
                            <h2 class="container__title">Caractéristiques</h2>
                            
                            <div class="container__lists">
                                <div class="list_box">
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Date de creation :</span> <span class="item-desc">{{ stamp.creation_date }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Condition :</span> <span class="item-desc">{{ stamp.stamp_condition }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Pays d’origine :</span> <span class="item-desc">{{ stamp.country }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Dimensions :</span> <span class="item-desc">{{ stamp.dimensions }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Couleurs :</span> <span class="item-desc">{{ stamp.color }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Tirage :</span> <span class="item-desc">{{ stamp.print_run }}</span></div>
                                    <div class="list-item" style="padding: 10px;"><span class="item-title">Certifié :</span> <span class="item-desc">{{ stamp.certified == 'Oui' ? 'Oui' : 'Non' }}</span></div>
                                </div>
                            </div>
                            {% if stamp.auction %}
                                <p>Date de début de l'enchère: {{ stamp.auction.start_date }}</p>
                                <p>Date de fin de l'enchère: {{ stamp.auction.end_date }}</p>

                                {% set currentDate = "now"|date("Y-m-d") %}

                                {# Check if the auction is still active #}
                                {% if currentDate > stamp.auction.end_date %}
                                    <p class="info__price">Dernier prix: <span class="price-new">${{ stamp.auction.starting_price }}</span></p>
                                    <p class="info__price">Cette enchère est passée.</p>
                                {% else %}
                                    {% if stamp.highest_bid %}
                                        <p class="info__price">Mise actuelle: <span class="price-new">${{ stamp.highest_bid }}</span></p>
                                    {% else %}
                                        <p class="info__price">Prix de départ: <span class="price-new">${{ stamp.auction.starting_price }}</span></p>
                                    {% endif %}

                                    <form action="{{ base }}/place-your-bid" method="POST">
                                        <div class="bid-container"> 
                                            <input type="hidden" name="auction_id" value="{{ stamp.auction.id }}">
                                            <input class="number-input" 
                                                type="number" 
                                                name="bid_amount" 
                                                id="" 
                                                min="{{ (stamp.highest_bid is defined ? stamp.highest_bid + 1 : stamp.auction.starting_price + 1) }}" 
                                                required 
                                                placeholder="Votre mise (minimum: ${{ (stamp.highest_bid is defined ? stamp.highest_bid + 1 : stamp.auction.starting_price + 1) }})">
                                        </div>

                                        {% if session.bid_status %}
                                            <div class="showBidStatus">
                                                {{ session.bid_status }}
                                            </div>
                                            {% set _ = session.remove('bid_status') %}
                                        {% endif %}

                                        <button class="btn add_to_cart_btn" type="submit">
                                            Placez votre mise
                                        </button>
                                    </form>
                                {% endif %}
                            {% else %}
                                <p>Cette timbre n'est pas aux enchères actuellement.</p>
                            {% endif %}


                        </div>   
                        <script>
                            setTimeout(function() {
                                document.querySelector('.showBidStatus').classList.add('fade-out');
                            }, 1500);
                        </script>
                 
                </section>
                <!----The box--->
                <section class="product__extra-info">
                        <div class="extra-info__box">
                            <div class="box__buttons">
                                <button class="btn btn-box btn-box-active">Description</button>
                                <button class="btn btn-box btn-no-bg">Commentaires(9) </button>
                                <button class="btn btn-box btn-no-bg">Plus d'offres</button>
                                <button class="btn btn-box btn-no-bg">FAQ</button>
                                <button class="btn btn-box btn-no-bg">Politiques du magasin</button>                      
                          
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="extra-info__content-information min-height30">
                            <h2 class="content-information__title">Description</h2>                           
                            <p class="content-information__description">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, esse voluptate. Cumque exercitationem autem provident vero cupiditate molestiae corporis delectus ea tempora voluptatibus, optio quam enim nulla. Doloribus a earum qui blanditiis id maxime sapiente labore odit ea, fugit animi. Culpa exercitationem magni reiciendis quibusdam assumenda quaerat quam distinctio quo ab at enim dolores, fugiat temporibus cumque libero nisi voluptatibus.
                            </p>
                        </div>
                </section>

                <!--List-->
                <section class="product__characteristics min-height30">
                    <div class="characteristics__lists--container">
                        <h2 class="container__title">Informations Supplémentaire</h2>
                        <div class="container__lists">
                            <div class="list_box">
                                <div class="list-item"><span class="item-title">Date de creation :</span> <span class="item-desc">20.11.1970</span></div>
                                <div class="list-item"><span class="item-title">Couleur :</span> <span class="item-desc">gris</span></div>
                                <div class="list-item"><span class="item-title">Pays d’origine :</span> <span class="item-desc">Australie</span></div>
                                <div class="list-item"><span class="item-title">Condition :</span> <span class="item-desc">Bonne</span></div>
                            </div>
                            <div class="list_box">
                                <div class="list-item"><span class="item-title">Date de creation :</span> <span class="item-desc">20.11.1970</span></div>
                                <div class="list-item"><span class="item-title">Couleur :</span> <span class="item-desc">gris</span></div>
                                <div class="list-item"><span class="item-title">Pays d’origine :</span> <span class="item-desc">Australie</span></div>
                                <div class="list-item"><span class="item-title">Condition :</span> <span class="item-desc">Bonne</span></div>
                            </div>
                        </div>
                    </div>
                </section> 

                <!--https://www.geeksforgeeks.org/create-a-draggable-card-slider-in-html-css-javascript/-->
                <section class="slider-product">
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
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
                                <a class="btn add_to_cart_btn card-slider-btn" href="catalogue.html">Voir Plus</a>
                            </div>
                        </div>
                        <i id="right" class="fa-solid fas fa-angle-right"></i>
                    </div>
                </section>              
                
            </div>
            
    </main>

        <!---Footer-->
        {{ include('layouts/footer.php')}}