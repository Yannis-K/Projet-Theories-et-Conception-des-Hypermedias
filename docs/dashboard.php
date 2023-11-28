<?php
// dashboard.html

// Démarrer la session
session_start();

// Vérifier si la variable de session user_id est définie
if (!isset($_SESSION['user_id'])) {
  // Rediriger vers une autre page (par exemple, login.php)
  header('Location: login.php');
  exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
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
    <!-- Dashboard Sections -->
    <div class="container mt-5">
      <h1 class="">Dernières notations</h1>
      <br />
      <div class="media-set-wrapper">
        <div class="media-set-container">
          <div class="media-set" id="set-1">
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABXIDFbg2NYs0J_j4l9z65gEXZTRLxjiVTK1Xd4llqwyhbvzQnwh6uZEzUvDCCCGf6z5nIjcs8zjaR299TgnTlgywaT15XhPAGJPWCIeXi2Sl2xQyvNTqhlYJp--nO03w2Shc.jpg?r=0df" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABQCvwrrYVamj6L7UNYTVrJhYapCRkk1VNp8oJI2aLri9crgHPQUyhgRC-4DAGnJF8xZz35GNCvGRb97KpO4FsMBO6xEwLNEwL2U.webp?r=e4d" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABfJJ8Y5GMSB17vsIdB9zrF8eNKmxum2iscxw-NiTpoqFqnlkyK2dbXICfjgho41WyN0ah5BSomKnS-nqpqvKAywUkF9b7nBUNSSvo-1hRR_HjFLhxTBF-sgBMbLANkEOBWk-Nju7rcnFJBWLHjdoT9dQPdcrKQNtY5tM.webp?r=36b" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABTtI7hk4E_9V1lBvn8HK3uiljwZobTQkIQ7ZKPJID_rGpu3HOi2Q4_peJF6SDHu6_EWAxAEOe71lhy4utbH8rcfl5CHN4MVOV_izfMrYLc_wAPdTmcjdGXPloa4Kr_5O6ZSoNQ.jpg?r=816" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABQE-hkjE36NCEuq-2NfWI6660T8ghirNOQbKO98gEaDVigT2sdjzP1u0J5xwE4VPRBRQFTviX7Bi7WzBaw0tW-h8wqPUvYmaqo9e.webp?r=8f3" />
            </div>
            <a href="#set-2" class="link-next">></a>
          </div>
          <div class="media-set" id="set-2">
            <a href="#set-1" class="link-prev">
              &lt;</a>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABRq5Kin_SXwfbx3d8B6N-GtiJNEAGXSrRMgRj7L3jzc1FIkRkz9UIGf5Lqus9DimIoxyNXoUz9V3_XTpBzI3BjN9dFBeapymAjJ8f5nZVBP1R6XCWXzdLzDcolgQqwos2yGKhjbDtsBhi37lmNtb-TowRf2Taq5E2XUIVKfopOWbiZyURSl_CcEWHVutXEUa69rQw0JYbavotZCU3XjGRvM2D7AdQET2VkgwEJ8Nc1-iwoGre8Vbdid-bS_pv-4kTOw6PVbj02dqk56Gydk7pUBUtxUgv9s0A0tcuziO-fbATBMBuoZeAdpeVrQ8UmwDXU6GUAgw1tpijcTOvyqVMWnKCjJhQf_ldko.webp?r=5ef" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABf6V2CuXhmOYTMI1TSG3OmwGbDdubFgztgdnYlXrc47gVwJO0xXOLxLNEwbzU9sdAvamUboT8c5t885scr9RXwVg0r0LFt16Il4VZcr_M6EVhh2RMXU6mxj0gneSczj5hAqxuwRNK1dXoj2kfydyIw-64m2-XLs0ntD6Io7LFLVUl53MdKYG5vLYZSrMlCBlwydHKC2gUGk44aqegxACLrh4cUHNGMvYmh91dTD50js2lV2jBVDKvxzJTm0lwuDFYVTzkzN1zBXz0RiX4Z2OLwhWXA.webp?r=76b" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-3212-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABZjchxz_1zvxbszU-fXk3yyzy0lr4qfBS5cXswbktNSue8F3MNgfuhP5sWerSpDMiIjeMCIXxE2EJXVEzfANmZMP8_Xp2zu8AdCaIkaS5j9Pi3EiI9IPNqk5LsPYLJLZ3hIzNBSpKnf0dJrq6jTqj2XrmlHTfb6lwE64R6TVbAHnTacoxbYJGEDsPJMsxtZy.jpg?r=591" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <a href="#set-3" class="link-next">></a>
          </div>

          <div class="media-set" id="set-3">
            <a href="#set-2" class="link-prev">
              &lt;</a>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <h1 class="">Favoris</h1>
      <br />
      <div class="media-set-wrapper">
        <div class="media-set-container">
          <div class="media-set" id="set-1-1">
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABXIDFbg2NYs0J_j4l9z65gEXZTRLxjiVTK1Xd4llqwyhbvzQnwh6uZEzUvDCCCGf6z5nIjcs8zjaR299TgnTlgywaT15XhPAGJPWCIeXi2Sl2xQyvNTqhlYJp--nO03w2Shc.jpg?r=0df" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABQCvwrrYVamj6L7UNYTVrJhYapCRkk1VNp8oJI2aLri9crgHPQUyhgRC-4DAGnJF8xZz35GNCvGRb97KpO4FsMBO6xEwLNEwL2U.webp?r=e4d" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABfJJ8Y5GMSB17vsIdB9zrF8eNKmxum2iscxw-NiTpoqFqnlkyK2dbXICfjgho41WyN0ah5BSomKnS-nqpqvKAywUkF9b7nBUNSSvo-1hRR_HjFLhxTBF-sgBMbLANkEOBWk-Nju7rcnFJBWLHjdoT9dQPdcrKQNtY5tM.webp?r=36b" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABTtI7hk4E_9V1lBvn8HK3uiljwZobTQkIQ7ZKPJID_rGpu3HOi2Q4_peJF6SDHu6_EWAxAEOe71lhy4utbH8rcfl5CHN4MVOV_izfMrYLc_wAPdTmcjdGXPloa4Kr_5O6ZSoNQ.jpg?r=816" />
            </div>
            <div class="media-item">
              <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABQE-hkjE36NCEuq-2NfWI6660T8ghirNOQbKO98gEaDVigT2sdjzP1u0J5xwE4VPRBRQFTviX7Bi7WzBaw0tW-h8wqPUvYmaqo9e.webp?r=8f3" />
            </div>
            <a href="#set-2-2" class="link-next">></a>
          </div>
          <div class="media-set" id="set-2-2">
            <a href="#set-1-1" class="link-prev">
              <div class="media-item">
                <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABRq5Kin_SXwfbx3d8B6N-GtiJNEAGXSrRMgRj7L3jzc1FIkRkz9UIGf5Lqus9DimIoxyNXoUz9V3_XTpBzI3BjN9dFBeapymAjJ8f5nZVBP1R6XCWXzdLzDcolgQqwos2yGKhjbDtsBhi37lmNtb-TowRf2Taq5E2XUIVKfopOWbiZyURSl_CcEWHVutXEUa69rQw0JYbavotZCU3XjGRvM2D7AdQET2VkgwEJ8Nc1-iwoGre8Vbdid-bS_pv-4kTOw6PVbj02dqk56Gydk7pUBUtxUgv9s0A0tcuziO-fbATBMBuoZeAdpeVrQ8UmwDXU6GUAgw1tpijcTOvyqVMWnKCjJhQf_ldko.webp?r=5ef" />
              </div>
              <div class="media-item">
                <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABf6V2CuXhmOYTMI1TSG3OmwGbDdubFgztgdnYlXrc47gVwJO0xXOLxLNEwbzU9sdAvamUboT8c5t885scr9RXwVg0r0LFt16Il4VZcr_M6EVhh2RMXU6mxj0gneSczj5hAqxuwRNK1dXoj2kfydyIw-64m2-XLs0ntD6Io7LFLVUl53MdKYG5vLYZSrMlCBlwydHKC2gUGk44aqegxACLrh4cUHNGMvYmh91dTD50js2lV2jBVDKvxzJTm0lwuDFYVTzkzN1zBXz0RiX4Z2OLwhWXA.webp?r=76b" />
              </div>
              <div class="media-item">
                <img src="https://occ-0-3212-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABZjchxz_1zvxbszU-fXk3yyzy0lr4qfBS5cXswbktNSue8F3MNgfuhP5sWerSpDMiIjeMCIXxE2EJXVEzfANmZMP8_Xp2zu8AdCaIkaS5j9Pi3EiI9IPNqk5LsPYLJLZ3hIzNBSpKnf0dJrq6jTqj2XrmlHTfb6lwE64R6TVbAHnTacoxbYJGEDsPJMsxtZy.jpg?r=591" />
              </div>
              <div class="media-item">
                <img src="https://picsum.photos/420" />
              </div>
              <div class="media-item">
                <img src="https://picsum.photos/420" />
              </div>
              <a href="#set-3-3" class="link-next">></a>
          </div>

          <div class="media-set" id="set-3-3">
            <a href="#set-2-2" class="link-prev">
              &lt;</a>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
            <div class="media-item">
              <img src="https://picsum.photos/420" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Static Band at the Bottom for Actions -->

    <!--
      <div class="fixed-bottom bg-light p-3 dashboard-bottom-nav">
        <btn class="btn orange-custom-btn width-min-150">C'est partis</btn>
      </div>
      -->
    <!-- User Account Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="accountModalLabel">User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Add content for user account modal -->
            <p>User account details go here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <!-- Add additional buttons as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<!-- Media Item Modals -->
<div class="modal fade" id="mediaItemModal1" tabindex="-1" aria-labelledby="mediaItemModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mediaItemModalLabel1">
          Media Item Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add content for media item modal -->
        <img src="https://occ-0-5584-3211.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABXIDFbg2NYs0J_j4l9z65gEXZTRLxjiVTK1Xd4llqwyhbvzQnwh6uZEzUvDCCCGf6z5nIjcs8zjaR299TgnTlgywaT15XhPAGJPWCIeXi2Sl2xQyvNTqhlYJp--nO03w2Shc.jpg?r=0df" alt="Media Item" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <!-- Add additional buttons as needed -->
      </div>
    </div>
  </div>
</div>
<script>
  /***
   * TODO dashboard : 
   *  0 - app logo link -- ok
   *  00 - config module file 
   *  1 - MAJ : nom de l'utilisateur avec SESSION
   *  2 - Modal utilisateur + déconnexion
   *  3 - Module JS getAllMovie() :  API  
   *  4 - Module JS getMovieById(id)
   *  5 - requete serveur pour avoir les infos de l'user (favoris,notes, recommendations...)
   *  6 - MAJ front (diapo)
   *  7 - MAJ Modal
   *  8 - possibilité de changer note/ favoris
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




    // requête pour récupèrer la session
    $.ajax({
      url: "php/getSessionInfos.php",
      method: "GET",
      dataType: "json",
      success: function(data) {
        console.log(data);
        if (data.success === true) {
          user_id = data.session.user_id;
        } else {
          //
          console.log();
        }
      },
      error: function(xhr, status, error) {
        console.error("Error: " + status, error);
      },
    }).then(() => {

      // récupérer les infos de l'utilisateur
      $.ajax({
        url: "php/getUserInformations.php",
        method: "GET",
        dataType: "json",
        data: {
          user_id: user_id
        },
        success: function(data) {
          console.log(data);
          if (data.success === true) {
            accountTxtBtn.text("@" + data.userAllInfos[0].username);
            // accountTxtBtn.data("user-name", data.userAllInfos[0].username);
            // accountTxtBtn.data("user-id", data.userAllInfos[0].id);
          } else {
            //

            console.log();
          }
        },
        error: function(xhr, status, error) {
          console.error("Error: " + status, error);
        },
      });

    });












    // Add a click event listener to your custom button
    $(".media-item").on("click", function() {
      // Open the modal
      $("#mediaItemModal1").modal("show");

      // Display a custom text in the modal body
      $("#mediaItemModal1 .modal-body").html(
        "<p>This is a custom text for Media Item 1.</p>"
      );
    });


    document.getElementById('launch-recommendation').addEventListener('click', function() {
      // Perform the redirection here
      window.location.href = './recommandation.html';
    });

  });
</script>