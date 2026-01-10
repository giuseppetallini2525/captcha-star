<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleMagazine - Fashion, Luxury Brands & Designer Collections</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fafafa; color: #1a1a1a; }
        header { background: white; border-bottom: 1px solid #eee; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; padding: 1.5rem 2rem; }
        .logo { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; letter-spacing: 2px; }
        nav a { color: #666; text-decoration: none; margin-left: 2.5rem; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }
        nav a:hover { color: #000; }
        .btn-login { background: #000; color: white; padding: 0.7rem 1.8rem; text-decoration: none; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #1a1a1a, #333); color: white; padding: 5rem 2rem; text-align: center; }
        .hero-label { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 3px; color: #999; margin-bottom: 1rem; }
        .hero h1 { font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 400; margin-bottom: 1rem; }
        .hero p { color: #aaa; font-size: 1.1rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 400; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #ddd; }
        .article-card { background: white; padding: 2rem; margin-bottom: 2rem; border: 1px solid #eee; }
        .article-meta { color: #999; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 0.75rem; }
        .article-title { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 500; margin-bottom: 1rem; }
        .article-text { color: #555; font-size: 0.95rem; line-height: 1.9; }
        .sidebar-box { background: white; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #eee; }
        .sidebar-title { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid #eee; }
        .cta-box { background: #000; color: white; text-align: center; padding: 2.5rem; }
        .cta-box h3 { font-family: 'Playfair Display', serif; font-weight: 400; margin-bottom: 1rem; }
        .cta-btn { display: inline-block; background: white; color: #000; padding: 0.75rem 2rem; text-decoration: none; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
        footer { background: #111; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #999; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">STYLE</div>
            <nav>
                <a href="#">Fashion</a>
                <a href="#">Luxury</a>
                <a href="#">Beauty</a>
                <a href="#">Lifestyle</a>
                <a href="#">Collections</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <p class="hero-label">Fashion Week 2026</p>
        <h1>The Future of Luxury Fashion</h1>
        <p>Discover the latest collections from the world's most prestigious designers</p>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Fashion News & Designer Collections</h2>

                <article class="article-card">
                    <div class="article-meta">Paris Fashion Week - Haute Couture</div>
                    <h3 class="article-title">Louis Vuitton Unveils Revolutionary Spring Collection at Paris Fashion Week</h3>
                    <p class="article-text">
                        The fashion world gathered in Paris to witness Louis Vuitton's stunning spring collection, showcasing the luxury brand's commitment to innovative design and exceptional craftsmanship. The runway presentation featured elegant clothing pieces that blend traditional fashion techniques with contemporary style. Supermodels wore designer handbags, leather accessories, and signature Louis Vuitton monogram patterns throughout the show. The French fashion house continues to set trends in the luxury fashion industry with its iconic designs. Fashion critics praised the creative direction and attention to detail evident in every garment. The collection includes ready-to-wear clothing, premium leather goods, and exclusive accessories that embody the essence of Parisian style. Louis Vuitton remains one of the most valuable luxury brands in the world, synonymous with elegance and sophistication.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Italian Fashion - Designer Spotlight</div>
                    <h3 class="article-title">Gucci and Prada Lead Milan Fashion Week with Bold New Designs</h3>
                    <p class="article-text">
                        Italian fashion houses Gucci and Prada dominated Milan Fashion Week with their bold, innovative collections that push the boundaries of luxury fashion. Gucci's runway show featured eclectic patterns, vintage-inspired clothing, and distinctive accessories that capture the brand's creative spirit. Prada presented minimalist designs with clean lines and premium materials, reinforcing its position as a leader in sophisticated fashion. The Milan fashion scene celebrates Italian craftsmanship and design excellence recognized worldwide. Fashion editors noted the influence of both brands on contemporary style trends. Designer shoes, handbags, and clothing from these luxury houses command premium prices and exclusive waiting lists. The Italian fashion industry continues to drive global trends in clothing, accessories, and luxury lifestyle products.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Sportswear - Brand Innovation</div>
                    <h3 class="article-title">Nike and Adidas Compete for Dominance in Athletic Fashion Market</h3>
                    <p class="article-text">
                        The sportswear industry witnesses intense competition between Nike and Adidas as both brands expand their fashion-forward athletic collections. Nike's Air Jordan collaborations with high-fashion designers have transformed sneaker culture into a fashion phenomenon. Adidas Originals continues to blend streetwear aesthetics with athletic performance in its clothing and footwear lines. Puma and New Balance are also gaining market share with stylish athletic wear that appeals to fashion-conscious consumers. The athleisure trend has blurred the lines between sportswear and everyday fashion, creating new opportunities for brands. Designer sneakers and limited-edition releases generate massive consumer interest and resale markets. Athletic fashion brands are partnering with celebrities and fashion designers to create exclusive clothing collections.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Luxury Accessories - Jewelry</div>
                    <h3 class="article-title">Cartier and Chanel Showcase Exquisite Jewelry Collections</h3>
                    <p class="article-text">
                        Luxury jewelry houses Cartier and Chanel have unveiled their latest high jewelry collections, featuring exceptional craftsmanship and precious gemstones. Cartier's iconic designs include diamond-encrusted timepieces and elegant gold jewelry that exemplify French luxury traditions. Chanel's jewelry collection draws inspiration from founder Coco Chanel's timeless aesthetic, featuring pearls and sophisticated accessories. The luxury fashion industry sees strong demand for fine jewelry and designer accessories from affluent consumers worldwide. Hermes and Dior also presented exclusive accessory lines during the fashion season. Premium fashion brands continue to expand their jewelry and watch offerings to complement their clothing collections. These luxury accessories represent significant investments and often become cherished family heirlooms.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Streetwear - Youth Fashion</div>
                    <h3 class="article-title">Supreme and Off-White Define Contemporary Streetwear Culture</h3>
                    <p class="article-text">
                        Streetwear brands have revolutionized the fashion industry, with Supreme and Off-White leading the movement that bridges street culture and high fashion. These brands collaborate with luxury houses like Louis Vuitton and Nike, creating limited-edition clothing and accessories that sell out instantly. The North Face and Vans also participate in the streetwear phenomenon with fashion-forward outdoor wear and skateboard-inspired designs. Young consumers drive demand for exclusive drops and rare fashion items from these coveted brands. Streetwear culture influences mainstream fashion trends, from oversized hoodies to designer sneakers. The resale market for limited streetwear releases has become a multi-billion dollar industry. Fashion brands are adapting their strategies to appeal to younger demographics through social media and influencer partnerships.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3>Join StyleMagazine</h3>
                    <p style="color: #999; margin-bottom: 1.25rem; font-size: 0.9rem;">Access exclusive fashion content and designer news</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Luxury Brands</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        Louis Vuitton, Gucci, Prada, Chanel, Hermes, Dior, Fendi, Burberry, Versace, Armani, Dolce & Gabbana, Balenciaga, Givenchy, Valentino, Saint Laurent, Bottega Veneta, Cartier, Rolex, Omega, designer fashion, luxury clothing, haute couture, runway collections, fashion week, premium accessories, leather goods, designer handbags.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Sportswear & Streetwear</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        Nike, Adidas, Puma, New Balance, Reebok, Converse, Vans, The North Face, Supreme, Off-White, Jordan, Lacoste, Ralph Lauren, Calvin Klein, Tommy Hilfiger, Hugo Boss, athletic wear, sneakers, sportswear, streetwear, casual fashion, activewear, footwear, clothing brands, fashion accessories.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>StyleMagazine - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
