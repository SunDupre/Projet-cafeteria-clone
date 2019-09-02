<div class="card text-white bg-primary  mb-5 bg-dark" style="max-width: 100%;" id="footer">
    <div class="card-body">
        <a href="#" class="card-link">
        </a>
        <p class="card-text">
            Conditions d'utilisation: les réservations des plats ne peuvent être effectués que 24 heures à l'avance
        </p>
        <div class="card-footer text-right bg-primary mb-0">© The Five Fingers 2019 (Digital Team Réalise)</div>
    </div>
</div>

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<script>
    //Quand l'utilisateur déroule de 20px du document, le bouton apparait
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
    }

    //Quand l'utilisateur clique sur le bouton, il revient en haut du document
    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
</script>
