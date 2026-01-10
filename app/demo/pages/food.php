<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieWorld - Recipes, Restaurants & Culinary Experiences</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fffaf5; color: #333; }
        header { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; padding: 1rem 2rem; }
        .logo { font-size: 1.8rem; font-weight: 800; color: #333; }
        .logo span { color: #f59e0b; }
        nav a { color: #666; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: #f59e0b; }
        .btn-login { background: #f59e0b; color: white; padding: 0.6rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 4rem 2rem; text-align: center; }
        .hero h1 { font-size: 2.5rem; color: #92400e; margin-bottom: 1rem; }
        .hero p { color: #b45309; font-size: 1.2rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; color: #92400e; margin-bottom: 1.5rem; border-bottom: 3px solid #f59e0b; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: white; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .article-meta { color: #f59e0b; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: #1f2937; }
        .article-text { color: #6b7280; font-size: 0.95rem; line-height: 1.8; }
        .sidebar-box { background: white; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: #92400e; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f59e0b; }
        .cta-box { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #f59e0b; padding: 0.75rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #1f2937; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #f59e0b; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Foodie<span>World</span></div>
            <nav>
                <a href="#">Recipes</a>
                <a href="#">Restaurants</a>
                <a href="#">Drinks</a>
                <a href="#">Desserts</a>
                <a href="#">Reviews</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <h1>Discover Culinary Excellence Worldwide</h1>
        <p>Recipes, restaurant reviews, and food inspiration for every taste</p>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Food News & Restaurant Reviews</h2>

                <article class="article-card">
                    <div class="article-meta">RESTAURANT REVIEW - FINE DINING</div>
                    <h3 class="article-title">Michelin Awards 2026: New Three-Star Restaurants Announced Worldwide</h3>
                    <p class="article-text">
                        The prestigious Michelin Guide has unveiled its latest star ratings, with several restaurants earning the coveted three-star designation for exceptional cuisine and dining experience. Top chefs from around the world gathered to celebrate culinary excellence and gastronomic innovation. Fine dining establishments in New York, Paris, Tokyo, and London received recognition for their outstanding food quality and service. The restaurant industry continues to evolve with new cooking techniques and creative menu presentations. Michelin inspectors evaluated thousands of dining establishments, assessing food quality, mastery of cooking techniques, personality of the chef, value for money, and consistency. Celebrity chefs expressed gratitude for the recognition while pledging to continue pushing culinary boundaries. The awards ceremony featured tastings of signature dishes from the newly starred restaurants.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">BEVERAGES - CRAFT BEER</div>
                    <h3 class="article-title">Craft Beer Revolution: New Breweries Transform the Beverage Industry</h3>
                    <p class="article-text">
                        The craft beer movement continues to gain momentum as independent breweries introduce innovative brewing techniques and unique flavor profiles. Beer enthusiasts are embracing artisanal brewing methods that prioritize quality ingredients and traditional fermentation processes. Popular craft beer styles include India Pale Ale, stout, lager, pilsner, and wheat beer, each offering distinct taste characteristics. Corona, Heineken, and Budweiser face increasing competition from local craft breweries offering specialty beers. The beverage industry has witnessed remarkable growth in craft beer sales, with consumers seeking authentic brewing experiences. Brewery tours and beer tasting events have become popular attractions for food and drink enthusiasts. Bartenders and sommeliers are expanding their expertise to include craft beer pairings with various cuisines and dishes.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">FAST FOOD - INDUSTRY NEWS</div>
                    <h3 class="article-title">McDonald's and Burger King Introduce Plant-Based Menu Innovations</h3>
                    <p class="article-text">
                        Major fast food chains are expanding their menus with plant-based options to meet growing consumer demand for sustainable food choices. McDonald's has launched new vegetarian burgers and plant-based nuggets across its global restaurant locations. Burger King continues to innovate with its Impossible Whopper and other meat-free alternatives. The fast food industry is responding to health-conscious consumers seeking nutritious meal options without sacrificing convenience. Starbucks Coffee has also introduced oat milk and almond milk alternatives for its popular beverages. Subway and KFC are developing their own plant-based menu items to compete in the evolving food service market. Restaurant chains are investing in sustainable packaging and eco-friendly food production practices. The quick service restaurant industry represents billions in annual food sales worldwide.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">RECIPES - ITALIAN CUISINE</div>
                    <h3 class="article-title">Traditional Italian Pasta Recipes: From Nonna's Kitchen to Your Table</h3>
                    <p class="article-text">
                        Authentic Italian cuisine continues to inspire home cooks and professional chefs around the world. Traditional pasta recipes passed down through generations celebrate the simplicity and quality of Mediterranean ingredients. Homemade pasta dough, fresh tomato sauce, and quality olive oil form the foundation of classic Italian cooking. Popular dishes include spaghetti carbonara, lasagna, risotto, and wood-fired pizza from regions across Italy. Italian restaurants worldwide serve these beloved recipes, adapting them for local tastes while respecting culinary traditions. Cooking classes and food tours in Rome, Florence, and Naples attract food enthusiasts eager to learn authentic techniques. The food and beverage industry continues to celebrate Italian gastronomy with specialty ingredients, cooking equipment, and recipe books dedicated to Mediterranean cuisine.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">COFFEE - SPECIALTY DRINKS</div>
                    <h3 class="article-title">Third Wave Coffee Movement: Artisanal Roasting and Brewing Excellence</h3>
                    <p class="article-text">
                        The specialty coffee industry has transformed how consumers experience their daily caffeine ritual. Third wave coffee roasters focus on single-origin beans, precise roasting profiles, and expert brewing methods. Coffee shops and cafes have become cultural destinations where baristas demonstrate their craft with espresso machines and pour-over techniques. Starbucks, Dunkin', and independent coffee houses compete for customers seeking premium beverage experiences. The coffee culture extends beyond the cup to include latte art, cold brew innovations, and sustainable sourcing practices. Coffee enthusiasts invest in home brewing equipment and specialty beans to recreate cafe-quality drinks. The beverage industry has seen significant growth in ready-to-drink coffee products and coffee-flavored treats.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="color: white; margin-bottom: 0.75rem;">Join FoodieWorld</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1rem;">Get exclusive recipes and restaurant recommendations</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Food & Beverages</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Coca-Cola, Pepsi, McDonald's, Burger King, Starbucks Coffee, Subway, KFC, Pizza Hut, Dunkin' Donuts, Nestle, Heineken, Corona, Budweiser, Jack Daniel's, Absolut Vodka, Red Bull, Monster Energy, food recipes, cooking techniques, restaurant reviews, fine dining, fast food, beverages, coffee, beer, wine, spirits, culinary arts, gastronomy, cuisine, menu, chef, kitchen, dining, catering.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Cuisine Types</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Italian cuisine, French cooking, Japanese food, Mexican dishes, Chinese recipes, Indian curry, Thai food, Mediterranean diet, American BBQ, seafood, vegetarian meals, vegan recipes, desserts, pastries, baking, grilling, sushi, pizza, pasta, burgers, steaks, salads, soups, appetizers, main courses, side dishes.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>FoodieWorld - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
    </footer>

<!-- CAPTCHA Modal -->
<div id="captchaModal" class="captcha-modal-overlay" onclick="closeCaptchaModal(event)">
    <div class="captcha-modal" onclick="event.stopPropagation()">
        <div class="captcha-modal-header">
            <h3>Sponsored CAPTCHA</h3>
            <button class="captcha-modal-close" onclick="closeCaptchaModal()">&times;</button>
        </div>
        <div class="captcha-modal-body">
            <iframe id="captchaFrame" src=""></iframe>
        </div>
    </div>
</div>

<script>
    function openCaptchaModal() {
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        var currentUrl = window.location.href;
        iframe.src = 'captcha-modal.php?from=' + encodeURIComponent(currentUrl);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeCaptchaModal(event) {
        if (event && event.target !== event.currentTarget) return;
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        modal.classList.remove('active');
        iframe.src = '';
        document.body.style.overflow = '';
    }

    window.addEventListener('message', function(event) {
        if (event.data && event.data.type === 'captcha-success') {
            console.log('CAPTCHA solved successfully!');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCaptchaModal();
        }
    });
</script>
</body>
</html>
