<?php
// Ustawienia
$directory = 'media'; // Katalog ze zdjęciami
$delay = 10; // Czas wyświetlania w sekundach

// Pobieranie listy plików obrazów
$files = glob($directory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Sprawdzenie czy znaleziono pliki
if (empty($files)) {
    die("Nie znaleziono obrazów w katalogu $directory");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Prosty pokaz slajdów</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: black;
            overflow: hidden;
        }
        img {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <img id="slideshow" src="<?php echo $files[0]; ?>" alt="Slajd">

    <script>
        // Lista wszystkich obrazów
        var images = <?php echo json_encode($files); ?>;
        var current = 0;
        var delay = <?php echo $delay * 1000; ?>;
        var img = document.getElementById('slideshow');

        // Funkcja do przełączania obrazów
        function changeImage() {
            current = (current + 1) % images.length;
            img.src = images[current];
            setTimeout(changeImage, delay);
        }

        // Uruchomienie pokazu slajdów
        setTimeout(changeImage, delay);

        // Ustawienie pełnego ekranu po kliknięciu
        document.addEventListener('click', function() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen();
            }
        });
    </script>
</body>
</html>