    </main>
    <?php if ((isset($_GET['page']) ? $_GET['page'] : 'cover') !== 'cover'): ?>
    <div class="home-icon-container">
        <a href="<?php echo BASE_PATH; ?>" class="cursor-pointer" aria-label="Home">
            <img class="home-icon-img" src="<?php echo BASE_PATH; ?>images/home-icon.png" alt="Home">
        </a>
    </div>
    <footer></footer>
    <?php endif; ?>
    <script src="<?php echo BASE_PATH; ?>js/script.js"></script>
    <script>
        screen.orientation?.lock('landscape').catch(() => {});
    </script>
</body>
</html>
