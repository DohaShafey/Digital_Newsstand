<?php require_once '../assets/include/header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Discover the World of Digital News</h1>
                <p>Read the latest articles from the best global sources</p>
                <div class="search-bar">
                    <input type="text" placeholder="Search for articles...">
                    <button>Search</button>
                </div>
            </div>
        </section>

        <!-- for you section -->
        <section class="featured-articles-foryou">
            <h2>For You</h2>
            <div class="articles-grid" id="foryou-container">

                

                <!-- Will be filled by JavaScript -->
            </div>
        </section>

        <!-- latest news -->
        <section class="featured-articles">
            <h2>Wake up with The Morning</h2>
            <div class="articles-grid" id="articles-container">
                <!-- Will be filled by JavaScript -->
            </div>
        </section>
        
        <section class="game">
            <a href="../Client/games.php">
                <h2>Play Games Now !!</h2>
            </a>
        </section>

        <section class="categories">
            <h2>Main Sections</h2>
            <div class="category-grid">
                <div class="category-card">
                    <a href="#">
                        <img src="https://i.pinimg.com/736x/f7/47/2e/f7472e601d4f32131d0a3fae5e5c3cc3.jpg" alt="News">
                        <h3>News</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="#">
                        <img src="https://i.pinimg.com/736x/2b/51/51/2b5151c2c27a410a1ec2d662b9328b68.jpg" alt="Technology">
                        <h3>Technology</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="#">
                        <img src="https://i.pinimg.com/736x/0a/52/17/0a5217aec017b4dc627cad4f921c9fb9.jpg" alt="Sports">
                        <h3>Sports</h3>
                    </a>
                </div>
                <div class="category-card">
                    <a href="#">
                        <img src="https://i.pinimg.com/736x/67/66/34/6766347ef6cab2947ec38500f50874e0.jpg" alt="Culture">
                        <h3>Culture</h3>
                    </a>
                </div>
            </div>
        </section>
    </main>
<?php require_once '../assets/include/footer.php'; ?>
