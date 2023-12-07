<?php
// dashboard.html

// Démarrer la session
session_start();

// Vérifier si la variable de session user_id est définie
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard page</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/dashboard.css" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Bootstrap JS (Popper.js included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Votre propre fichier JavaScript peut être inclus ici -->
</head>
<style>
  .fixed-size img {
    width: 95%;
    height: 100%;
    object-fit: cover;
  }

  .modal {
    color: black;
  }
</style>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top dashboard-nav">
    <div class="container-fluid">
      <!-- Logo -->

      <a class="navbar-brand dashboard-logo" href="#"> Projet F </a>
      <btn id="launch-recommendation" class="btn orange-custom-btn width-min-150">C'est parti ! </btn>

      <!-- User Account Button -->
      <div class="d-flex">
        <text id="account-txt-btn" class="account-txt-btn btn-txt btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="fa-solid fa-user"></i>
          @Username
        </text>
      </div>
    </div>
  </nav>
  <div class="dashboard-page">


    <div class="container  mt-5">
      <h1 class="">Favoris</h1>
      <br>
      <div class='row' id="favorites-list">
        <!-- Appel serveur-->
      </div>
    </div>


    <div class="container  mt-5">
      <h1 class="">Dernières recommendations</h1>
      <br>
      <div class="row" id="last-recommendation-list">
        <!-- Appel serveur-->
      </div>
    </div>


    <!-- User Account Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="accountModalLabel">Mon compte</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
              Se déconnecter
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Fermer
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<!-- Media Item Modals -->
<div class="modal fade" id="movieInfosModal" tabindex="-1" aria-labelledby="movieInfosModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="movieInfosModalTitle">
          Titre du film
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="movieInfosModalImg" src="" alt="" height="50" width="50">
        <br><br>
        <ul>
          <li>
            Note : <span id="movieInfosModalRating"></span><span id="movieInfosModalRatingTime"></span>
          </li>
          <li>
            Favoris : <span id="movieInfosModalFavorite"></span><span id="movieInfosModalTime"></span>
          </li>
          <li>
            Description : <span id="movieInfosModalDescription"></span>
          </li>
          <li class="fieldForRecommendationHistory" style="display: none;">
            <span></span> Humeur : <span id="movieInfosModalHumor"></span>
          </li>
          <li class="fieldForRecommendationHistory" style="display: none;">
            <span></span> Temps : <span id="movieInfosModalWeatherLabel"></span><span id="movieInfosModalWeatherTemp"></span>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Fermer
        </button>
      </div>
    </div>
  </div>
</div>

<script type="module">
  import {
    getMovieById,
    getAllMovies
  } from './modules/movie.js'
  /***
   * TODO dashboard : 
   *  ✔0 - app logo link 
   *  ✔00 - config module file
   *  ✔1 - MAJ : nom de l'utilisateur avec SESSION 
   *  2 - Modal utilisateur + déconnexion
   *  ✔3 - Module JS getAllMovie() :  API  
   *  ✔4 - Module JS getMovieById(id)
   *  5 - script serveur pour avoir les infos de l'user 
   *      ✔favoris
   *      historique recommendations
   *  6 - MAJ front
   *      ✔favoris,
   *      Dernière recommendations
   * ✔7 - MAJ Modal
   *      ✔movie on click listener
   * 
   * 
   * 
   * TODO 2 - recommendation page :
   * 1 - front : ajout favourite + rating
   * 2 - indexation recommendation history + form logs
   * 3 - back : notation + rating
   * 
   */

  // 
  let accountTxtBtn = $('#account-txt-btn');
  let user_id;


  // Wait for the document to be ready
  $(document).ready(function() {


    // test TMDB API
    getMovieById(550)
      .then((data) => {
        console.log(data);
      });
    // Example: Get movies of a specific genre (e.g., Action genre with genre ID 28)
    getAllMovies(28, 10)
      .then((data) => {
        //console.log(data);


      });

    // container des favoris  
    const favoritesContainer = document.getElementById('favorites-list');
    const lastRecommendationContainer = document.getElementById('last-recommendation-list');


    // requête pour récupèrer la session
    $.ajax({
      url: "php/getSessionInfos.php",
      method: "GET",
      dataType: "json",
      success: function(data) {
        //console.log(data);
        if (data.success === true) {
          user_id = data.session.user_id;
        } else {
          //
          //console.log();
        }
      },
      error: function(xhr, status, error) {
        console.error("Error: " + status, error);
      },
    }).then(() => {


      // Récupérer liste des relations
      $.ajax({
        url: "php/getRelationsByUser.php",
        method: "GET",
        dataType: "json",
        data: {
          user_id: user_id,
          limit: 5,
          order_by_fav_time_desc: 1
        },
        success: function(data) {

          if (data.success === true) {


            // res du serveur
            let resultRelation = data.result;
            console.log("resultRelation", resultRelation)

            resultRelation.forEach(function(movie, index) {

              let relationId = movie.relation_id

              // Check if the movie is from the API
              if (movie.movie_is_from_API && movie.favourite === "1") {
                // recuperer les infos sur le film
                const movieFromTMDB = getMovieById(movie.id_API)
                  .then((m) => {
                    let movieImage = m.imageUrl;
                    let title = m.title;

                    // Create a div to hold movie information with Bootstrap classes
                    const movieDiv = document.createElement('div');
                    movieDiv.classList.add('col-md-2', 'mb-4'); // Adjust classes as needed for 5 columns

                    // Create an image element with Bootstrap class
                    const imageElement = document.createElement('img');
                    imageElement.classList.add('img-fluid', 'rounded'); // This makes the image responsive and adds rounded corners

                    // Set the image source
                    imageElement.src = movieImage;

                    // Set the image alt attribute
                    imageElement.alt = title;

                    // Set the width and height attributes to resize the image
                    imageElement.width = 200;
                    imageElement.height = 200;
                    // Ajoutez une classe pour définir une taille fixe à tous les éléments
                    movieDiv.classList.add('fixed-size');
                    // Add the movie title as a data attribute
                    movieDiv.setAttribute('data-movie-title', title);
                    movieDiv.setAttribute('data-relation-id', relationId);

                    // Add Bootstrap data-toggle attribute to link to the modal
                    movieDiv.setAttribute('data-toggle', 'modal');
                    // Remove the data-target attribute

                    // Append the image and title to the movieDiv
                    movieDiv.appendChild(imageElement);

                    // Append the movieDiv to the favoritesContainer
                    favoritesContainer.appendChild(movieDiv);

                    // Ajouter un gestionnaire d'événements pour ouvrir le modal manuellement au clic
                    movieDiv.addEventListener('click', function() {




                      let movieInfosModalTitle = $('#movieInfosModalTitle');
                      let movieInfosModalImg = $('#movieInfosModalImg');
                      let movieInfosModalRating = $('#movieInfosModalRating');
                      let movieInfosModalRatingTime = $('#movieInfosModalRatingTime');
                      let movieInfosModalFavorite = $('#movieInfosModalFavorite');
                      let movieInfosModalTime = $('#movieInfosModalTime');
                      let movieInfosModalDescription = $('#movieInfosModalDescription');


                      // cacher les champs pour l'histo de reco


                      $('.fieldForRecommendationHistory').hide();


                      // TODO : vider tous les champs

                      movieInfosModalTitle.empty();
                      movieInfosModalImg.empty()
                      movieInfosModalRating.empty();
                      movieInfosModalRatingTime.empty();
                      movieInfosModalFavorite.empty();
                      movieInfosModalTime.empty();
                      movieInfosModalDescription.empty();

                      movieInfosModalImg.attr("src", movieImage);
                      movieInfosModalTitle.text(title);
                      movieInfosModalDescription.text(m.overview);

                      if (movie.rating) {
                        movieInfosModalRating.text(movie.rating + " ⭐");
                        movieInfosModalRatingTime.text(" | " + movie.rating_timestamp);
                      } else {
                        movieInfosModalRating.text("Pas de note attribuée ");
                      }
                      if (movie.favourite === "1") {
                        movieInfosModalFavorite.text("♥");
                      } else {
                        movieInfosModalFavorite.text("♡");

                      }

                      $('#movieInfosModal').modal('show');


                    });


                  });
              }

              // After appending all movieDiv elements to favoritesContainer
              //favoritesContainer.style.display = 'flex';
              //favoritesContainer.style.flexDirection = 'row';

            });

          } else {
            // Gérer le cas où il n'y a pas de films favoris
          }
        },
        error: function(xhr, status, error) {
          console.error("Error: " + status, error);
        },
      })




      /**
       * TODO : Récupérer la liste des films pour la liste de recommendation (historique)
       */
      $.ajax({
        url: "php/getRecommendationHistoryByUser.php",
        method: "GET",
        dataType: "json",
        data: {
          user_id: user_id,
          limit: 10
        },
        success: function(data) {
          console.log(data)
          if (data.success === true) {

            let resultRecommendation = data.result;



            resultRecommendation.forEach(function(movie, index) {

              let relationId = movie.relation_id

              // Check if the movie is from the API
              if (movie.movie_is_from_API) {
                // recuperer les infos sur le film
                const movieFromTMDB = getMovieById(movie.id_API)
                  .then((m) => {
                    let movieImage = m.imageUrl;
                    let title = m.title;

                    // Create a div to hold movie information with Bootstrap classes
                    const movieDiv = document.createElement('div');
                    movieDiv.classList.add('col-md-2', 'mb-4'); // Adjust classes as needed for 5 columns

                    // Create an image element with Bootstrap class
                    const imageElement = document.createElement('img');
                    imageElement.classList.add('img-fluid', 'rounded'); // This makes the image responsive and adds rounded corners

                    // Set the image source
                    imageElement.src = movieImage;

                    // Set the image alt attribute
                    imageElement.alt = title;

                    // Set the width and height attributes to resize the image
                    imageElement.width = 200;
                    imageElement.height = 200;
                    // Ajoutez une classe pour définir une taille fixe à tous les éléments
                    movieDiv.classList.add('fixed-size');
                    // Add the movie title as a data attribute
                    movieDiv.setAttribute('data-movie-title', title);
                    movieDiv.setAttribute('data-relation-id', relationId);

                    // Add Bootstrap data-toggle attribute to link to the modal
                    movieDiv.setAttribute('data-toggle', 'modal');
                    // Remove the data-target attribute

                    // Append the image and title to the movieDiv
                    movieDiv.appendChild(imageElement);

                    lastRecommendationContainer.appendChild(movieDiv);

                    // Ajouter un gestionnaire d'événements pour ouvrir le modal manuellement au clic
                    movieDiv.addEventListener('click', function() {

                      let movieInfosModalTitle = $('#movieInfosModalTitle');
                      let movieInfosModalImg = $('#movieInfosModalImg');
                      let movieInfosModalRating = $('#movieInfosModalRating');
                      let movieInfosModalRatingTime = $('#movieInfosModalRatingTime');
                      let movieInfosModalFavorite = $('#movieInfosModalFavorite');
                      let movieInfosModalTime = $('#movieInfosModalTime');
                      let movieInfosModalDescription = $('#movieInfosModalDescription');
                      let movieInfosModalHumor = $('#movieInfosModalHumor');
                      let movieInfosModalWeatherLabel = $('#movieInfosModalWeatherLabel');
                      let movieInfosModalWeatherTemp = $('#movieInfosModalWeatherTemp');


                      // afficher les champs pour l'histo de reco


                      $('.fieldForRecommendationHistory').show();
                      // TODO : vider tous les champs


                      movieInfosModalTitle.empty();
                      movieInfosModalImg.empty()
                      movieInfosModalRating.empty();
                      movieInfosModalRatingTime.empty();
                      movieInfosModalFavorite.empty();
                      movieInfosModalTime.empty();
                      movieInfosModalDescription.empty();
                      movieInfosModalHumor.empty();
                      movieInfosModalWeatherLabel.empty();
                      movieInfosModalWeatherTemp.empty();


                      movieInfosModalImg.attr("src", movieImage);
                      movieInfosModalTitle.text(title);
                      movieInfosModalDescription.text(m.overview);

                      if (movie.rating) {
                        movieInfosModalRating.text(movie.rating + " ⭐");
                        movieInfosModalRatingTime.text(" | " + movie.rating_timestamp);
                      } else {
                        movieInfosModalRating.text("Pas de note attribuée ");
                      }
                      if (movie.favourite === "1") {
                        movieInfosModalFavorite.text("♥");
                      } else {
                        movieInfosModalFavorite.text("♡");


                      }


                      movieInfosModalHumor.text(movie.user_humor);
                      movieInfosModalWeatherLabel.text(movie.user_location_weather_label + " - ");
                      movieInfosModalWeatherTemp.text(movie.user_location_weather_temperature + " °C");

                      $('#movieInfosModal').modal('show');


                    });


                  });
              } else {

              }

              // After appending all movieDiv elements to favoritesContainer
              lastRecommendationContainer.style.display = 'flex';
              lastRecommendationContainer.style.flexDirection = 'wrap';
              lastRecommendationContainer.style.justifyContent = 'flex-start'; // Adjust as needed for your layout


            });
            /**
             * 
             * 0
: 
form_submission_date
: 
"2023-12-03 14:12:04"
id
: 
"16"
id_API
: 
"663892"
movie_is_from_API
: 
"1"
user_humor
: 
"neutral"
user_id
: 
"1"
user_location_lat
: 
"48.86691840"
user_location_long
: 
"2.38223360"
user_location_weather_label
: 
"Couvert"
user_location_weather_temperature
: 
"3"
[[Prototype]]
: 
Object

             */


          } else {
            // Gérer le cas où il n'y a pas de films favoris
          }
        },
        error: function(xhr, status, error) {
          console.error("Error: " + status, error);
        },
      });




      // récupérer les infos de l'utilisateur
      $.ajax({
        url: "php/getUserInformations.php",
        method: "GET",
        dataType: "json",
        data: {
          user_id: user_id
        },
        success: function(data) {
          //console.log(data);
          if (data.success === true) {
            accountTxtBtn.text("@" + data.userAllInfos[0].username);
            // accountTxtBtn.data("user-name", data.userAllInfos[0].username);
            // accountTxtBtn.data("user-id", data.userAllInfos[0].id);
          } else {
            //

            //console.log();
          }
        },
        error: function(xhr, status, error) {
          console.error("Error: " + status, error);
        },
      });

    });



    document.getElementById('launch-recommendation').addEventListener('click', function() {
      // Perform the redirection here
      window.location.href = './recommandation.html';
    });

  });
</script>