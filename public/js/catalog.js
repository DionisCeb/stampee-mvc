const cardsData = [
    {
      imgSrc: "assets/img/timbres/produits/small-img_4.jpg",
      title: "Découverte d'un Timbre Rare",
      description: "Nous avons le plaisir de vous présenter un timbre rare, récemment découvert. Ce timbre est un ajout précieux pour tout collectionneur passionné, avec des détails exquis et une histoire fascinante.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_1.jpg",
      title: "Nouvelle Arrivée : Timbre Ancien",
      description: "Découvrez notre nouvelle arrivée, un timbre ancien qui a traversé les âges. Parfait pour enrichir votre collection avec un morceau d'histoire unique.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_2.jpg",
      title: "Timbre Historique Rare",
      description: "Ajoutez à votre collection un timbre historique rare. Ce timbre a une importance particulière dans l'histoire philatélique et est un must pour tout collectionneur sérieux.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_5.jpg",
      title: "Timbre Rare pour Collectionneurs",
      description: "Ce timbre rare est une opportunité rare pour les collectionneurs. Avec son design unique et sa rareté, il est sûr de compléter parfaitement votre collection.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_3.png",
      title: "Un Timbre Ancien Exceptionnel",
      description: "Nous avons récemment acquis un timbre ancien exceptionnel. Ce timbre rare est idéal pour ceux qui cherchent à enrichir leur collection avec un article d'une grande valeur historique.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_1.jpg",
      title: "Nouveau Timbre Historique",
      description: "Explorez notre dernier ajout, un timbre historique rare. Ce timbre est un excellent ajout pour tout amateur de philatélie, avec une histoire fascinante et une valeur inestimable.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_4.jpg",
      title: "Découverte d'un Timbre Rare",
      description: "Un timbre rare récemment découvert est maintenant disponible. Avec ses caractéristiques uniques et sa rareté, ce timbre est une opportunité exceptionnelle pour les collectionneurs.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_2.jpg",
      title: "Timbre Ancien Rare en Vente",
      description: "Ne manquez pas ce timbre ancien rare, récemment ajouté à notre collection. Ce timbre est un véritable trésor pour les amateurs d'histoire philatélique.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_5.jpg",
      title: "Nouveau Timbre Historique Rare",
      description: "Nous proposons un timbre historique rare, parfait pour les collectionneurs avertis. Ce timbre possède une importance historique et une beauté inégalée.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    },
    {
      imgSrc: "assets/img/timbres/produits/small-img_3.png",
      title: "Un Timbre Rare à Découvrir",
      description: "Ce timbre rare est maintenant à la vente. Avec ses caractéristiques uniques et sa valeur historique, il est un ajout essentiel pour toute collection.",
      link: "produit.html",
      timer: {
        days: "02",
        hours: "10",
        minutes: "02",
        seconds: "32"
      }
    }
  ];


  
  function createCardHTML(card) {
    return `
      <div class="card__news card_catalog">
        <div class="news__img">
          <img src="${card.imgSrc}" alt="${card.title}">
        </div>
        <div class="news__title">
          <h1>${card.title}</h1>
        </div>
        <div class="news__description">
          ${card.description}
        </div>
        <div class="timer catalog-timer">
          <div>
            <div class="time">
              <span>Jours:</span>
            </div>
            <div class="result">
              <span class="days">${card.timer.days}</span>
            </div>
          </div>
          <div>
            <div class="time">
              <span>Heures:</span>
            </div>
            <div class="result">
              <span class="hours">${card.timer.hours}</span>
            </div>
          </div>
          <div>
            <div class="time">
              <span>Minutes:</span>
            </div>
            <div class="result">
              <span class="minutes">${card.timer.minutes}</span>
            </div>
          </div>
          <div>
            <div class="time">
              <span>Secondes:</span>
            </div>
            <div class="result">
              <span class="seconds">${card.timer.seconds}</span>
            </div>
          </div>
        </div>
        <div class="news__read--more">
          <a href="${card.link}" class="bid-now news-btn">Placer une mise <i class="arrow-right"><img src="assets/img/icons/arrows/arrow-right.svg" alt="arrow-right"></i></a>
        </div>
      </div>
    `;
  }
  
  function injectCardsIntoDOM() {
    const section = document.querySelector(".catalog__auctions--section .grid-container");
    cardsData.forEach((card, index) => {
      const delay = (index + 1) * 0.3; // Increment delay by 2 seconds
      const cardHTML = createCardHTML(card);
      const tempDiv = document.createElement('div');
      tempDiv.innerHTML = cardHTML;
      const cardElement = tempDiv.firstElementChild;
      cardElement.style.animationDelay = `${delay}s`;
      section.appendChild(cardElement);
    });
  }
  
  // Call the function to inject the cards
  injectCardsIntoDOM();
  