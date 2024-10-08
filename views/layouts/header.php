<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/js/product-card-slider.js" defer></script>
    <script src="assets/js/navigation.js" defer></script>
    <script src="assets/js/timer.js" defer></script>
    <title>{{ title }}</title>
    <link rel="stylesheet" href= 
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> 
    <link rel="stylesheet" href="{{asset}}css/style.css">
    {% if scripts is not empty %}
        {% for js in scripts %}
            <script src="{{asset}}js/navigation.js" defer></script>
            <script src="{{asset}}js/{{js}}" defer></script>
        {% endfor %}
    {% endif %}  
</head>
<body>
       <header class="navigation">
            <div class="navigation__logo">
                <a href="{{base}}/home">
                    <div class="logo__image"><img src="{{asset}}img/logo/logo_7.png" alt="logo-img"></div>
                </a>
                <div class="logo__title">
                    <h1>Lord Stampee</h1>
                </div>
            </div>
            <nav class="navigation__menu">
                <div class="menu__page-links">
                    <div class="page-links__box">
                        <a class="link-page" href="{{ base }}/catalog">Enchères</a>
                        <a class="link-page" href="{{ base }}/page/about">À propos</a>
                        <a class="link-page" href="{{ base }}/page/actual">Actualité</a>
                    </div>
                </div>
                <div class="menu__currency-connection-section">
                    {% if  guest %}
                        <a class="btn btn-connection" href="{{base}}/login">Authentification</a>
                    {% endif %}                        
                    {% if guest is empty %}
                            <div class="greet-user">
                                <p class="greet-user-text">Bonjour, <span>{{ session.name }}</span></p>
                                <a href="{{ base }}/user/edit">
                                    <div class="greet-user-img">
                                        <img src="{{ asset }}img/profile/profile1.webp" alt="image of {{session.name}}">
                                    </div>
                                </a>
                            </div>
                            
                            <a class="btn btn-connection" href="{{base}}/logout">Déconnexion</a>
                    {% endif %}
                    <div class="custom-select" style="width:200px;">
                        <select>
                            <option value="">Canada - CAD</option>
                            <option value="">États-Unis - USD</option>
                            <option value="">Royaume-Uni - GBP</option>
                            <option value="">Australie - AUD</option>
                        </select>
                    </div>
                </div>
            </nav>
            <div class="toggle_btn">
                <img src="https://img.icons8.com/?size=100&id=36389&format=png&color=808080" alt="nav_bar">
            </div>

            <div class="dropdown_menu">
                <li><a href="{{ base }}/catalog" role="menuitem">Enchères</a></li>
                <li><a href="{{ base }}/page/about" role="menuitem">À propos</a></li>
                <li><a href="{{ base }}/page/actual" role="menuitem">Actualité</a></li>
                <div class="dropdown_menu--connection">
                {% if  guest %}
                    <a class="action_btn" href="{{base}}/login">Authentification</a>
                {% endif %}    
                {% if guest is empty %}
                            <div class="greet-user">
                                <p class="greet-user-text">Bonjour, <span>{{ session.name }}</span></p>
                                <a href="{{ base }}/user/edit">
                                    <div class="greet-user-img">
                                        <img src="{{ asset }}img/profile/profile1.webp" alt="image of {{session.name}}">
                                    </div>
                                </a>
                            </div>
                            <a class="action_btn" href="{{base}}/logout">Déconnexion</a>
                    {% endif %}
                    
                </div>
                <div class="custom-select" style="width:100%;">
                    <select>
                        <option value="">Canada - CAD</option>
                        <option value="">États-Unis - USD</option>
                        <option value="">Royaume-Uni - GBP</option>
                        <option value="">Australie - AUD</option>
                    </select>
                </div>
            </div>
       </header>