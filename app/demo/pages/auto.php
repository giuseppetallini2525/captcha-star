<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoWorld - Luxury Cars, Racing News & Automotive Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f8f8; color: #222; }
        header { background: #111; color: white; }
        .header-top { display: flex; justify-content: space-between; align-items: center; padding: 1rem 3rem; max-width: 1400px; margin: 0 auto; }
        .logo { font-size: 1.8rem; font-weight: 800; }
        .logo span { color: #dc2626; }
        nav a { color: #999; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: white; }
        .btn-login { background: #dc2626; color: white; padding: 0.6rem 1.5rem; border-radius: 4px; margin-left: 2rem; text-decoration: none; cursor: pointer; }
        .hero { height: 400px; background: linear-gradient(135deg, #1a1a1a, #333); display: flex; align-items: center; }
        .hero-content { max-width: 1400px; margin: 0 auto; padding: 0 3rem; color: white; }
        .hero-label { background: #dc2626; display: inline-block; padding: 0.3rem 1rem; font-size: 0.8rem; font-weight: 600; margin-bottom: 1rem; }
        .hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; max-width: 700px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; border-bottom: 3px solid #dc2626; padding-bottom: 0.5rem; display: inline-block; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .article-card { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .article-meta { color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; }
        .article-text { color: #555; font-size: 0.95rem; line-height: 1.7; }
        .sidebar-box { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .sidebar-title { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #dc2626; }
        .cta-box { background: linear-gradient(135deg, #dc2626, #991b1b); color: white; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #dc2626; padding: 0.75rem 2rem; border-radius: 4px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #111; color: white; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #dc2626; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="logo">Auto<span>World</span></div>
            <nav>
                <a href="#">Cars</a>
                <a href="#">Racing</a>
                <a href="#">Electric</a>
                <a href="#">Motorcycles</a>
                <a href="#">Formula 1</a>
                <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-label">NEW 2026 MODEL</span>
            <h1>Ferrari SF100 Anniversary Edition: 1000 Horsepower of Italian Excellence</h1>
            <p style="opacity: 0.8;">Celebrating a century of automotive innovation with the most powerful Ferrari ever built</p>
        </div>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Automotive News & Car Reviews</h2>

                <article class="article-card">
                    <div class="article-meta">FORMULA 1 - RACING</div>
                    <h3 class="article-title">Formula One 2026 Regulations: New Era of Racing with Sustainable Technology</h3>
                    <p class="article-text">
                        The FIA has unveiled comprehensive new regulations for the 2026 Formula One season, marking a significant shift toward sustainability in motorsport. The new rules mandate increased electric power output and the use of 100% sustainable fuels across all racing teams. Ferrari, Mercedes, and Red Bull racing teams are already developing their next-generation power units to comply with the regulations. Formula One cars will feature redesigned aerodynamics to promote closer racing and more overtaking opportunities on the circuit. The Monaco Grand Prix and Italian Grand Prix at Monza will showcase these revolutionary changes. Motorsport fans can expect faster lap times despite the focus on environmental responsibility in racing technology.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">ELECTRIC VEHICLES - INNOVATION</div>
                    <h3 class="article-title">Mercedes-Benz Unveils Revolutionary Solid-State Battery Electric Vehicle</h3>
                    <p class="article-text">
                        Mercedes-Benz has announced a breakthrough in electric vehicle technology with the introduction of solid-state battery systems in their upcoming luxury electric cars. The German automotive manufacturer claims the new battery technology offers 1000 kilometer range on a single charge with just 15 minutes of charging time. The electric vehicle market continues to evolve rapidly with competition from Tesla, BMW, and Audi intensifying. Mercedes engineers have been developing this automotive technology for over five years in partnership with leading battery manufacturers. The new electric cars will feature advanced autonomous driving capabilities and luxurious interior design. Automobile enthusiasts are excited about the performance potential of these next-generation electric vehicles.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">SUPERCAR - REVIEW</div>
                    <h3 class="article-title">Lamborghini Temerario Review: Hybrid V8 Supercar Delivers 920 Horsepower</h3>
                    <p class="article-text">
                        The new Lamborghini Temerario represents a bold new direction for the Italian supercar manufacturer, combining a twin-turbocharged V8 engine with hybrid electric motors for a combined output of 920 horsepower. This exotic car accelerates from zero to 100 kilometers per hour in just 2.7 seconds, making it one of the fastest production vehicles ever created. The automotive design features Lamborghini's signature aggressive styling with improved aerodynamics for high-speed stability. Professional racing driver feedback has been overwhelmingly positive about the car's handling and performance characteristics. The supercar's interior combines racing-inspired ergonomics with luxury materials including carbon fiber and premium leather. Automobile collectors are already placing orders for this limited-production exotic vehicle.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">MOTORCYCLE - MOTOGP</div>
                    <h3 class="article-title">Ducati Dominates MotoGP Championship with Revolutionary Racing Motorcycle</h3>
                    <p class="article-text">
                        Ducati continues its dominant run in MotoGP racing with their latest motorcycle technology proving unbeatable on circuits worldwide. The Italian motorcycle manufacturer has won eight consecutive races with their revolutionary racing bike featuring advanced electronic systems and aerodynamic innovations. Honda and Yamaha racing teams are struggling to match Ducati's pace despite significant development investments. The motorcycle championship has seen record attendance figures as fans flock to witness the exciting racing action. Professional motorcycle riders praise Ducati's engineering excellence and the bike's exceptional handling characteristics. The motorsport success has translated into increased sales of Ducati's street motorcycles as enthusiasts seek the racing experience.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3>Find Your Dream Car</h3>
                    <p style="opacity: 0.9; margin-bottom: 1rem;">Access exclusive inventory and personalized recommendations</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Car Brands</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Ferrari, Lamborghini, Porsche, Mercedes-Benz, BMW, Audi, McLaren, Bugatti, Rolls-Royce, Bentley, Maserati, Alfa Romeo, Jaguar, Land Rover, Tesla, Toyota, Honda, Nissan, Mazda, Subaru, Volkswagen, Ford, Chevrolet, Dodge, Jeep, racing cars, sports cars, luxury vehicles, supercars, exotic automobiles.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Racing Series</h4>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Formula One, MotoGP, NASCAR, IndyCar, World Rally Championship, Le Mans 24 Hours, Dakar Rally, DTM, Formula E electric racing, GT World Challenge, motorcycle racing, touring car championships, drag racing, drift competitions, motorsport events, racing circuits, Grand Prix, championship racing.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>AutoWorld - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
