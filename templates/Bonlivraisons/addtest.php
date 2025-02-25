<!DOCTYPE html>
<html>
<head>
    <title>Votre titre</title>
    <!-- Inclusion de jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- Inclusion de jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <!-- Votre contenu HTML -->
    <?= $this->fetch('content') ?>
    <!-- Script pour initialiser l'autocomplétion -->
    <script>
        $(document).ready(function() {
            var availableTags = [
                "ActionScript",
                "Bootstrap",
                "C",
                "C++",
                "Java",
                "JavaScript",
                "PHP",
                "Python",
                "Ruby",
                "Swift"
            ];
            $("#autocomplete-input").autocomplete({
                source: availableTags
            });
        });
    </script>
</body>
</html>
<input type="text" id="autocomplete-input">

