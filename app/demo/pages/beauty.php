<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowUp - Beauty, Skincare, Makeup & Cosmetics</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fff5f5; color: #333; }
        header { background: white; border-bottom: 1px solid #fce7f3; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; padding: 1.25rem 2rem; }
        .logo { font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 600; color: #be185d; }
        nav a { color: #6b7280; text-decoration: none; margin-left: 2rem; font-size: 0.9rem; }
        nav a:hover { color: #be185d; }
        .btn-login { background: linear-gradient(135deg, #ec4899, #be185d); color: white; padding: 0.6rem 1.5rem; border-radius: 25px; text-decoration: none; font-weight: 500; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #fce7f3, #fbcfe8); padding: 4rem 2rem; text-align: center; }
        .hero h1 { font-family: 'Cormorant Garamond', serif; font-size: 2.8rem; color: #831843; margin-bottom: 1rem; font-weight: 500; }
        .hero p { color: #9d174d; font-size: 1.1rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; font-weight: 500; color: #831843; margin-bottom: 1.5rem; border-bottom: 2px solid #ec4899; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: white; border-radius: 20px; padding: 1.75rem; margin-bottom: 1.5rem; box-shadow: 0 4px 20px rgba(236,72,153,0.08); }
        .article-meta { color: #ec4899; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.15rem; font-weight: 600; margin-bottom: 0.75rem; color: #1f2937; }
        .article-text { color: #6b7280; font-size: 0.95rem; line-height: 1.85; }
        .sidebar-box { background: white; border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 20px rgba(236,72,153,0.08); }
        .sidebar-title { font-size: 0.9rem; font-weight: 600; color: #831843; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #fce7f3; }
        .cta-box { background: linear-gradient(135deg, #ec4899, #be185d); color: white; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #be185d; padding: 0.75rem 2rem; border-radius: 25px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #831843; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #fbcfe8; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">GlowUp</div>
            <nav>
                <a href="#">Skincare</a>
                <a href="#">Makeup</a>
                <a href="#">Haircare</a>
                <a href="#">Fragrance</a>
                <a href="#">Reviews</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <h1>Your Guide to Beauty & Self-Care</h1>
        <p>Discover the latest in skincare, makeup, and beauty trends</p>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Beauty News & Product Reviews</h2>

                <article class="article-card">
                    <div class="article-meta">Skincare - Premium Brands</div>
                    <h3 class="article-title">L'Oreal and Nivea Lead Innovation in Anti-Aging Skincare Technology</h3>
                    <p class="article-text">
                        The skincare industry continues to evolve as L'Oreal and Nivea introduce breakthrough anti-aging formulations. L'Oreal Paris has developed new retinol-based treatments that promise visible results in reducing fine lines and wrinkles. Nivea's dermatologically tested moisturizers offer hydration and skin protection for all skin types. The beauty industry sees growing demand for scientifically-backed skincare products with proven ingredients. Cosmetic companies are investing heavily in research to develop effective anti-aging creams, serums, and treatments. Skincare routines have become essential for health-conscious consumers seeking to maintain youthful, radiant skin. Premium beauty brands continue to expand their skincare lines with targeted solutions for various skin concerns including acne, hyperpigmentation, and sensitivity.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Makeup - Cosmetics Trends</div>
                    <h3 class="article-title">MAC and Maybelline Define Spring Makeup Trends with Bold Colors</h3>
                    <p class="article-text">
                        Leading cosmetics brands MAC and Maybelline are setting the tone for spring makeup trends with vibrant color palettes and innovative formulas. MAC Cosmetics continues to be a favorite among makeup artists and beauty enthusiasts for its professional-quality products. Maybelline's affordable cosmetics make trendy makeup accessible to consumers worldwide. The makeup industry embraces diversity with expanded shade ranges for foundations, concealers, and lipsticks. Beauty influencers and makeup tutorials drive product discovery and application techniques. Cosmetic brands are developing long-wearing formulas for busy lifestyles while maintaining skin-friendly ingredients. The beauty market sees strong demand for mascara, eyeshadow palettes, and lip products that deliver high-impact looks.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Haircare - Professional Products</div>
                    <h3 class="article-title">Pantene and Schwarzkopf Transform Haircare with Advanced Formulations</h3>
                    <p class="article-text">
                        Haircare innovation reaches new heights as Pantene and Schwarzkopf Professional introduce advanced formulations for all hair types. Pantene's Pro-V technology delivers essential nutrients and vitamins for stronger, healthier hair. Schwarzkopf Professional provides salon-quality treatments for hair coloring, styling, and repair. The beauty industry recognizes haircare as an essential component of personal grooming and self-expression. Shampoos, conditioners, and styling products are formulated to address specific hair concerns from damage repair to volume enhancement. Kerastase and Redken also offer premium haircare solutions for discerning consumers. Hair salons and stylists rely on professional-grade products to deliver exceptional results for their clients.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Fragrance - Luxury Perfumes</div>
                    <h3 class="article-title">Chanel and Dior Unveil Exclusive Fragrance Collections</h3>
                    <p class="article-text">
                        Luxury fragrance houses Chanel and Dior present their latest perfume collections, capturing the essence of elegance and sophistication. Chanel No. 5 remains the world's most iconic fragrance, while new compositions explore contemporary scent profiles. Dior's perfume creations blend traditional French perfumery techniques with innovative ingredients. The beauty industry sees fragrances as essential accessories for personal style and expression. Calvin Klein, Hugo Boss, and Armani also compete in the luxury fragrance market with distinctive offerings. Perfume counters in department stores and beauty retailers showcase extensive fragrance collections. Celebrity-endorsed perfumes and limited-edition releases generate significant consumer interest in the beauty sector.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">Natural Beauty - Clean Cosmetics</div>
                    <h3 class="article-title">The Rise of Natural and Organic Beauty Products</h3>
                    <p class="article-text">
                        Consumer demand for natural and organic beauty products continues to grow as awareness of ingredient safety increases. The Body Shop, Aveda, and other brands champion clean beauty with plant-based formulations and sustainable practices. Natural cosmetics avoid synthetic chemicals, parabens, and artificial fragrances that may irritate sensitive skin. The beauty industry is responding with certified organic skincare, makeup, and haircare products. Dove and other mainstream brands are reformulating products to meet clean beauty standards. Cruelty-free and vegan beauty products appeal to ethically conscious consumers. The cosmetics market sees natural beauty as a significant growth category with increasing investment in sustainable packaging and eco-friendly production methods.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="color: white; margin-bottom: 0.75rem;">Join GlowUp</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1rem;">Get personalized beauty tips and exclusive offers</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Beauty Brands</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        L'Oreal, Maybelline, MAC Cosmetics, Nivea, Dove, Pantene, Schwarzkopf, Kerastase, Redken, Wella, Avon, Mary Kay, Clinique, Estee Lauder, Lancome, Urban Decay, NYX, Revlon, CoverGirl, Neutrogena, Olay, skincare brands, makeup companies, cosmetics manufacturers, beauty products.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Luxury Fragrances</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.7;">
                        Chanel, Dior, Gucci, Prada, Versace, Armani, Calvin Klein, Hugo Boss, Burberry, Tom Ford, Jo Malone, Yves Saint Laurent, Givenchy, Dolce & Gabbana, perfume, cologne, eau de toilette, fragrance, scent, luxury beauty, designer perfumes, cosmetics.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>GlowUp - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
