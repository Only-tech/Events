<?php
// admin/templates/footer.php
?>
</main>

<footer class="bg-gray-800 text-white py-4 mt-auto">
    <div class="container text-center text-sm">
        &copy; <?php echo date('Y'); ?> Administration. Tous droits réservés.
    </div>
</footer>
<script>
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const currentImage = document.getElementById('current-image'); // Ajout pour l'image actuelle

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'flex'; // Affiche la prévisualisation
                if (currentImage) {
                    currentImage.style.display = 'none'; // Cache l'image actuelle si une nouvelle est sélectionnée
                }
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none'; // Cache la prévisualisation si aucun fichier n'est sélectionné
            if (currentImage) {
                currentImage.style.display = 'flex'; // Réaffiche l'image actuelle si aucune nouvelle n'est sélectionnée
            }
        }
    });

    // Au chargement de la page, si une image existe déjà, affiche la prévisualisation de l'image actuelle
    document.addEventListener('DOMContentLoaded', function() {
        if (currentImage && currentImage.src && currentImage.src !== window.location.origin + '/') {
            // Only show current image if it has a valid source
            currentImage.style.display = 'flex';
        }
    });
</script>
</body>

</html>