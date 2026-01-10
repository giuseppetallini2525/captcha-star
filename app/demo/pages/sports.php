<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportDaily - Breaking Sports News, Live Scores & Athletics Coverage</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f5f5; }
        header { background: #1a1a1a; color: white; }
        .top-bar { background: #111; padding: 0.5rem 2rem; font-size: 0.8rem; display: flex; justify-content: space-between; }
        .top-bar a { color: #888; text-decoration: none; margin-left: 1rem; cursor: pointer; }
        .top-bar a:hover { color: #e63946; }
        .main-nav { display: flex; justify-content: space-between; align-items: center; padding: 1rem 2rem; }
        .logo { font-size: 1.8rem; font-weight: 800; }
        .logo span { color: #e63946; }
        nav a { color: white; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: #e63946; }
        .btn-subscribe { background: #e63946; padding: 0.6rem 1.2rem; border-radius: 4px; cursor: pointer; }
        .breaking { background: #e63946; color: white; padding: 0.75rem 2rem; display: flex; align-items: center; }
        .breaking-label { background: white; color: #e63946; padding: 0.25rem 0.75rem; font-weight: 700; font-size: 0.75rem; margin-right: 1rem; }
        .hero { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; padding: 1.5rem 2rem; background: white; }
        .hero-main { position: relative; border-radius: 8px; overflow: hidden; height: 400px; background: linear-gradient(135deg, #1a1a1a, #333); }
        .hero-main-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.9)); color: white; }
        .hero-main h1 { font-size: 1.75rem; margin-bottom: 0.5rem; }
        .hero-category { background: #e63946; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; display: inline-block; margin-bottom: 0.5rem; border-radius: 2px; }
        .hero-side { display: flex; flex-direction: column; gap: 1rem; }
        .hero-side-item { position: relative; flex: 1; border-radius: 8px; overflow: hidden; background: linear-gradient(135deg, #2a2a2a, #444); }
        .hero-side-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background: linear-gradient(transparent, rgba(0,0,0,0.8)); color: white; }
        .hero-side-content h3 { font-size: 0.95rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 3px solid #e63946; display: inline-block; }
        .article-card { background: white; border-radius: 8px; overflow: hidden; margin-bottom: 1.5rem; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .article-meta { font-size: 0.75rem; color: #e63946; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a; }
        .article-text { font-size: 0.95rem; color: #444; line-height: 1.7; }
        .sidebar-box { background: white; border-radius: 8px; padding: 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .sidebar-title { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e63946; }
        .cta-box { background: linear-gradient(135deg, #e63946, #c62828); color: white; text-align: center; padding: 2rem; }
        .cta-box h3 { margin-bottom: 0.75rem; }
        .cta-box p { opacity: 0.9; margin-bottom: 1.25rem; font-size: 0.9rem; }
        .cta-btn { display: inline-block; background: white; color: #e63946; padding: 0.75rem 2rem; border-radius: 4px; text-decoration: none; font-weight: 600; cursor: pointer; border: none; font-size: 1rem; }
        .cta-btn:hover { background: #f5f5f5; }
        footer { background: #1a1a1a; color: white; padding: 2rem; margin-top: 3rem; text-align: center; }
        footer a { color: #e63946; }
        @media (max-width: 900px) { .hero, .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="top-bar">
            <span>Thursday, January 9, 2026</span>
            <div>
                <a href="#">Newsletter</a>
                <a onclick="openCaptchaModal()">Accedi</a>
            </div>
        </div>
        <div class="main-nav">
            <div class="logo">Sport<span>Daily</span></div>
            <nav>
                <a href="#">Football</a>
                <a href="#">Basketball</a>
                <a href="#">Tennis</a>
                <a href="#">Athletics</a>
                <a href="#">Olympics</a>
                <a onclick="openCaptchaModal()" class="btn-subscribe">Accedi</a>
            </nav>
        </div>
    </header>

    <div class="breaking">
        <span class="breaking-label">BREAKING</span>
        <span class="breaking-text">Champions League: Real Madrid advances to semi-finals after dramatic victory</span>
    </div>

    <div class="hero">
        <div class="hero-main">
            <div class="hero-main-content">
                <span class="hero-category">CHAMPIONS LEAGUE</span>
                <h1>Real Madrid Defeats Inter Milan 3-1 in Thrilling Match</h1>
                <p>Football excellence on display as Los Blancos dominate European competition</p>
            </div>
        </div>
        <div class="hero-side">
            <div class="hero-side-item">
                <div class="hero-side-content">
                    <span class="hero-category" style="background: #4CAF50;">NBA BASKETBALL</span>
                    <h3>Lakers secure playoff spot with overtime victory against Celtics</h3>
                </div>
            </div>
            <div class="hero-side-item">
                <div class="hero-side-content">
                    <span class="hero-category" style="background: #2196F3;">TENNIS</span>
                    <h3>Australian Open: Sinner advances to final after defeating Alcaraz</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Sports News & Athletics Coverage</h2>

                <article class="article-card">
                    <div class="article-meta">FOOTBALL - PREMIER LEAGUE</div>
                    <h3 class="article-title">Manchester United Signs Young Brazilian Midfielder in Record Transfer</h3>
                    <p class="article-text">
                        The football world was stunned today as Manchester United completed the signing of rising Brazilian star midfielder from Flamengo for a record-breaking fee. The 21-year-old player, known for his exceptional dribbling skills and vision on the pitch, has been one of the most sought-after talents in world football. The Premier League club beat competition from Barcelona and Bayern Munich to secure his services. Manager Erik ten Hag praised the acquisition, stating the young footballer will bring creativity and energy to the team's midfield. The player will wear the iconic number 7 jersey, previously worn by legends like Cristiano Ronaldo and David Beckham. Football analysts predict this signing will significantly boost United's chances in both the Premier League and Champions League competitions this season.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">ATHLETICS - WORLD CHAMPIONSHIPS</div>
                    <h3 class="article-title">World Record Shattered in 100m Sprint at Indoor Championships</h3>
                    <p class="article-text">
                        American sprinter Noah Johnson made history at the World Indoor Athletics Championships by running the 100 meters in an astonishing 9.72 seconds, breaking the previous world record. The athletic achievement marks a new era in sprinting and track and field sports. Johnson, who has been training with legendary coach Mike Powell, credits his success to years of dedicated fitness training and workout routines. The runner wore specially designed Nike Air running shoes during the record-breaking sprint. Athletics federations worldwide have praised this remarkable achievement. The Olympic champion is now setting his sights on the 2028 Los Angeles Olympics, where he hopes to defend his gold medal. Sports scientists are analyzing his running technique and training methods to understand how he achieved such exceptional speed and performance.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">BASKETBALL - NBA</div>
                    <h3 class="article-title">Lakers vs Celtics: Classic Rivalry Delivers Overtime Thriller</h3>
                    <p class="article-text">
                        The Los Angeles Lakers and Boston Celtics renewed their legendary basketball rivalry with an epic overtime battle at Staples Center. The NBA game saw LeBron James score 42 points, leading his team to a crucial victory in the playoff race. Basketball fans were treated to exceptional athleticism and teamwork from both squads. The Lakers' point guard dished out 15 assists while the team's defense held firm in the clutch moments. Coach Darvin Ham praised his players' fitness and conditioning, noting the intense training sessions that prepared them for such grueling competition. The victory moves the Lakers into the playoff picture with just weeks remaining in the regular season. Sports analysts are calling this one of the best NBA games of the season, showcasing why basketball remains one of the most exciting sports in the world.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">TENNIS - GRAND SLAM</div>
                    <h3 class="article-title">Italian Champion Sinner Reaches Australian Open Final</h3>
                    <p class="article-text">
                        Jannik Sinner continued his remarkable tennis journey by defeating Carlos Alcaraz in a five-set thriller to reach the Australian Open final. The Italian player displayed exceptional fitness and mental strength throughout the grueling match that lasted over four hours. Sinner's powerful forehand and improved serve proved too much for his Spanish opponent. Tennis experts are praising his athletic development and training regimen, which has transformed him into a Grand Slam contender. The championship match will see Sinner face Novak Djokovic, creating one of the most anticipated tennis finals in recent memory. Sports fans worldwide are excited to witness this clash of generations on the Melbourne courts. The winner will take home the trophy and valuable ranking points in the ATP Tour standings.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">OLYMPICS - PREPARATION</div>
                    <h3 class="article-title">2028 Los Angeles Olympics: New Venues and Athlete Village Unveiled</h3>
                    <p class="article-text">
                        Olympic organizers have revealed the stunning new venues and athlete village for the 2028 Los Angeles Games. The Olympic stadium will host athletics events including track and field, marathon, and walking races. Swimming competitions will take place at a state-of-the-art aquatics center featuring Olympic-sized pools. The basketball arena has been designed to accommodate thousands of sports fans eager to watch the world's best athletes compete for gold medals. Gymnastics, volleyball, and handball venues have also been announced. The athlete village will house competitors from over 200 nations, providing world-class training facilities and fitness centers. Olympic officials promise these Games will celebrate athletic excellence and inspire the next generation of sportsmen and sportswomen. The torch relay will pass through major American cities before arriving at the opening ceremony.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3>Join SportDaily</h3>
                    <p>Get personalized sports news and live score updates</p>
                    <button onclick="openCaptchaModal()" class="cta-btn">Accedi</button>
                </div>

                <div class="sidebar-box">
                    <h3 class="sidebar-title">Popular Sports</h3>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        Football, basketball, tennis, athletics, running, swimming, cycling, volleyball, gymnastics, boxing, martial arts, golf, rugby, cricket, baseball, hockey, skiing, snowboarding, surfing, skateboarding, motorsport, Formula One racing, MotoGP, cycling tours, marathon running, triathlon, Olympic sports, Paralympic games, fitness training, workout programs, gym exercises, sports nutrition, athletic performance, team sports, individual sports, extreme sports, water sports, winter sports, summer games.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h3 class="sidebar-title">Top Athletes</h3>
                    <p style="color: #666; font-size: 0.9rem; line-height: 1.6;">
                        World-class athletes competing in championship events across all sports disciplines. From football stars in the Premier League and Champions League to NBA basketball players, tennis champions at Grand Slam tournaments, Olympic gold medalists in athletics and swimming, and runners breaking world records in marathons and sprints. These sportsmen and sportswomen inspire millions with their dedication, training, and athletic achievements.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>SportDaily - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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

        // Listen for success message from iframe
        window.addEventListener('message', function(event) {
            if (event.data && event.data.type === 'captcha-success') {
                // Optional: do something on success, like show a confirmation
                console.log('CAPTCHA solved successfully!');
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCaptchaModal();
            }
        });
    </script>
</body>
</html>
