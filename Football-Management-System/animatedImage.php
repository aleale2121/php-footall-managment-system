<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and proffesional website">
    <meta name="keywords" content="web design,affordable webdesign">
    <meta name="author" content="getch">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/animated.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <section id="main">
        <div class="container">
            <article id="main-col">
                <div class="w3-content w3-display-container" style="max-width:800px; ">
                    <img class="mySlides" src="images/1.jpg" style="width:100%">
                    <img class="mySlides" src="images/2.jpg" style="width:100%">
                    <img class="mySlides" src="images/3.jpg" style="width:100%">
                    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle"
                        style="width:100%">
                        <div class="w3-left " onclick="plusDivs(-1)">&#10094;</div>
                        <div class="w3-right " onclick="plusDivs(1)">&#10095;</div>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white"
                            onclick="currentDiv(1)"></span>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white"
                            onclick="currentDiv(2)"></span>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white"
                            onclick="currentDiv(3)"></span>
                    </div>
                </div>


            </article>

            
            <!-- </aside> -->

        </div>
        
    </section>
    <!-- for sliding images -->
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) { myIndex = 1 }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }

        ///////////////////////////////////////////////////

        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > x.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = x.length }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-white", "");
            }
            x[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " w3-white";
        }
    </script>

</body>

</html>